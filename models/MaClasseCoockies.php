<?php

class MaClasseCoockies {

    public static function mafonctioncookie($user_id) {
        $n = 1;

        if (isset($_COOKIE['Visites'.$user_id])) {
            $n = $_COOKIE['Visites'.$user_id] + 1;
        }

        setcookie('Visites'.$user_id, $n, time() + 60 * 60 * 24 * 7, "/");

        $currentDate = date("d-m-Y H:i:s");
        setcookie('date'.$user_id, $currentDate, time() + 60 * 60 * 24 * 7, "/");

        if (isset($_COOKIE["date".$user_id])) {
            $lastVisit = "Vous avez consulté  ".$n." fois et la dernière fois le ".$_COOKIE["date".$user_id].".";
            // Si vous avez besoin de l'heure de la dernière visite, vous pouvez décommenter les lignes suivantes :
            // if (isset($_COOKIE["time".$user_id])) {
            //     $t = date("d-m-Y H:i:s", $_COOKIE["time".$user_id]);
            //     $lastVisit .= " À ".$t.".";
            // }
            return $lastVisit;
        } else {
            return "Vous avez consulté ".$n." fois.";
        }
    }

}

?>
