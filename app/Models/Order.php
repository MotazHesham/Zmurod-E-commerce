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
        'normal shipment cost' => 'normal shipment cost',
        'fast shipment cost'   => 'fast shipment cost',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'Pending',
        'on_review'   => 'on Review',
        'on_delivery' => 'on Delivery',
        'delivered'   => 'Delivered',
        'delay'       => 'Delay',
        'cancel'      => 'Cancel',
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
        'area_code',
        'user_id',
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
}
