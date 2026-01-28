<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes; // Add this line

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'product_id',
        'package_name',
        'domain',
        'billing_cycle',
        'price',
        'paid_date',
        'expire_date',
        'status',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'paid_date' => 'date',
        'expire_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Default attribute values.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'active',
    ];

    /**
     * Get the customer that owns the service.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the product that owns the service.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive services.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope a query to only include pending services.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include expired services.
     */
    public function scopeExpired($query)
    {
        return $query->where('expire_date', '<', now());
    }

    /**
     * Scope a query to only include services expiring soon (within 30 days).
     */
    public function scopeExpiringSoon($query)
    {
        return $query->where('expire_date', '>', now())
                     ->where('expire_date', '<=', now()->addDays(30));
    }

    /**
     * Scope a query to only include trashed (soft deleted) services.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }

    /**
     * Scope a query to only include non-trashed services.
     */
    public function scopeWithoutTrashed($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Scope a query to include all services (with trashed).
     */
    public function scopeWithTrashed($query)
    {
        return $query->withTrashed();
    }

    /**
     * Check if the service is trashed.
     */
    public function isTrashed()
    {
        return $this->trashed();
    }

    /**
     * Check if the service is expired.
     */
    public function isExpired()
    {
        return $this->expire_date < now();
    }

    /**
     * Check if the service is expiring soon (within 30 days).
     */
    public function isExpiringSoon()
    {
        return !$this->isExpired() && $this->expire_date <= now()->addDays(30);
    }

    /**
     * Get the remaining days until expiration.
     */
    public function daysUntilExpiration()
    {
        if ($this->isExpired()) {
            return 0;
        }

        return now()->diffInDays($this->expire_date);
    }

    /**
     * Restore a soft-deleted service.
     */
    public function restoreService()
    {
        return $this->restore();
    }

    /**
     * Permanently delete a service.
     */
    public function forceDeleteService()
    {
        return $this->forceDelete();
    }
}
