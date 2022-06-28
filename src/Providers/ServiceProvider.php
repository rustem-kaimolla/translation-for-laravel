<?php

namespace KaimollaRustem\LaravelTranslation\Providers;

/**
 * Қызметті орнату
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Пакетті жүктеу
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Баптауларды жариялау
         */
        $this->publishes([
            __DIR__ . '/../../stubs/config/laravel-translation.php' => config_path('laravel-translation.php'),
        ]);

        /**
         * ДҚ миграцияларын жүктеу
         */
        $this->loadMigrationsFrom(__DIR__ . '/../../stubs/database/migrations');
    }
}