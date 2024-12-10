<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherExpense extends Model
{
    use SoftDeletes;
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
