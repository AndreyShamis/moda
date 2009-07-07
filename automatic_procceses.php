<?
require_once "ajax_win_settings.php";
$sql = "SELECT * FROM tblzadaniya";
$q = mysql_query($sql);
$z = mysql_numrows($q);

$time = time();
    for($i=0;$i<$z;$i++){
        $f = mysql_fetch_array($q);
        $next = $f[id_last] + $f[id_interval];
        $name_script = $f[id_name];
        $id_script = $f[id];
        if ($next < $time or $f[id_prinuditelno]) {
            $next = $time + $f[id_interval];
            if(!file_exists("/" . $f[id_link])){
                require_once "$f[id_link]";
            }
            else{
                write_log("Automatic script ERROR","File: $f[id_link] <strong>NOT FOUND</strong>\n<br />");
            }
            $sql = "UPDATE tblzadaniya SET id_last='$time', id_next='$next' , id_prinuditelno ='0' where id='$id_script'";
            mysql_query($sql);
            if(mysql_errno() != 0){
                write_log("Automatic script ERROR" ,mysql_error() . "\n<br />" . $sql . "\n<br />");
            }else{
                write_log("Automatic script" ,"$name_script-is OK!");
            }
        }

    }
?>