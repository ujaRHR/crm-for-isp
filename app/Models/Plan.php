<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'plan_img', 'billing_cycle', 'uspeed', 'dspeed', 'limit', 'description'];
}
