<?php

namespace TitasGailius\Moonlight;

use Laravel\Ui\Presets\Preset;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

trait UpdatesPackages
{
    /**
     * Update the "package.json" file.
     *
     * @return void
     */
    protected static function updateNodePackages()
    {
        static::updatePackages(...func_get_args());
    }

    /**
     * Update the given node package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return static::updateNodePackageArray($packages);
    }

    /**
     * Update the "composer.json" file.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected static function updateComposerPackages(string $key = 'require')
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages[$key] = static::updateComposerPackageArray($packages[$key] ?? [], $key);

        ksort($packages[$key]);

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Remove composer's "lock" file and "vendor" directory".
     *
     * @return void
     */
    protected static function removeComposerLock()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('vendor'));

            $files->delete(base_path('composer.lock'));
        });
    }
}