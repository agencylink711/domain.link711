<?php

namespace Database\Seeders;

use App\Enums\BillingPeriods;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Plan::create([
            'name' => 'Free',
            'description' => 'Free plan',
            'price' => 0,
            'duration' => '12',
            'billing_period' => BillingPeriods::DAILY,
            'api_calls' => '5',
        ]);
        Plan::create([
            'name' => 'Bronze',
            'description' => 'Bronze plan',
            'price' => 10,
            'duration' => '12',
            'billing_period' => BillingPeriods::MONTHLY,
            'api_calls' => '10',
        ]);
    }
}
