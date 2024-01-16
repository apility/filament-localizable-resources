<?php

namespace Apility\Filament\Concerns;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Stringable;
use Illuminate\Support\Str;

trait HasLocalizableResourceLabels
{
    const MODEL_LABEL = 'model_label';
    const NAVIGATION_LABEL = 'navigation_label';
    const SLUG = 'slug';

    protected static function getResourcePath(): string
    {
        return Str::of(static::class)
            ->whenContains(
                '\\Resources\\',
                fn (Stringable $slug): Stringable => $slug->afterLast('\\Resources\\'),
                fn (Stringable $slug): Stringable => $slug->classBasename(),
            )
            ->beforeLast('Resource')
            ->plural()
            ->explode('\\')
            ->map(fn (string $string) => str($string)->snake()->slug())
            ->implode('.');
    }

    protected static function translatedLabel(string $label, string $fallback, bool $plural = false): string
    {
        $localizedKey = implode('.', ['resources', static::getResourcePath(), $label]);

        if (Lang::has($localizedKey)) {
            return Lang::choice($localizedKey, $plural ? 2 : 1);
        }

        return $fallback;
    }

    public static function getModelLabel(): string
    {
        return static::translatedLabel(
            label: static::MODEL_LABEL,
            fallback: parent::getModelLabel(),
        );
    }

    public static function getPluralModelLabel(): string
    {
        return static::translatedLabel(
            label: static::MODEL_LABEL,
            fallback: parent::getPluralModelLabel(),
            plural: true,
        );
    }

    public static function getNavigationLabel(): string
    {
        return static::translatedLabel(
            label: static::NAVIGATION_LABEL,
            fallback: static::translatedLabel(
                label: static::MODEL_LABEL,
                fallback: parent::getSlug(),
                plural: true
            )
        );
    }

    public static function getSlug(): string
    {
        return static::translatedLabel(
            label: static::SLUG,
            fallback: static::translatedLabel(
                label: static::MODEL_LABEL,
                fallback: parent::getSlug(),
                plural: true
            )
        );
    }
}
