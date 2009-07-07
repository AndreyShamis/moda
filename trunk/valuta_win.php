    <div class="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
    <div class="inner-box"><strong>שערי חליפין יציגים</strong>
    <div class="inner-box2">
     שערי חליפין  <strong>בנק ישראל</strong> &nbsp;  <span id="valute_date"></span>
    <table width="200px" cellpadding="1" cellspacing="1" rules="rows" style="table-layout: fixed;">
<?

mysql_query("SET character_set_results=utf8");

  $sql = "SELECT * FROM tblvaluta order by rating limit 6";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    $valute_date = gmdate('m/d',$f[id_time]);
    //$valute_date = gmdate('H:i Y.m.d',$f[id_time]);
    ?>
      <tr>
        <td><a title="<?=$f[id_country]?> שם מטבע " target="_blank" href="graf.php?w=1200&amp;v=800&amp;show_x=1&amp;vtype=<?=$f[id_kratko]?>" ><?=$f[id_heb_name]?></a></td>
        <td><strong><?=$f[id_price]?></strong></td>
        <td style="direction: ltr;text-align:right;<?
          if($f[id_change]<0){
            echo "color: red;";
          }else{
            echo "color: green;";
          }
        ?>"><?=$f[id_change]?></td>
        <td><?=$f[id_kratko]?></td>
      </tr>
<? }
mysql_query("SET character_set_results=latin1");
 ?>
    </table>
<script language="javascript" type="text/javascript" >
document.getElementById("valute_date").innerHTML = "<?=$valute_date?>";
</script>
    </div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>