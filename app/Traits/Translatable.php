<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Get the translated value of a field for the given (or current) locale.
     * Falls back to Armenian, then English, then the first available value.
     */
    public function getTranslation(string $field, ?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $data = $this->getTranslations($field);

        if (array_key_exists($locale, $data) && $data[$locale] !== '' && $data[$locale] !== null) {
            return $data[$locale];
        }

        foreach (['hy', 'en', 'ru'] as $fallback) {
            if (!empty($data[$fallback])) {
                return $data[$fallback];
            }
        }

        foreach ($data as $value) {
            if (!empty($value)) {
                return $value;
            }
        }

        return '';
    }

    /**
     * Get the raw array of translations for a field, e.g. ['hy' => '...', 'ru' => '...', 'en' => '...'].
     */
    public function getTranslations(string $field): array
    {
        $raw = $this->attributes[$field] ?? null;

        if (is_array($raw)) {
            return $raw;
        }

        if (is_string($raw) && $raw !== '') {
            $decoded = json_decode($raw, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * Set the translation for a field/locale (does not save).
     */
    public function setTranslation(string $field, string $locale, ?string $value): static
    {
        $data = $this->getTranslations($field);
        $data[$locale] = $value ?? '';
        $this->attributes[$field] = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $this;
    }

    /**
     * Set all translations for a field at once from an array like
     * ['hy' => '...', 'ru' => '...', 'en' => '...'].
     */
    public function setTranslations(string $field, array $values): static
    {
        $this->attributes[$field] = json_encode($values, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $this;
    }

    /**
     * Eloquent magic accessor override: translatable fields return the
     * localized string by default, e.g. $car->name.
     */
    public function getAttribute($key)
    {
        if (in_array($key, $this->translatable ?? []) && array_key_exists($key, $this->attributes)) {
            return $this->getTranslation($key);
        }

        return parent::getAttribute($key);
    }
}
