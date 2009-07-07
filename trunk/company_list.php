 <table border="1">
   <tr>
     <td>Time</td>
     <td>שם חברה</td>
     <td>רייטינג</td>
     <td>Log </td>
   </tr>
<?
mysql_query("SET character_set_results=utf8");
  $sql = "SELECT * FROM tblcompany";
  $q = mysql_query($sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
     ?>

   <tr>
     <td valign="top"><?=$f[id]?></td>
     <td valign="top"><?=$f[name]?></td>
     <td valign="top"><?=$f[id_rating]?></td>
     <td width="80%"></td>
   </tr>



     <?


    }

?>
</table>