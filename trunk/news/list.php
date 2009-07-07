<?

define("NEWS","xml_news_heb");
if(!mysql_connect("localhost", "xml_news_heb", "baraban")){
    echo "<b>Ошибка подключения к MySQL</b>" . NEWS;
    exit;
}

        $sql = "SELECT * FROM tbl_types";

        $q = mysql(NEWS,$sql);
        $z = mysql_numrows($q);
        for($i=0;$i<$z;$i++){
            $f = mysql_fetch_array($q);
            $types[$f[id]] = $f[id_name_heb];
        }

        $sql = "SELECT * FROM tblsites";

        $q = mysql(NEWS,$sql);
        $z = mysql_numrows($q);
        for($i=0;$i<$z;$i++){
            $f = mysql_fetch_array($q);
            $site_name[$f[id]] = $f[id_name];
            $site_link[$f[id]] = $f[id_link];
        }


function Parse_year($str){

    preg_match('/(?<year>[\d]{4})/', $str, $d);
    //print_r($d);

    //echo  "<br />y : " . $d[year] . "<br />";
    return($d[year]);

}
function Parse_Time($str){
    preg_match('/(?<time>[\d]{2}[\:]{1}[\d]{2}[\:]{1}[\d]{2})/', $str, $d);
    return($d[time]);
}
function Parse_Date($str){
    preg_match('/(?<date>[\d]{2}[\/]{1}[\d]{2}[\/]{1}[\d]{4})/', $str, $d);
    return($d[date]);
}
?>

<!--
<table width="100%" border="1">
 <tr>
    <td width="50%"></td>
    <td width="50%"></td>
 </tr>

      <?
        $sql = "SELECT * FROM news order by id desc LIMIT 250";

        //$q = mysql(NEWS,$sql);
        $z = mysql_numrows($q);
        for($i=0;$i<$z;$i++){
            $f = mysql_fetch_array($q);
                //$top = 200 + ( $i * 40) . "px";
                if($i%2 == 0){
                    echo "<tr><td>";
                }
                else{
                    echo "<td>";
                }
?>
<a href="<?=$f[link]?>" target="_blank" style="color: black;"><strong title="<?=$f[title]?>"><?=$f[title]?></strong></a>
<span dir="ltr"><?=$f[id_desc]?></span>
<br />
<small dir="ltr"><?=$f[id_date]?></small>


<?
                if($i%2 == 0){
                    echo "</td>";
                }
                else{
                    echo "</td></tr>";
                }
        }
?>
 </table>

-->
 <table width="100%" bgcolor="#FFFFFF">
   <tr>
     <td width="50%" valign="top"><span>



      <?
        $sql = "SELECT * FROM news order by id desc  LIMIT 50";

        $q = mysql(NEWS,$sql);
        $z = mysql_numrows($q);

        $need = $z / 2;
        $need = (int)($need);
        for($i=0;$i<$z;$i++){
            $f = mysql_fetch_array($q);
            if($i == $need) {
             echo "</span></td><td width=\"50%\" valign=\"top\"><span>" ;
            }

?><div style="border: 1px solid gray;padding: 11px;margin: 12px;">
<a href="<?=$f[link]?>" target="_blank" style="color: black;"><strong title="<?=$f[title]?>"><?=$f[title]?></strong></a>
<span dir="ltr"><?=$f[id_desc]?></span>
<br />
<a  style="color: blue;font-size:12px;" target="_blank" title="<?=$site_name[$f[id_site]]?>" href="<?=$site_link[$f[id_site]]?>"><?=$site_name[$f[id_site]]?></a>&nbsp;&nbsp;
<small dir="ltr" style="color: green;"><?=$f[id_date]?></small>&nbsp;&nbsp;
<small style="color: #ECBB16;"><?=$types[$f[id_type]]?></small>
<br /><br />
<?
echo Parse_year($f[id_date]);
echo "<br /> Time:";
echo Parse_Time($f[id_date]);

echo "<br />Date:";
echo Parse_Date($f[id_date]);
echo "<br />Hren:";
echo strtotime($f[id_date]) . " /// " . gmdate(' H:i:s Y.m.d',strtotime($f[id_date]));
echo "<br /><br /></div>";

        }
?>
</span></td>
</tr>
 </table>
