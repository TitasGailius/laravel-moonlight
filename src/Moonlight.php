<?php

namespace TitasGailius\Moonlight;

use Laravel\Ui\UiCommand;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Ui\AuthCommand;
use Laravel\Ui\Presets\Preset;
use Illuminate\Console\Command;

class Moonlight extends Preset
{
    /**
     * Console command.
     *
     * @var \Illuminate\Console\Command
     */
    protected static $command;

    /**
     * Install Moonlight.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public static function install(Command $command)
    {
        static::$command = $command;

        if ($command instanceof AuthCommand) {
            return static::installMoonlightAuth($command);
        }

        return static::installMoonlight($command);
    }

    /**
     * Install Moonlight scaffolding.
     *
     * @param  \Laravel\Ui\UiCommand $command
     * @return void
     */
    public static function installMoonlight(UiCommand $command)
    {
        static::updatePackages();
        static::removeNodeModules();
        static::copyResources();

        if ($command->option('auth')) {
            $command->call('ui:auth', ['type' => 'moonlight']);
        }

        $command->info('Moonlight scaffolding installed successfully.');
        $command->comment('Please run "npm install && npm run dev" to update composer packages and compile your fresh scaffolding.');
    }

    /**
     * Install Moonlight authentication scaffolding.
     *
     * @param  \Laravel\Ui\AuthCommand  $command
     * @return void
     */
    public static function installMoonlightAuth(AuthCommand $command)
    {
        static::copyAuthResources($command->option('force'));
        static::appendAuthRoutes();

        $command->info('Moonlight authentication scaffolding generated successfully.');
    }

    /**
     * Update the given node package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            '@inertiajs/inertia' => '^0.1.7',
            '@inertiajs/inertia-vue' => '^0.1.2',
            'resolve-url-loader' => '^2.3.1',
            'sass' => '^1.20.1',
            'sass-loader' => '7.*',
            'tailwindcss' => '^1.1.4',
            'vue' => '^2.5.17',
            'vue-template-compiler' => '^2.6.10',
        ] + Arr::except($packages, [
            '@babel/preset-react',
            'react',
            'react-dom',
        ]);
    }

    /**
     * Copy resource files.
     *
     * @return void
     */
    protected static function copyResources()
    {
        static::copyFiles([
            'webpack.mix.js' => base_path('webpack.mix.js'),
            'routes/web.stub' => base_path('routes/web.php'),
            'tailwind.config.js' => base_path('tailwind.config.js'),
            'resources/views/app.blade.php' => static::getViewPath('app.blade.php'),

            'resources/js/app.js' => resource_path('js/app.js'),
            'resources/sass/app.scss' => resource_path('sass/app.scss'),
            'resources/js/pages/welcome.vue' => resource_path('js/pages/welcome.vue'),
            'resources/js/components/form-input.vue' => resource_path('js/components/form-input.vue'),

            'app/Http/Controllers/HomeController.php' => app_path('Http/Controllers/HomeController.php'),
            'app/Providers/InertiaServiceProvider.php' => app_path('Providers/InertiaServiceProvider.php'),
            'app/Http/Controllers/Auth/LoginController.php' => app_path('Http/Controllers/Auth/LoginController.php'),
            'app/Http/Controllers/Auth/RegisterController.php' => app_path('Http/Controllers/Auth/RegisterController.php'),
            'app/Http/Controllers/Auth/VerificationController.php' => app_path('Http/Controllers/Auth/VerificationController.php'),
            'app/Http/Controllers/Auth/ResetPasswordController.php' => app_path('Http/Controllers/Auth/ResetPasswordController.php'),
            'app/Http/Controllers/Auth/ForgotPasswordController.php' => app_path('Http/Controllers/Auth/ForgotPasswordController.php'),
            'app/Http/Controllers/Auth/ConfirmPasswordController.php' => app_path('Http/Controllers/Auth/ConfirmPasswordController.php'),
        ], true);
    }

    /**
     * Copy resource files for authentication scaffolding.
     *
     * @param  bool  $force
     * @return void
     */
    protected static function copyAuthResources(bool $force)
    {
        static::copyFiles([
            'resources/js/pages/home.vue' => resource_path('js/pages/home.vue'),
            'resources/js/layouts/app.vue' => resource_path('js/layouts/app.vue'),

            'resources/js/pages/auth/login.vue' => resource_path('js/pages/auth/login.vue'),
            'resources/js/pages/auth/verify.vue' => resource_path('js/pages/auth/verify.vue'),
            'resources/js/pages/auth/register.vue' => resource_path('js/pages/auth/register.vue'),

            'resources/js/pages/auth/passwords/email.vue' => resource_path('js/pages/auth/passwords/email.vue'),
            'resources/js/pages/auth/passwords/reset.vue' => resource_path('js/pages/auth/passwords/reset.vue'),
            'resources/js/pages/auth/passwords/confirm.vue' => resource_path('js/pages/auth/passwords/confirm.vue'),
        ], $force);
    }

    /**
     * Append authentication routes.
     *
     * @return void
     */
    protected static function appendAuthRoutes()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/moonlight-stubs/routes/auth.stub'),
            FILE_APPEND
        );
    }

    /**
     * Copy given resource files.
     *
     * @param  array  $files
     * @param  bool  $force
     * @return void
     */
    protected static function copyFiles(array $files, bool $force = false)
    {
        foreach ($files as $source => $destination) {
            if (! $force && file_exists($destination) && ! static::confirmReplacement($destination)) {
                continue;
            }

            static::ensureFileDirectoryExists($destination);

            copy(__DIR__.'/moonlight-stubs/'.$source, $destination);
        }
    }

    /**
     * Ensure that a directory of a given file path exists.
     *
     * @param  string  $file
     * @return bool
     */
    protected static function ensureFileDirectoryExists(string $file)
    {
        if (! $directory = static::getFileDirectory($file)) {
            return;
        }

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Get directory of the given file.
     *
     * @param  string  $file
     * @return string|null
     */
    protected static function getFileDirectory(string $file)
    {
        if (Str::contains($file, '/')) {
            return Str::beforeLast($file, '/');
        }
    }

    /**
     * Confirm the replacement of a given file.
     *
     * @param  string  $file
     * @return bool
     */
    protected static function confirmReplacement(string $file)
    {
        return static::$command->confirm(sprintf(
            'The [%s] file already exists. Do you want to replace it?',
            $file
        ));
    }

    /**
     * Get full view path relative to the application's configured view path.
     *
     * @param  string  $path
     * @return string
     */
    protected static function getViewPath(string $path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'),
            $path,
        ]);
    }
}
