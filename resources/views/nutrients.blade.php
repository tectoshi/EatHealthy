<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>nutrients</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>



</head>
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
    <div class="bg-white border rounded shadow">
        <div class="border-b p-3">
            <h5 class="font-bold uppercase text-gray-600">プロフィール</h5>
        </div>
            性別：{{$sex}}
            体重：{{Auth::user()->weight}}kg
            年齢：{{$age}}歳
            身長：{{Auth::user()->height}}cm
            標準体重：{{$bestWeight}}kg
            BMI：{{$BMI}}
    </div>
</div>



<div class="w-full md:w-1/2 xl:w-1/3 p-3">
    <!--Graph Card-->
    <div class="bg-white border rounded shadow">
        <div class="border-b p-3">
            <h5 class="font-bold uppercase text-gray-600">{{ date("m月d日",strtotime($fromTo[0])) }}(月)　～　{{ date("m月d日",strtotime($fromTo[1])) }}(日)の摂取量</h5>
        </div>
        <div class="border-b p-3">
        <div class="p-5"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <canvas id="chartjs-1" class="chartjs chartjs-render-monitor" width="397" height="198" style="display: block; height: 159px; width: 318px;"></canvas>
            <script>
                new Chart(document.getElementById("chartjs-1"), {
                    "type": "bar",
                    "data": {
                        "labels": ["カロリー", "炭水化物", "タンパク質", "脂質", "糖質", "食物繊維"],
                        "datasets": [{
                            "label": "Likes",
                            "data": [{{floor($comparison['calorie'])}},
                                     {{floor($comparison['carbohydrates'])}},
                                     {{floor($comparison['protein'])}},
                                     {{floor($comparison['lipid'])}},
                                     {{floor($comparison['sugar'])}},
                                     {{floor($comparison['fiber'])}}],
                            "fill": false,
                            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)"],
                            "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)"],
                            "borderWidth": 1
                        }]
                    },
                    "options": {
                        "scales": {
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
        </div>
            <list>カロリー：{{round($nutrientsWeekSum['calorie'],1)}} / {{round($targetNutrients['calorie'],1)}} kcal</list><br>
            <list>炭水化物：{{round($nutrientsWeekSum['carbohydrates'],1)}} / {{round($targetNutrients['carbohydrates'],1)}} g</list><br>
            <list>タンパク質：{{round($nutrientsWeekSum['protein'],1)}} / {{round($targetNutrients['protein'],1)}} g</list><br>
            <list>脂質：{{round($nutrientsWeekSum['lipid'],1)}} / {{round($targetNutrients['lipid'],1)}} g</list><br>
            <list>糖質：{{round($nutrientsWeekSum['sugar'],1)}} / {{round($targetNutrients['sugar'],1)}} g</list><br>
            <list>食物繊維：{{round($nutrientsWeekSum['fiber'],1)}} / {{round($targetNutrients['fiber'],1)}} g</list><br>
    </div>
    <!--/Graph Card-->
</div>

<div class="w-full md:w-1/2 xl:w-1/3 p-3">
    <!--Graph Card-->
    <div class="bg-white border rounded shadow">
        <div class="border-b p-3">
            <h5 class="font-bold uppercase text-gray-600">購入履歴</h5>

        </div>
    </div>
    <!--/Graph Card-->
</div>

<script>
    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    var userMenuDiv = document.getElementById("userMenu");
    var userMenu = document.getElementById("userButton");

    var navMenuDiv = document.getElementById("nav-content");
    var navMenu = document.getElementById("nav-toggle");

    document.onclick = check;

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //User Menu
        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else { userMenuDiv.classList.add("invisible"); }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");
            }
        }

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {
                // click on the link
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else { navMenuDiv.classList.add("hidden"); }
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add("hidden");
            }
        }

    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) { return true; }
            t = t.parentNode;
        }
        return false;
    }
</script>

