<?
mysql_query("SET character_set_results=utf8");


?>
<script language="javascript" type="text/javascript" >

  function addquestion(){
    if(document.getElementById("price").value.length > 2){

    }else{
        document.getElementById("price").focus();
    }
    if(document.getElementById("quest").value != ""){

    }else{
        document.getElementById("quest").focus();
    }
    if(document.getElementById("keywords").value != ""){

    }else{
        document.getElementById("keywords").focus();
    }

            document.vioask.submit();
  }
</script>
<form id="add_nadlan">
<table width="0" border="1" bordercolor="#99CCFF" bordercolorlight="#CCFFFF" bordercolordark="#3399FF">
  <tr>
    <td>תבחר סוג הכנס</td>
    <td>
    <select name="nadlan_type" size="1" class="selecet_nadlan">
  <?
  $sql = "SELECT * FROM tbl_nadlan_type";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    ?>
    <option value="<?=$f[id]?>"><?=$f[id_name]?></option>
    <? } ?>
    </select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>מספר חדרים</td>
    <td><select name="rooms" size="1">
  <?
    for($i=1;$i<10;$i++){
    ?>
    <option value="<?=$i?>"><?=$i?></option>
    <? } ?>
    </select></td>
    <td>בגלל שחדר הוא יחידה לא קיימת אופציה לבחור חצי חדר</td>
  </tr>
  <tr>
    <td>אזור </td>
    <td><select name="city" class="selecet_nadlan" onchange="javascript: get('tbl_city_list.php?area_id=' + this.value,'city_win');">   <?
  $sql = "SELECT * FROM tblarea order by id_count desc";
  $q = mysql(DBName,$sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    ///$sql = "INSERT INTO tblarea (id_value) values('$f[area]')";
    //mysql(DBName,$sql);
    ?>
    <option value="<?=$f[id_value]?>"><?=$f[id_name]?> (<?=$f[id_value]?>)</option>
    <? } ?></select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ישוב </td>
    <td>&nbsp;<span id="city_win"></span></td>
    <td> &nbsp;</td>
  </tr>
  <tr>
    <td>נא לבחור רחוב לאחר שבחרת עיר</td>
    <td>&nbsp;<span id="street_win"></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>קומה</td>
    <td><select name="flor" size="1">
  <?
    for($i=1;$i<100;$i++){
    ?>
    <option value="<?=$i?>"><?=$i?></option>
    <? } ?>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>מחיר</td>
    <td><input type="text" id="price" name="price" value="<?=$price?>" class=""  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>תאריך כניסה</td>
    <td>
        תאריך<input type="radio" name="date" value="1" checked="checked" onclick="document.getElementById('taarih').style.visibility = 'visible'" />&nbsp;&nbsp;
    <span id="taarih" >
        <select name="day" id="day">
  <?
    for($i=1;$i<32;$i++){
    ?>
    <option value="<?=$i?>"><?=$i?></option>
    <? } ?>
        </select>
        <select name="month">
  <?
    for($i=1;$i<13;$i++){
    ?>
    <option value="<?=$i?>"><?=$i?></option>
    <? } ?>
        </select>
        <select name="year">
  <?
    for($i=2009;$i<2015;$i++){
    ?>
    <option value="<?=$i?>"><?=$i?></option>
    <? } ?>
        </select>
    </span>
        <br />
        מיידי<input type="radio" name="date" value="2" onclick="document.getElementById('taarih').style.visibility = 'hidden'" />

    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="text" name="" value="<?=7?>" class=""  /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>