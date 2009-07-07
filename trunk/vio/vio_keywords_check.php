<?

 require_once "ajax_win_settings.php";



 $sql = "SELECT * FROM tbl_vio_keywords";
 $q = mysql(DBName,$sql);
 $z = mysql_numrows($q);
 if(mysql_errno() != 0){
    write_log("Keywords CHECK",mysql_error() . "\n<br />" . $sql . "\n<br />");
 }

    for($i=0;$i<$z;$i++){

        $f  = mysql_fetch_array($q);

        $keyword_found = $f[id_key];

        $sql = "SELECT id_key1,id_key2,id_key3 FROM tblquestions
        WHERE    id_status<'10'   AND
            lower(id_key1) =lower('$keyword_found') or
            lower(id_key2) =lower('$keyword_found') or
            lower(id_key3) =lower('$keyword_found') ";
            $questions = mysql(DBName,$sql);
            $z_found = mysql_numrows($questions);
            $sql = "UPDATE tbl_vio_keywords SET id_found='$z_found' WHERE id='".$f[id]."' LIMIT 1";
            mysql(DBName,$sql);
        if(mysql_errno() != 0){
            write_log("Keywords CHECK" ,mysql_error() . "\n<br />" . $sql . "\n<br />");
        }
    }
?>