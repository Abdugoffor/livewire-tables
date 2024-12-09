<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherExpense extends Model
{
    protected $fillable = [
        'order_id',
        'supplier_id',
        'reason_id',
        'currency',
        'amount',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class, 'reason_id');
    }
}
