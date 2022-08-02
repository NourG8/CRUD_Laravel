<?php

namespace App\Models;
use App\Models\Film;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function films()
{
    return $this->hasMany(Film::class);
}

}
