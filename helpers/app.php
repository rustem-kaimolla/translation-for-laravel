<?php

use KaimollaRustem\LaravelTranslation\Services\TranslationService;

if (!function_exists('translate')) {
    function translate(string $key, ?string $locale): ?string
    {
        if (is_null($locale)) {
            $locale = app()->getLocale();
        }

        if (in_array($locale, array_keys(config('laravel-translation::available_locales'))) === false) {
            return null;
        }

        return app(TranslationService::class)->translate($key, $locale);
    }
}