<?php

namespace App\Models;

use App\Enums\BillingPeriods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'billing_period' => BillingPeriods::class
    ];
}
