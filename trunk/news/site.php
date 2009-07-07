<?

    include_once "db.php";  

$id =               (int)($_GET[id]);
$act =              $_GET[act];

$desc =             $_POST[desc];
$new_value =        $_POST[new_value];

if ($act == "del"){
    $sql = "DELETE FROM tblsites where id=$id";
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
                $sql = "INSERT INTO tblsites (id_name , id_link) values ('$desc','$new_value')";
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
<form method="post" action="?newss=1&amp;act=add">
<table width="100%">
  <tr>
    <td>שם האתר </td>
    <td>
        <input type="text" name="desc" value="" />
    </td>
  </tr>
  <tr>
    <td>לונק לעמוק ראשי <em>לדוגמה <span dir="ltr">http://www.yoursite.com</span></em></td>
    <td><input dir="ltr" type="text" name="new_value" value="" /></td>
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
        $sql = "UPDATE tblsites SET id_name='$desc', id_link='$new_value' where id='$id' LIMIT 1";
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
    $sql = "Select * from tblsites where id='$id' LIMIT 1";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
    $f = mysql_fetch_array($r);
?>
<div class="main_tr">Изминение Группы</div>
<form action="?newss=1&amp;id=<?=$id?>&amp;act=save" method="post">
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
    <td>שם</td>
    <td>URL</td>
    <td>לשנות</td>
    <td>מחיקה</td>
  </tr>
<?
    $sql = "Select * from tblsites";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
        for ($i=0; $i<$z; $i++){
         $f = mysql_fetch_array($r);
?>
  <tr>
    <td><a href="?newss=1&amp;id=<?=$f[id]?>&amp;act=view"><?=$f[id_name]?></a></td>
    <td dir="ltr"><?=$f[id_link]?></td>
    <td><input type="button" value="Change" onclick="javascript: if(confirm('Change this site?\n')) (window.location='?newss=1&amp;id=<?=$f[id]?>&amp;act=change');" /></td>
    <td><input type="button" value="Delete" onclick="javascript: if(confirm('Are you sure if you want delete this site?\n')) (window.location='?newss=1&amp;id=<?=$f[id]?>&amp;act=del');" /></td>
  </tr>

<?
        }
?>
    <tr>
        <td colspan="4">
            <form method="post" action="?newss=1&amp;act=new">
                <input type="submit" value="להוסיף אתק חדשות" />
            </form>
        </td>
    </tr>
</table>
