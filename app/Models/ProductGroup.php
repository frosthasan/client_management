<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'group_name',
        'description',
        'slug',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Auto-generate slug before saving
protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->slug)) {
            $slug = \Str::slug($model->group_name);

            // Check if slug exists and make it unique
            $count = 1;
            $originalSlug = $slug;

            while (static::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $model->slug = $slug;
        }
    });

    static::updating(function ($model) {
        if ($model->isDirty('group_name')) {
            $slug = \Str::slug($model->group_name);

            // Check if slug exists (excluding current record)
            $count = 1;
            $originalSlug = $slug;

            while (static::withTrashed()
                       ->where('slug', $slug)
                       ->where('id', '!=', $model->id)
                       ->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $model->slug = $slug;
        }
    });
}
}
