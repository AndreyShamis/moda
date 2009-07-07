<?

require_once "ajax_win_settings.php";
mysql_query("SET character_set_results=utf8");
$area_id = $_GET[area_id];

$sql = "SELECT * FROM city where area='$area_id' order by NAME_CITY";

$q = mysql_query($sql);
$z = mysql_numrows($q);
if($z == 0){
    ?><input type="text" name="city" />
    <?
}else{
    ?><select name="city" class="selecet_nadlan" onchange="javascript: get('tbl_streets_list.php?city_id=' + this.value,'street_win');"><?
    for($i=0;$i<$z;$i++){
        $f = mysql_fetch_array($q);
        ?><option value="<?=$f[ID]?>" <?
          if($f[id_count]> 1000){
            echo "style=\"color: red;font-weight:bold;background-color: #C7D9FF; \"" ;
          } elseif($f[id_count]> 500 and $f[id_count] < 1001){
            echo "style=\"color: green;font-weight:bold;background-color: #D7E9FF; \"" ;
          }

        ?>><?=$f[NAME_CITY]?></option><?
    }
    ?></select><?
}
?>