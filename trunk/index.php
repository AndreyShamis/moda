<?
session_start(); 

require_once "header.php";

require_once "db.php";
require_once "function.php";
require_once "automatic_procceses.php";
require_once "templ_creator.php";
require_once "parser.php";
$time_start = microtime_float();

require_once "class_auth.php";
$user = new auth();
    // Call to login
    $user->login();
    if (@$_GET[act] == "logout"){
        $user->logout();
    }


			$ip =       $_SERVER["REMOTE_ADDR"];
            $ref =      str_replace("'","",$_SERVER["HTTP_REFERER"]);
            $agent =    $_SERVER["HTTP_USER_AGENT"];
            $get=       str_replace("'","",$_SERVER["QUERY_STRING"]);
            $page_get=  str_replace("'","",$_SERVER["REQUEST_URI"]) ;
            $lang       = $_SERVER[HTTP_ACCEPT_LANGUAGE];
    $sql = "INSERT INTO tblvisitors (ip,bot_name,time,refer,get,lang) VALUES
    ('$ip','".DetectBot()."','".time()."','$ref','$get','$lang')";
    @mysql(DBName,$sql);




$include = "";

        if(@!empty($_GET[nadlan])){
			$include = "nadlan.php";
		}elseif(@!empty($_GET[add_nadlan])){
			$include = "add_nadlan.php";
		}elseif(@!empty($_GET[vio])){

			$include = "vio/vio.php";
		} elseif(@!empty($_GET[show_log])){
			$include = "admin/show_log.php";
		}
        elseif(@!empty($_GET[company_list])){
			$include = "company_list.php";
		}
        elseif(@!empty($_GET[register])){
			$include = "registration.php";
		}
        elseif(@!empty($_GET[newss])){
			$include = "news/site.php";
		}
        elseif(@!empty($_GET[newsr])){
			$include = "news/xml.php";
		}
        elseif(@!empty($_GET[newst])){
			$include = "news/type.php";
		}
        elseif(@!empty($_GET[news])){
			$include = "news/list.php";
		}
        elseif(@!empty($_GET[auto_scripts])){
			$include = "admin/auto_run_scripts.php";
		}
        else{

            $include = "vio/vio.php";
            //$include = "main.php";
        }
       time
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<script src="first_scripts.js" language="javascript" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="index.css" />
<title>ברוך הבא - The LAB</title>
</head><body>
<table  style="width:100%;">
<tr>
    <td colspan="2" dir="rtl">
        <? require_once "index_panel_top.php"; ?>
    </td>
</tr>
<tr>
<!-- Start BIG -->
    <td  dir="rtl" valign="top" style="width:80%">
        <? require_once "index_panel_big.php"; ?>
    </td>
<!-- END BIG -->
<!-- Start SMALL -->
    <td  dir="rtl" valign="top"><!--  style="width:200px;"-->
        <? require_once "index_panel_small.php"; ?>
    </td>
<!-- END SMALL -->
</tr>
</table>
<?
$time_end = microtime_float();
$time = $time_end - $time_start;
/*echo $time;
echo "<br />" . $get;
$act_search = explode("&",$get);
foreach($act_search as $val){
    $act_search2 = explode("=",$val);
    if($act_search2[0]=="act"){
        $act_found = $act_search2[1];
        break;
    }
} */


$sql = "INSERT INTO  `moda`.`tbl_statist` (id_get,id_act,id_time_run,id_time) VALUES ('$get','$act','$time','".time()."') ";
@mysql(DBName,$sql);
?>
</body>
</html>
<?
//include "mysql_close.php";
?>