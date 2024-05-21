<?php

function mafonctioncookie(){

    $n =$_COOKIE['Visites']+1;
    $t=setcookie("time",time());

    $curentdate=date(("d-m-Y H:i:s"));
    setcookie("date",$curentdate);

 setcookie("Visites",$n   ,time()+ 60*60*24*7,"/",);
 
 

 if (isset($_COOKIE["date"])) {
    if (isset($_COOKIE["time"])) {
        return "Vous avez consulté ".$n." fois la dernière fois le ".$curentdate." à ".$t.".";
    } else {
        return "Vous avez consulté ".$n." fois et la dernière fois le ".$curentdate.".";
    }
} else {
    return "Vous avez consulté ".$n." fois.";
}

}

?>