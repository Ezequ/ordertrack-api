<?php
class DatesHelper
{

    public static function getAllYearWeeks()
    {
        $weeks = array();
        $year           = 2016;
        $firstDayOfYear = mktime(0, 0, 0, 1, 1, $year);
        $sunday     = strtotime('sunday', $firstDayOfYear);
        $saturday     = strtotime('saturday', $sunday);
        $it = 1;
        while (date('Y', $sunday) == $year) {
            $weeks[date('Y-m-d',$sunday)] = "Semana {$it} - " . date('d-m-Y',$sunday) . " a " . date('d-m-Y',$saturday);
            $sunday = strtotime('+1 week', $sunday);
            $saturday = strtotime('+1 week', $saturday);
            $it++;
        }
        return $weeks;
    }
}