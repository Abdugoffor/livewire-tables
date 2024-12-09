<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prostoy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'client_id',
        'carrier_id',
        'sales_id',
        'operation_id',
        'carrier_amount',
        'carrier_currency',
        'client_amount',
        'client_currency',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function carrier()
    {
        return $this->belongsTo(User::class, 'carrier_id');
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function operation()
    {
        return $this->belongsTo(User::class, 'operation_id');
    }
    
}
