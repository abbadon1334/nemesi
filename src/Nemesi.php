<?php

declare(strict_types=1);

namespace Nemesi;

use Abbadon1334\ATKFastRoute\Router;
use atk4\core\Exception;
use atk4\data\Persistence\SQL;
use atk4\schema\Migration;
use atk4\ui\App;
use ATK4PHPDebugBar\DebugBar;
use DebugBar\DebugBarException;
use Psr\Http\Message\ServerRequestInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionException;
use SplFileInfo;

class Nemesi
{
    /** @var App */
    protected $atk;

    /** @var NemesiConfigurator */
    protected $configurator;

    /** @var Router */
    protected $router;

    /**
     * Nemesi constructor.
     *
     * @param App|null $app
     *
     * @throws Exception
     */
    public function __construct(?App $app = null)
    {
        $this->atk          = $app ?? new App([
            'always_run' => false,
        ]);
        $this->configurator = new NemesiConfigurator();
        $this->router       = new Router($this->atk);
    }

    /**
     * @param string $config_path
     * @param string $format
     *
     * @throws Exception
     * @throws DebugBarException
     * @throws ReflectionException
     * @throws \atk4\data\Exception
     * @throws \atk4\ui\Exception
     */
    public function configApp(string $config_path, string $format): void
    {
        $this->configurator->readConfig($config_path, $format);
        $this->prepareApp();
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function fluidDB(): void
    {
        $iti = new RecursiveDirectoryIterator('models');
        /** @var SplFileInfo $file */
        foreach (new RecursiveIteratorIterator($iti) as $file) {
            if ($file->isDir()) {
                continue;
            }

            $className = $file->getRealPath();
            $className = str_replace(getcwd().'/models/', '', $className);
            $className = str_replace('/', '\\', $className);
            $className = strtok($className, '.');
            $className = '\\Nemesi\\Models\\'.$className;

            $reflection = new \ReflectionClass($className);
            if ($reflection->isAbstract() || $reflection->isTrait()) {
                continue;
            }

            Migration::getMigration(new $className($this->atk->db))->migrate();
        }
    }

    /**
     * @param string $folder
     * @param string $format
     *
     * @throws Exception
     * @throws \atk4\ui\Exception
     * @throws ReflectionException
     */
    public function configRoutes(string $folder, string $format): void
    {
        if (!is_dir($folder)) {
            throw new \atk4\ui\Exception([
                'Config path must be a folder',
            ]);
        }

        foreach (scandir($folder) as $path) {
            $route_path = $folder.DIRECTORY_SEPARATOR.$path;
            if (!is_dir($route_path)) {
                $this->router->loadRoutes($route_path, $format);
            }
        }
    }

    /**
     * @param string $i18n_path
     * @param string $format
     *
     * @throws Exception
     * @throws \atk4\ui\Exception
     */
    public function configI18n(string $i18n_path, string $format): void
    {
        throw new Exception([__METHOD__.' : not implemented Yet!']);
    }

    public function run(?ServerRequestInterface $request = null): void
    {
        $this->router->run($request);
    }

    /**
     * @throws Exception
     * @throws DebugBarException
     * @throws ReflectionException
     * @throws \atk4\data\Exception
     * @throws \atk4\ui\Exception
     */
    private function prepareApp(): void
    {
        $this->atk->debug = $this->configurator->getConfig('Debug/enabled', false);

        $this->atk->title = $this->configurator->getConfig('Application/title', $this->atk->title);
        $this->atk->cdn   = $this->configurator->getConfig('Application/cdn', $this->atk->cdn);

        $dsn = $this->configurator->getConfig('Database/dsn');
        $usr = $this->configurator->getConfig('Database/user');
        $pwd = $this->configurator->getConfig('Database/pass');

        $this->atk->db = new SQL($dsn, $usr, $pwd);
        if ($this->configurator->getConfig('Database/fluid', false)) {
            $this->fluidDB();
        }

        $this->atk->initLayout('Generic');

        if ($this->atk->debug) {
            $debugBar = new DebugBar();
            $debugBar->setAssetsResourcesPath('debugbar/');
            $this->atk->add($debugBar);
            $debugBar->addDefaultCollectors();
            $debugBar->addATK4LoggerCollector();
        }
    }
}
