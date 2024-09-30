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
        'hrayer'  => 'الشحن من خلال حرائر',
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
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
            $item->preview2   = $item->getUrl('preview2');
        });

        return $files;
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
        return $this->belongsToMany(Cart::class,'cart_product')
                ->withPivot('quantity')
                ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'product_review_id');
    }

    public function product_offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function calc_rating(){
        return ;
    }

    public function calc_product_price(){
        // get discount
        $discount = ($this->price * $this->discount) / 100;
        return $this->price - $discount;
    }
}
