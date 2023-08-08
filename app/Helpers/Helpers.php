<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function getFormattedDate($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year;
    return $new_date_format;
}

function getFormattedTime($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    if (Str::length($new_date->minute) == 1) {
        $prefix = '0';
    } else {
        $prefix = '';
    }
    $new_date_format = $new_date->hour . ' h ' . $prefix . $new_date->minute . ' min ';
    return $new_date_format;
}

function getFormattedDateTime($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    if (Str::length($new_date->minute) == 1) {
        $prefix = '0';
    } else {
        $prefix = '';
    }
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year . ' à ' . $new_date->hour . 'h' . $prefix . $new_date->minute . 'min';
    return $new_date_format;
}

function getDateDiff($originalTime, $targedTime)
{
    $originalTime = new DateTimeImmutable($originalTime);
    $targedTime = new DateTimeImmutable($targedTime);
    $interval = $originalTime->diff($targedTime);
    $interval = $interval->format("%a");
    return intval($interval);
}
