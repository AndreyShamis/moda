<?

include "db.php";
include "function.php";
		$ima = hack(@$_POST["name"]);
		$pass = hack(@$_POST[pass]);
	if ($ima!="" and $pass !=""){
        $pass_md5 = md5($_POST[pass]);

        $sql = "SELECT id,id_pass,id_name FROM tblusers where lower(id_name)=lower('$ima') LIMIT 1";
		$r=@mysql_query($sql);
		$z = mysql_numrows($r);
		if ($z == 0) {
		    $err .="שם משתמש לא קיים<br />\n";
		}
		elseif($z == 1){
        $f = mysql_fetch_array($r);
        $id = $f[id];

  			if (@$f[id_pass] != $pass_md5){
				$err .= "סיסמה אינה נכונה<br />\n";
				}
  			elseif (@$f[id_pass] == $pass_md5){
				$cook = md5($ima . "lol" . $id) ;
                $sql = "UPDATE tblusers SET cook='$cook' where id='$id' LIMIT 1";
				@mysql_query($sql);
                $str_cook = $cook . ":" . $id;
  				setcookie("moda", $str_cook, time()+ 60 * 60 * 60);
			   	header("location: index.php");
				exit;
  			}
		}
	}
    else{
        //$err = "Проверьте правильность вводимых данных";
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>כניסה לחשבון</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body><br /><br /><br /><br /><br /><br /><br /><br />
<form method="post" action="login.php"><table align="center"><tr><td>
<input title="שם משתמש" name="name" type="text" value="<?=$ima?>" style="width:130px;" /></td>
</tr><tr><td><?=@$err?></td></tr><tr><td>
<input title="סיסמה" name="pass" type="password" value="<?=$pass?>" style="width:130px;" /></td>
</tr><tr><td><input type="submit" value="EnteR" style="width:130px;" /></td></tr></table></form></body></html>
