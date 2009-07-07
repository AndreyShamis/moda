<?
include "ajax_win_settings.php";


  $sql = "SELECT * FROM tblarea";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
        $sql = "SELECT id,area FROM city where area='" . $f[id_value] . "'";
        $qcity = mysql(DBName,$sql);
        $zcity = mysql_numrows($qcity);
        $sql = "UPDATE tblarea SET id_count='$zcity' where id_value='$f[id_value]'";
        mysql(DBName,$sql);
    }
  $q = null;
  $z = null;
  $f = null;
  $sql = "SELECT * FROM city";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
        $sql = "SELECT ID_CITY FROM streetlist where ID_CITY='$f[ID]'";
        $qstreet = mysql(DBName,$sql);
        $zstreet = mysql_numrows($qstreet);
       // echo  $zstreet ."<br />" . $sql;
        $sql = "UPDATE city SET id_count='$zstreet' where ID='$f[ID]'";
        mysql(DBName,$sql);
        //echo mysql_error();
    }
?>