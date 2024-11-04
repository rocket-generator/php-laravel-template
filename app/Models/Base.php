<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Base newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Base query()
 *
 * @mixin \Eloquent
 */
class Base extends Model
{
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }

    /**
     * @return string[]
     */
    public static function getFillableColumns(): array
    {
        return with(new static)->getFillable();
    }

    /**
     * @return string[]
     */
    public static function getViewableColumns(): array
    {
        return with(new static)->getFillable();
    }

    /**
     * @return string[]
     */
    public function getEditableColumns(): array
    {
        return $this->fillable;
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function getLocalizedColumn(string $key, string $locale = 'en'): string
    {
        if (empty($locale)) {
            $locale = 'en';
        }
        $localizedKey = $key.'_'.strtolower($locale);
        $value = $this->{$localizedKey};
        if (empty($value)) {
            $localizedKey = $key.'_en';
            $value = $this->{$localizedKey};
        }

        return $value;
    }

    public function toFillableArray(): array
    {
        $ret = [];
        foreach ($this->fillable as $key) {
            $ret[$key] = $this->{$key};
        }

        return $ret;
    }
}
