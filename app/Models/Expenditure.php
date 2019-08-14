<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $fillable = [
    	'user_id', 'title', 'description', 'expenditure_time', 'expenditure_money', 'pic', 'pay_type', 'cart'
    ];
}
