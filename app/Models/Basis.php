<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Basis extends Model
{
    use HasFactory;

    public function pullDownFoods()
    {
        $foods = DB::table('basis')->pluck('name');
        return $foods;
    }
}
