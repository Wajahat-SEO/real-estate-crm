<?php

namespace App\Models;

use App\Models\Plot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'total_plots'];

        public function plots()
    {
        return $this->hasMany(Plot::class);
    }

}
