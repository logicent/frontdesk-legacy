<?php

use Carbon\Carbon;

class Datehelper
{
    public static function currentTime()
    {
        return Carbon::now();
    }

    public static function todayDate()
    {
        return Carbon::today();
    }

    public static function tomorrowDate()
    {
        return Carbon::tomorrow();
    }

    public static function yesterdayDate()
    {
        return Carbon::yesterday();
    }

    public static function addHoursToDay($dayDateParts, $hrs)
    {
        $dt = Carbon::create($dayDateParts);
        return $dt->addHours($hrs);
    }
}
