<?php

namespace App\Models;

use App\Enums\OrderStatusEnums;
use App\Enums\PaymentMethodEnums;
use App\Enums\PaymentStatusEnums;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
        'shipping_address',
        'shipping_country',
        'shipping_state',
        'shipping_postal_code',
        'payment_method',
        'payment_status',
        'cc_number',
        'cc_expiration',
    ];

    protected $casts = [
        'total_price' => 'integer',
        'status' => OrderStatusEnums::class,
        'payment_method' => PaymentMethodEnums::class,
        'payment_status' => PaymentStatusEnums::class,
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order) {
            $order->status = OrderStatusEnums::PENDING;
            $order->payment_status = PaymentStatusEnums::PENDING;
            $order->cc_number = Str::mask($order->cc_number, '*', 0, 12);
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }
}
