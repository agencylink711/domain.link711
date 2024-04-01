<?php

namespace App\Enums;

enum BillingPeriods: int
{
    case DAILY = 1;
    case WEEKLY = 7;
    case MONTHLY = 30;
    case YEARLY = 365;

    public function label()
    {
        return match ($this) {
            static::DAILY => 'Daily',
            static::WEEKLY => 'Weekly',
            static::MONTHLY => 'Monthly',
            static::YEARLY => 'Yearly',
        };
    }
}
