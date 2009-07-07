<?

define("NEWS","xml_news_heb");
if(!mysql_connect("localhost", "xml_news_heb", "baraban")){
    echo "<b>Ошибка подключения к MySQL</b>" . NEWS;
    exit;
}
?>
    <div class="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
    <div class="inner-box"><strong>זמינים חדשות</strong>
    <div class="inner-box2">
     <strong>נא לבחור סוג או אתר חדשות</strong> &nbsp;
     <h3 style="margin: -1px;">מיון לפי סוג</h3>
    <table width="100%" cellpadding="1" cellspacing="1" rules="rows">
<?


  $sql = "SELECT * FROM tbl_types limit 12";
  $q = mysql(NEWS,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    if(!empty($f[id_name_eng])){
    ?>
      <tr>
        <td><a style="color: blue;font-size:14px;" title="<?=$f[id_name_eng]?>"><?=$f[id_name_heb]?></a></td>
      </tr>
<? }}

 ?>
    </table>
     <h3 style="margin: -1px;">מיון לפי אתר</h3>
    <table width="100%" cellpadding="1" cellspacing="1" rules="rows">
<?


  $sql = "SELECT * FROM tblsites limit 15";
  $q = mysql(NEWS,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    if(!empty($f[id_name])){
    ?>
      <tr>
        <td><a style="color: #999933;font-size:14px;padding-right: 9px;" title="<?=$f[id_name]?>"><?=$f[id_name]?></a></td>
      </tr>
<? }}

 ?>
    </table>
    </div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>