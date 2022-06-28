<?php
namespace KaimollaRustem\LaravelTranslation\Services;

use Illuminate\Support\Facades\Log;
use KaimollaRustem\LaravelTranslation\Models\Translation;
use Yandex\Translate\Exception as TranslatorException;
use Yandex\Translate\Translator;

/**
 * Аударма қызметі
 */
class TranslationService
{
    /**
     * Аудармашы
     *
     * @param string $key
     * @param string $locale
     *
     * @return string|null
     */
    public function translate(string $key, string $locale): ?string
    {
        $translation = Translation::find(md5($key));

        if (empty($translation)) {
            $this->autoTranslation($key);

            $translation = Translation::find(md5($key));
        }

        return $translation->translations[$locale] ?? null;
    }

    /**
     * Автоматты түрде аудару
     *
     * @param string $key
     *
     * @return void
     */
    protected function autoTranslation(string $key)
    {
        try {
            $translator  = new Translator(config('laravel-translation::api_key'));
            $model = new Translation();
            $model->code   = md5($key);
            $model->source = $key;
            $languages  = array_keys(config('laravel-translation::available_locales'));

            foreach ($languages as $lang) {
                $translation         = $translator->translate($key, sprintf("%s-%s", config('app.locale', 'en'), $lang));
                $translations[$lang] = $translation;
            }
            $model->translations = $languages;
            $model->save();
        } catch (TranslatorException $exception) {
            Log::error('Автоаударма кезіндегі қателік', ['package' => 'rustem-kaimolla/laravel-translation', 'exception' => $exception,]);
        }
    }
}
