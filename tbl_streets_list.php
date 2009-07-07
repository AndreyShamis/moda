<?

require_once "ajax_win_settings.php";
mysql_query("SET character_set_results=utf8");
$city_id = $_GET[city_id];
$sql = "SELECT * FROM streetlist where ID_CITY='$city_id' order by STREET";
$q = mysql_query($sql);
$z = mysql_numrows($q);
if($z == 0){
    ?><input type="text" name="street" />
    <?
}else{
    ?><select name="city" size="1" class="selecet_nadlan"> <?
    for($i=0;$i<$z;$i++){
        $f = mysql_fetch_array($q);
        ?><option value="<?=$f[ID]?>"><?=$f[STREET]?></option><?
    }
    ?></select><?
}
?>