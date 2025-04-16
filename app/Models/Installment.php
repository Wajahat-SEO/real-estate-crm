<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = [
        'customer_id', 'plot_id', 'amount_paid', 'installment_date',
    ];

    // Define relationships if necessary
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

