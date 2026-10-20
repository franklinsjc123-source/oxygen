<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorcreate extends Model
{
    use HasFactory;
    protected $table = 'vendor_details';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->shop_name ?: 'shop');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('shop_name') && !$model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->shop_name ?: 'shop', $model->id);
            }
        });
    }

    public static function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Scope query to only include active and non-expired vendors.
     */
    public function scopeActive($query)
    {
        return $query->where('vendor_details.status', 1)
            ->where(function ($q) {
                $q->whereNull('vendor_details.expired_date')
                  ->orWhereDate('vendor_details.expired_date', '>=', now()->toDateString());
            });
    }

    /**
     * Determine if this vendor's package has expired.
     */
    public function isExpired(): bool
    {
        if (empty($this->expired_date)) {
            return false;
        }
        return strtotime(date('Y-m-d', strtotime($this->expired_date))) < strtotime(date('Y-m-d'));
    }

    /**
     * Determine if this vendor is active and not expired.
     */
    public function isActive(): bool
    {
        return (int)($this->status ?? 0) === 1 && !$this->isExpired();
    }
}
