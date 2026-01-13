<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Puede ser null si es compra de invitado
        'customer_name', // Nuevo: Para la factura
        'customer_phone', // Nuevo: Para WhatsApp
        'customer_email',
        'total',
        'status',
    ];

    // Relación vital para la factura
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}