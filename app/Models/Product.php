<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Remove this line: use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory; // Remove: , SoftDeletes

    protected $fillable = [
        'name',
        'product_group_id',
        'pricing_type',
        'setup_fee',
        'price_one_time',
        'price_monthly',
        'price_yearly',
        'price_quarterly',
        'status',
        'version',
        'description'
    ];

    protected $casts = [
        'setup_fee' => 'decimal:2',
        'price_one_time' => 'decimal:2',
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
        'price_quarterly' => 'decimal:2',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationship with product group
    public function productGroup()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    // Helper methods
    public function getStatusTextAttribute()
    {
        $statuses = [
            0 => 'Inactive',
            1 => 'Active',
            2 => 'Coming Soon'
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    public function getPricingTypeTextAttribute()
    {
        $types = [
            'one_time' => 'One-Time',
            'recurring' => 'Recurring',
            'both' => 'Both'
        ];

        return $types[$this->pricing_type] ?? $this->pricing_type;
    }
}
