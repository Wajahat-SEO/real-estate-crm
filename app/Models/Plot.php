<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model {
    use HasFactory;

    protected $fillable = ['block_id', 'plot_number', 'total_price', 'size', 'status'];

    public function block() {
        return $this->belongsTo(Block::class);
    }
}


