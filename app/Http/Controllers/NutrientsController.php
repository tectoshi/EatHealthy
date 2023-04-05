<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Nutrient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NutrientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $id = Auth::id();
        $userModel = new User();
        $fromTo = $this->thisWeek();
        $nutrientsWeekSum = $this->getNutrientsSum($fromTo);
        $age = $userModel->getAge($id);
        $sex = $userModel->getSex($id);
        $BMI = $userModel->getBMI($id);
        $bestWeight = $userModel->getBestWeight($id);
        $targetNutrients = $this->targetNutrients($age);
        $comparison = $this->comparisonNutrients($nutrientsWeekSum, $targetNutrients);
        return view('nutrients',compact('fromTo','comparison','age','sex','BMI','bestWeight','nutrientsWeekSum','targetNutrients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $nutrientModel = new Nutrient();
        $id = $request['food_id'];
        $num = $request['food_num'];
        $date = $request['date'];
        $foodNutrient = $nutrientModel->findOne($id);
        $nutrientSum = $nutrientModel->calculate($foodNutrient, $num);
        $nutrientSum['number'] = $num;
        $nutrientSum['date'] = $date;
        $userId = Auth::id();
        $nutrientSum['user_id'] = $userId;
        Nutrient::insert($nutrientSum);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function thisWeek()
    {
        $weekConfig = [0=>'日',1=>'月',2=>'火',3=>'水',4=>'木',5=>'金',6=>'土'];
        $today = date('Y-m-d');
        $thisWeekDay = date('w',strtotime($today));
        if($thisWeekDay === '0')
        {
            $thisWeekDay = '7';
        }
        $lastSunday = date("Ymd",strtotime("-".$thisWeekDay."day", strtotime($today)));
        $thisMonday = date("Ymd",strtotime("+1 day",strtotime($lastSunday)));
        $thisSunday = date("Ymd",strtotime("+6 day",strtotime($thisMonday)));
        return [$thisMonday, $thisSunday];
    }

    public function getNutrientsSum($fromTo)
    {
        $nutrients = Nutrient::whereBetween('date', $fromTo)->get();
        $calorieSum       = 0;
        $carbohydratesSum = 0;
        $proteinSum       = 0;
        $lipidSum         = 0;
        $sugarSum         = 0;
        $fiberSum         = 0;
        foreach($nutrients as $nutrient)
        {
            $calorieSum       += $nutrient['calorie'];
            $carbohydratesSum += $nutrient['carbohydrates'];
            $proteinSum       += $nutrient['protein'];
            $lipidSum         += $nutrient['lipid'];
            $sugarSum         += $nutrient['sugar'];
            $fiberSum         += $nutrient['fiber'];
        }
        return array
        (
            'calorie'       => $calorieSum,
            'carbohydrates' => $carbohydratesSum,
            'protein'       => $proteinSum,
            'lipid'         => $lipidSum,
            'sugar'         => $sugarSum,
            'fiber'         => $fiberSum
        );
    }

    public function targetNutrients($age)
    {
        if (Auth::user()->sex === 1)
        {
            $calorie = (13.397 * Auth::user()->weight + 4.799 * Auth::user()->height - 5.677 * $age + 88.632) * 7 * 1.75;
            $carbohydrates = 310 * 7;
            $protein       = 65 * 7;
            $lipid         = 55 * 7;
            $sugar         = 330 * 7;
            $fiber         = 21 * 7;
        }elseif (Auth::user()->sex === 2)
        {
            $calorie = (9.247 * Auth::user()->weight + 3.098 * Auth::user()->height - 4.33 * $age + 447.593) * 7 * 1.75;
            $carbohydrates = 270 * 7;
            $protein       = 50 * 7;
            $lipid         = 45 * 7;
            $sugar         = 270 * 7;
            $fiber         = 18 * 7;
        }
        return array(
            'calorie'       => $calorie,
            'carbohydrates' => $carbohydrates,
            'protein'       => $protein,
            'lipid'         => $lipid,
           'sugar'          => $sugar,
            'fiber'         => $fiber
        );
    }

    public function comparisonNutrients($nutrientsWeekSum,$targetNutrients)
    {
        $calorie       = $nutrientsWeekSum['calorie'] / $targetNutrients['calorie'] * 100;
        $carbohydrates = $nutrientsWeekSum['carbohydrates'] / $targetNutrients['carbohydrates'] * 100;
        $protein       = $nutrientsWeekSum['protein'] / $targetNutrients['protein'] * 100;
        $lipid         = $nutrientsWeekSum['lipid'] / $targetNutrients['lipid'] * 100;
        $sugar         = $nutrientsWeekSum['sugar'] / $targetNutrients['sugar'] * 100;
        $fiber         = $nutrientsWeekSum['fiber'] / $targetNutrients['fiber'] * 100;
        return array(
            'calorie'       => $calorie,
            'carbohydrates' => $carbohydrates,
            'protein'       => $protein,
            'lipid'         => $lipid,
            'sugar'         => $sugar,
            'fiber'         => $fiber
        );
    }

}

