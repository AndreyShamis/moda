<?

require_once "ajax_win_settings.php";
if($user->id){
    $value = $_GET[value];
    $arr = explode("i",$value);
    $q_id           = (int)($arr[0]);
    $q_ball_value   = (int)($arr[1]);
    //print_r($_GET);
    //echo "<br />$q_id  $q_ball_value " . $user->id ."<br />";

    $sql = "SELECT id FROM tblquestions WHERE id='$q_id' LIMIT 1";
    if(mysql_numrows(mysql(DBName,$sql))){
        $sql = "SELECT id FROM tblvio_questions_balls WHERE id_user='$user->id' and id_question='$q_id' LIMIT 1";
        if(mysql_numrows(mysql(DBName,$sql))){
            $sql = "UPDATE tblvio_questions_balls SET id_ball='".$q_ball_value."' WHERE id_user='".$user->id."' and id_question='".$q_id."' LIMIT 1";
            mysql(DBName,$sql);
            //echo "<br />$sql<br />";

        }else{
            $sql = "INSERT INTO tblvio_questions_balls(id_user,id_question,id_ball)VALUES('".$user->id."','".$q_id."','".$q_ball_value."')";
            mysql(DBName,$sql);
            //echo "<br />$sql<br />";
        }
    }
}
?>