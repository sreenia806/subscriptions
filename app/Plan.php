<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plans';
    protected $fillable = ['code', 'name', 'monthly_cost', 'yearly_cost'];
}
