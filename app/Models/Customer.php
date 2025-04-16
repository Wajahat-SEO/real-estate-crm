<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 


class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'block_id', 'plot_id', 'cnic'];


    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
    
        public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }
   // Automatically generate UUID before creating the customer
   protected static function booted()
   {
    static::creating(function ($customer) {
        if (!$customer->uuid) {  // Check if the uuid is not already set
            $customer->uuid = Str::uuid();  // Generate UUID
        }
    });
   }

    // Tell Laravel to use 'uuid' instead of 'id'
    public function getRouteKeyName()
    {
        return 'uuid';
    }

}
