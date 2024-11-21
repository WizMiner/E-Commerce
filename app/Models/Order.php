<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes',
    ];

      /**
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Ensure this returns a belongsTo relationship
    }

    /**
     * An order has many items.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * An order has one address.
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
