<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nutrient extends Model
{
    use HasFactory;

    public function index($id)
    {
        $food = DB::table('basis')->find($id);
        return $food;
    }
    public function calculate($foodNutrient, $num)
    {
        $name          = $foodNutrient->name;
        $calorie       = $foodNutrient->calorie;
        $carbohydrates = $foodNutrient->carbohydrates;
        $protein       = $foodNutrient->protein;
        $lipid         = $foodNutrient->lipid;
        $sugar         = $foodNutrient->sugar;
        $fiber         = $foodNutrient->fiber;

        $calorie       = $calorie       * $num;
        $carbohydrates = $carbohydrates * $num;
        $protein       = $protein       * $num;
        $lipid         = $lipid         * $num;
        $sugar         = $sugar         * $num;
        $fiber         = $fiber         * $num;

        $nutrientSum = array
            (
                'name'          => $name,
                'calorie'       => $calorie,
                'carbohydrates' => $carbohydrates,
                'protein'       => $protein,
                'lipid'         => $lipid,
                'sugar'         => $sugar,
                'fiber'         => $fiber,
            );

        return $nutrientSum;
    }
}
