<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('translate')) {
    /**
     * Translate the given string to the application's current locale.
     *
     * @param string $text The text to translate.
     * @return string
     */
    function translate(string $text): string
    {
        $locale = app()->getLocale();
        // $tr = new GoogleTranslate();
        // $tr->setTarget($locale);
        // return $tr->translate($text);
        return GoogleTranslate::trans($text, $locale, null, [
            'verify' => false,
        ]);
    }
}
