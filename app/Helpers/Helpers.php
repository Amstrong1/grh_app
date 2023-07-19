<?php

use Carbon\Carbon;

function getFormattedDate($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year;
    return $new_date_format;
}

function getFormattedDateTime($date): String
{
    Carbon::setLocale('fr');
    $new_date = Carbon::createFromDate($date);
    $new_date_format = $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year . ' à ' . $new_date->hour . 'h' . $new_date->minute;
    return $new_date_format;
}
