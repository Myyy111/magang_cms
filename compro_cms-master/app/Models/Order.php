<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_id_num',
        'customer_unit',
        'shipping_address',
        'customer_contact',
        'total_amount',
        'shipping_cost',
        'status',
        'wilayah_kerja',
        'unit_kerja_type',
        'unit_kerja_detail',
        'user_status',
        'laptop_serial_number',
        'payment_mechanism',
        'payroll_deduction_periods',
        'signed_document_path',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
