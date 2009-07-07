<?
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
    include "db.php";
    include "automatic_procceses.php";

    include "function.php";

    include "parser.php";
			$ip =       $_SERVER["REMOTE_ADDR"];
            $ref =      str_replace("'","",$_SERVER["HTTP_REFERER"]);
            $agent =    $_SERVER["HTTP_USER_AGENT"];
            $get=       str_replace("'","",$_SERVER["QUERY_STRING"]);
            $page_get=  str_replace("'","",$_SERVER["REQUEST_URI"]) ;
            $lang       = $_SERVER[HTTP_ACCEPT_LANGUAGE];
    $sql = "INSERT INTO tblvisitors (ip,bot_name,time,refer,get,lang) VALUES
    ('$ip','".DetectBot()."','".time()."','$ref','$get','$lang')";
    @mysql(DBName,$sql);
    /*include "class_auth.php";
    $user = new auth();
    // Call to login
    $user->login();
    if (@$_GET[act] == "logout"){
        $user->logout();
    }
    */

  //  include "site_add_edit.php";


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<script src="js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="edit.js?192xx"></script>
<script src="first_scripts.js" language="javascript" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="index.css" />
<title>???? ??? - The LAB</title>
</head><body>

<span id="d"></span><br />
<span id="status"></span>



<form action="" method="post" name="p" id="p">
  <input type="button" name="Knopka" onclick="post('vio_answer_add.php','d','p')" value="zsdsds" />
   <form method="post" name="answer"><table width="100%"><tr><td>
   <input type="hidden" name="questionid" value="666"><div class="buttonwrapper">
   <a onclick="submit_answer();" title="????? ?? ?????" class="ovalbutton_green" style="float: right;"><span><strong title="?????">?????</strong></span></a>'
   <a onclick="cancel_question();" title="?? ????" class="ovalbutton_red" style="float: right;"><span>?????</span></a></div>
   </td></tr><tr><td><textarea name="txtanswer" id="txtanswer" cols="20" rows="10"></textarea></td></tr></table></form>

  </form>
</body>
</html>