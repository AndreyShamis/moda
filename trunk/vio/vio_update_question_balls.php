<?
//include "../ajax_win_settings.php";
//include "ajax_win_settings.php";


    $sql = "SELECT count(*),id_question,sum(id_ball) as id_question FROM tblvio_questions_balls GROUP BY id_question";
    $q = mysql_query($sql);
    $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
        $f = mysql_fetch_array($q);
         //print_r($f);
         //echo$f['count(*)'] ."<br />";
         //echo$f[1] ."<br />";
         //echo$f[2] ."<br /><br /><br />";
         // FORMULA RAZSHETA
         // Summa / koolichestvo
         $q_Ball = 20*round($f[2] / $f[0],3);
         //echo $q_Ball ."<br />   &nbsp;&nbsp;&nbsp;SUM:$f[2] / Count:$f[0]<br /><br />";
         $sql = "UPDATE tblquestions SET id_rating='$q_Ball' WHERE id= '".$f[1]."' LIMIT 1";
         mysql_query($sql);
    }

?>