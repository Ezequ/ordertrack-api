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

    public static function getDatesColumnsSchedule($from,$to)
    {
        $columns = array();
        $day = $from;
        $it = 0;
        $columns[$day]['name'] = self::getNameByDate($day);
        $columns[$day]['customers'] = array();
        do{
            $day = date('Y-m-d', strtotime($day . ' +1 day'));
            $columns[$day]['name'] = self::getNameByDate($day);
            $columns[$day]['customers'] = array();
            $it++;
            if ($it > 8) break;
        }while($day !=  $to);
        return $columns;
    }

    public static function getNameByDate($day)
    {
        $fechats = strtotime($day); //a timestamp
        switch (date('w', $fechats)){
            case 0: return "Domingo"; break;
            case 1: return "Lunes"; break;
            case 2: return "Martes"; break;
            case 3: return "Miércoles"; break;
            case 4: return "Jueves"; break;
            case 5: return "Viernes"; break;
            case 6: return "Sábado"; break;
        }
    }
}