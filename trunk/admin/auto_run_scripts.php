<table dir="ltr" width="100%" rules="rows">
  <tr>
    <td>&nbsp;ID</td>
    <td>Name of Script</td>
    <td>Link</td>
    <td>Interval</td>
    <td>&nbsp;&nbsp;&nbsp;Last Run</td>
    <td>Nezt Run</td>
    <td>Next Time</td>
  </tr>
<?

  $sql = "SELECT * FROM tblzadaniya";
  $q =mysql(DBName,$sql);
  $z = mysql_numrows($q);
  for($i=0;$i<$z;$i++){

  $f = mysql_fetch_array($q);
  $interval = ((int)($f[id_interval])) / 60;
?>  <tr style="border-bottom-style:1px solid;border-bottom-color: #99CCCC;">
    <td><?=$f[id]?></td>
    <td><?=$f[id_name]?></td>
    <td><?=$f[id_link]?></td>
    <td style="text-align:right;">[<?=$interval?> min] </td>
    <td>&nbsp;&nbsp;<?=gmdate('m/d H:i:s',$f[id_last])?></td>
    <td>&nbsp;&nbsp;<?=gmdate('m/d H:i:s',$f[id_next])?></td>
    <td><?=$f[id_prinuditelno]?></td>
  </tr>
<?
  }
?>
</table>