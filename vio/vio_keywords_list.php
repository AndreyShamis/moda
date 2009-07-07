    <div class="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
    <div class="inner-box"><strong>מילות מפתח</strong>
    <div class="inner-box2"> <br />
    <table width="200px" cellpadding="1" cellspacing="1" rules="rows" style="table-layout: fixed;">
<?


  $sql = "SELECT * FROM tbl_vio_keywords order by id_found DESC limit 10";
  $q = mysql_query($sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    ?>
      <tr>
        <td><a title="<?=$f[id_key]?>"  href="?vio=key&amp;id=<?=$f[id]?>&amp;act=key" ><?=$f[id_key]?></a></td>
        <td><strong><?=$f[id_found]?></strong></td>

      </tr>
<? } ?>
    </table>
    </div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>