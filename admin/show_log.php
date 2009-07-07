<table border="1" dir="ltr" width="100%"><tr>
<td>Time</td>
<td>Script</td>
<td>Err</td>
<td>Log </td>
</tr>
<?

  $sql = "SELECT * FROM tbllog order by id desc LIMIT 40";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
     ?>
  <tr>
<td valign="top"><?=gmdate(' H:i:s  Y/m/d',$f[id_time])?></td>
<td valign="top"><?=$f[id_script]?></td>
<td valign="top"><?=$f[id_errors]?></td>
<td width="60%"><?=$f[id_log]?></td>
</tr>
     <?
    }
?></table>