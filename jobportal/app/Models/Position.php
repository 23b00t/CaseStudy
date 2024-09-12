<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    // Define realtionship to company to have acces to position->company
    // in combination with eager loading in the PositionController
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
