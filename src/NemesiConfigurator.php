<?php

declare(strict_types=1);

namespace Nemesi;

use atk4\core\ConfigTrait;
use atk4\ui\Exception;

class NemesiConfigurator
{
    use ConfigTrait {
        readConfig as _readConfig;
        setConfig as protected;
        _lookupConfigElement as protected;
    }
    const FORMAT_PHP        = 'php';
    const FORMAT_PHP_INLINE = 'php-inline';
    const FORMAT_JSON       = 'json';
    const FORMAT_YAML       = 'yaml';

    /**
     * @param string $folder
     * @param string $format
     *
     * @throws Exception
     * @throws \atk4\core\Exception
     */
    public function readConfig(string $folder, string $format): void
    {
        if (!is_dir($folder)) {
            throw new Exception([
                'Config path must be a folder',
                'path' => $folder,
            ]);
        }

        foreach (scandir($folder) as $path) {
            $config_path = $folder.DIRECTORY_SEPARATOR.$path;
            if (!is_dir($config_path)) {
                $this->_readConfig($config_path, $format);
            }
        }
    }
}
