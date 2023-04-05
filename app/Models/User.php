<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'height',
        'weight',
        'sex',
        'birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAge($id)
    {
        $today = date('Ymd');

        // 誕生日
        $birthday = DB::table('users')->where('id', $id)->value('birth');

        $birthday = str_replace("-", "", $birthday);
        // 年齢
        return floor(($today - $birthday) / 10000);
    }

    public function getSex($id)
    {
        $sex = Auth::user()->sex;
        if ($sex === 1) {
            return '男性';
        } elseif ($sex === 2) {
            return '女性';
        }
    }

    public function getBestWeight($id)
    {
        $height = Auth::user()->height;
        return round(($height/100)**2 * 22,1);
    }
    public function getBMI($id)
    {
        $height = Auth::user()->height;
        $weight = Auth::user()->weight;
        return round($weight / ($height/100)**2, 2);
    }
}
