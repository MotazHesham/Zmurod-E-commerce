<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'products';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const SHIPPING_METHOD_SELECT = [
        'seller' => 'الشحن من خلال البائع',
        'hrayer' => 'الشحن من خلال حرائر',
    ];


    protected $fillable = [
        'name',
        'current_stock',
        'information',
        'most_recent',
        'published',
        'discount',
        'price',
        'product_category_id',
        'user_id',
        'fav',
        'rating',
        'shipping_method',
        'created_at',
        'updated_at',
        'deleted_at',
        'weight',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('preview2')->fit('crop', 800, 800);
    }

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
            $item->preview2 = $item->getUrl('preview2');
        });

        return $files;
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }

    public function product_tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function product_category()
    {
        return $this->belongsTo(Category::class, 'product_category_id');
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_review_id');
    }

    public function product_offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function calc_rating()
    {
        return;
    }

    public function calc_product_price()
    {
        // get discount
        $discount = ($this->price * $this->discount) / 100;
        return $this->price - $discount;
    }

    /**
     * Check if product has sufficient stock
     */
    public function hasStock($quantity = 1)
    {
        return $this->current_stock >= $quantity;
    }

    /**
     * Reserve stock for cart (doesn't actually reduce inventory)
     */
    public function reserveStock($quantity)
    {
        if ($this->hasStock($quantity)) {
            return true;
        }
        return false;
    }

    /**
     * Reduce stock when order is placed
     */
    public function reduceStock($quantity)
    {
        if ($this->hasStock($quantity)) {
            $this->current_stock -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Restore stock (for cancelled orders)
     */
    public function restoreStock($quantity)
    {
        $this->current_stock += $quantity;
        $this->save();
        return true;
    }

    /**
     * Get formatted price with discount
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->calc_product_price(), 2);
    }

    /**
     * Get discount amount
     */
    public function getDiscountAmountAttribute()
    {
        return ($this->price * $this->discount) / 100;
    }

    /**
     * Check if product is available for purchase
     */
    public function isAvailable()
    {
        return $this->published && $this->current_stock > 0;
    }

    /**
     * Scope for available products
     */
    public function scopeAvailable($query)
    {
        return $query->where('published', true)->where('current_stock', '>', 0);
    }

    /**
     * Scope for products with stock
     */
    public function scopeInStock($query)
    {
        return $query->where('current_stock', '>', 0);
    }
}
