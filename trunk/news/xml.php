<?

    include_once "db.php";  

$id =               (int)($_GET[id]);
$act =              $_GET[act];

$site_id =        $_POST[site_id];
$type_id =        $_POST[type_id];
$id_link =        $_POST[id_link];



function Get_Site_name($id){
    $sql = "Select * from tblsites WHERE id='$id' LIMIT 1";
    $r = mysql_query($sql);
    $f = mysql_fetch_array($r);

    return ($f[id_name]) ;
}

function Get_Type_name($id){
    $sql = "Select * from tbl_types WHERE id='$id' LIMIT 1";
    $r = mysql_query($sql);
    $f = mysql_fetch_array($r);

    return ($f[id_name_heb]);
}




if ($act == "del"){
    $sql = "DELETE FROM tblrss where id=$id";
    $r = mysql_query($sql);
        if (mysql_errno() == 0 ){
?>          <div class="main_tr"><strong>מחיקה של אתר אינה עובדת.<.strong></div>
            </div>
<?
        }
        else{
?>
            <div><strong>Ошибка!!!</strong><br />
            К сожалению выполнить удаление не удалось,<br />
            возможно вы не указали всех парамметров. <br />

<?          //<i><?=mysql_error()</i></div>
        }
}

         if($act == "add"){
                $sql = "INSERT INTO tblrss (id_site , id_type,id_link) values ('$site_id','$type_id','$id_link')";
                $r = mysql_query($sql);
                if (mysql_errno() == 0 ){
?>          <div class="main_tr">Создание новой группы</div>
            <div><strong>Добавление прошло успешно.</strong>
            </div>
<?
            }

        else{
?>
            <div><strong>Ошибка!!!</strong><br />
            К сожалению выполнить добавление не удалось,<br />
            возможно вы не указали всех парамметров. <br />

<?          //<i><?=mysql_error()</i></div>
            echo $sql;
        }
        }



    if ($act == "new"){
?>
<div class="main_tr">הוספה של אתר למערכת חדשות</div>
<form method="post" action="?newsr=1&amp;act=add">
<table width="100%">
  <tr>
    <td>
    <select name="site_id">
<?
    $sql = "Select * from tblsites";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
        for ($i=0; $i<$z; $i++){
         $f = mysql_fetch_array($r);
?>

      <option value="<?=$f[id]?>"><?=$f[id_name]?></option>

<?
        }

?>   </select> </td>
    <td><?=$f[id_link]?></td>
  </tr>
  <tr>
    <td>
    <select name="type_id">
<?
    $sql = "Select * from tbl_types";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
        for ($i=0; $i<$z; $i++){
         $f = mysql_fetch_array($r);
?>

      <option value="<?=$f[id]?>"><?=$f[id_name_heb]?> - <?=$f[id_name_eng]?></option>

<?
        }

?>   </select> </td>
    <td><?=$f[id_link]?></td>
  </tr>
  <tr>
    <td>URL</td>
    <td>
        <input dir="ltr" type="text" name="id_link" value="" />
    </td>
  </tr>
  <tr>
    <td colspan="2">
        <input type="submit" value="הוסך" />
    </td>
  </tr>
</table>
</form>
<?
    }


if($act == "save" and !empty($id)){
?>
<div class="main_tr">Приминения изминений</div>
<?
        $sql = "UPDATE tblrss SET id_name='$desc', id_link='$new_value' where id='$id' LIMIT 1";
        $r = mysql_query($sql);
        if (mysql_errno() == 0 ){
?>
            <div><strong>שינוי בוצע בהצלחה</strong>
            </div>
<?
        }
        else{
?>
            <div><strong>Ошибка!!!</strong><br />
            К сожалению выполнить сохранение не удалось,<br />
            возможно вы не указали всех парамметров. <br />

<?          //<i><?=mysql_error()</i></div>
        }
}

if ($act == "change"){
    $sql = "Select * from tblrss where id='$id' LIMIT 1";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
    $f = mysql_fetch_array($r);
?>
<div class="main_tr">Изминение Группы</div>
<form action="?newsr=1&amp;id=<?=$id?>&amp;act=save" method="post">
<table width="100%">
  <tr>
    <td>שם האתר</td>
    <td><strong><?=$f[id_name]?></strong></td>
  </tr>
  <tr>
    <td>שם חדש</td>
    <td><input  type="text" name="desc" maxlength="45" value="<?=$f[id_name]?>" /></td>
  </tr>
  <tr>
    <td>URL</td>
    <td><strong dir="ltr"><?=$f[id_link]?></strong></td>
  </tr>
  <tr>
    <td>URL חדש</td>
    <td><input  dir="ltr" type="text"name="new_value" maxlength="255" value="<?=$f[id_link]?>" /></td>
  </tr>
  <tr>
    <td>לשמירה לחץ כאן</td>
    <td>
        <input type="submit" value="שמור" />
    </td>
  </tr>
</table>
</form>
<?
}
?>
<div class="main_tr">רשימת אתרים</div>
<table width="100%">
  <tr>
    <td>אתר</td>
    <td>סוג</td>
    <td>URL</td>
    <td>לשנות</td>
    <td>מחיקה</td>
  </tr>
<?
    $sql = "Select * from tblrss";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
        for ($i=0; $i<$z; $i++){
         $f = mysql_fetch_array($r);
?>
  <tr>
    <td><a href="?newsr=1&amp;id=<?=$f[id]?>&amp;act=view"><?=Get_Site_name($f[id_site])?></a></td>
    <td><?=Get_Type_name($f[id_type])?></td>
    <td dir="ltr"><?=$f[id_link]?></td>
    <td><input type="button" value="Change" onclick="javascript: if(confirm('Change this site?\n')) (window.location='?newsr=1&amp;id=<?=$f[id]?>&amp;act=change');" /></td>
    <td><input type="button" value="Delete" onclick="javascript: if(confirm('Are you sure if you want delete this site?\n')) (window.location='?newsr=1&amp;id=<?=$f[id]?>&amp;act=del');" /></td>
  </tr>

<?
        }
?>
    <tr>
        <td colspan="4">
            <form method="post" action="?newsr=1&amp;act=new">
                <input type="submit" value="להוסיף אתק חדשות" />
            </form>
        </td>
    </tr>
</table>
<a href="http://lolnik.ath.cx/moda/xml_parser/m.php" target="_blank">Parse</a>
