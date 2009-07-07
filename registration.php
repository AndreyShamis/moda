<?
    $user_nick = $_POST[user_nick];
    $user_name = $_POST[user_name];
    $user_fam = $_POST[user_fam];
    $user_pass = $_POST[user_pass];
    $user_mail = $_POST[user_mail];
    $pass_md5 = md5($user_pass);
    if(!empty($user_nick) and !empty($user_pass)){
    $sql = "INSERT INTO tblusers(id_name,id_pass,id_fname,id_lname,id_mail,id_pol) VALUES
    ('".$user_nick."','".$pass_md5."','".$user_name."','".$user_fam."','".$user_mail."','".$_POST[min]."')";
        mysql_query($sql);
        if(mysql_errno() != 0){
            echo mysql_error();
        }
    }

?> <form method="post">
<table width="100%">
  <tr>
    <td>שם משתמש</td>
    <td><input name="user_nick" value="<?=$user_nick?>" maxlength="50" /></td>
  </tr>
  <tr>
    <td>שם פרטי</td>
    <td><input name="user_name" value="<?=$user_name?>" maxlength="50" /></td>
  </tr>
  <tr>
    <td>שם משפחה</td>
    <td><input name="user_fam" value="<?=$user_fam?>" maxlength="50" /></td>
  </tr>
  <tr>
    <td>סיסמה</td>
    <td><input name="user_pass" value="<?=$user_pass?>" maxlength="50" /></td>
  </tr>
  <tr>
    <td>דואר אלקטרוני</td>
    <td><input name="user_mail" value="<?=$user_mail?>" maxlength="100" /></td>
  </tr>
  <tr>
    <td>מין</td>
    <td>
    <input type="radio" name="min" value="1" id="man" /> <strong>זכר</strong>
    <input type="radio" name="min" value="2"  id="woman" /> <strong>נכבה</strong>
    </td>
  </tr>

</table>
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;<input type="submit" style="width:200px;color: #222Bca;font-size: 16px;font-weight: bold;" value="הרשמה" />
</form>