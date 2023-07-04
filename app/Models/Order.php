<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'order_num',
        'client_name',
        'phone_number',
    ];

    public const SHIPMENT_TYPE_RADIO = [
        'normal' => 'Normal shipment ',
        'fast'   => 'Fast shipment ',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'Pending',
        'on_review'   => 'Review',
        'on_delivery' => 'On Delivery',
        'delivered'   => 'Delivered',
        'delay'       => 'Delay',
        'cancel'      => 'Cancel',
    ];

    public const CITY_SELECT = [
        'Ryad'     => 'الرياض',
        'Jaddah'   => 'جده',
        'Elmadina' => 'المدينه',
        'suadia' => 'السعوديه',
        'ay7aga' => 'أي حاجه ',
        "masr"  => ' مصر'
    ];

    protected $fillable = [
        'order_num',
        'client_name',
        'phone_number',
        'phone_number_2',
        'shipping_address',
        'delivery_status',
        'total_cost',
        'discount',
        'shipment_type',
        'city',
        'user_id',
        'product_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class , 'order_id' );    
    }
}