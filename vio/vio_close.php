<?
require_once "../ajax_win_settings.php";

    $qid = (int)($_GET[qid]);
    $answerid = (int)($_GET[answerid]);

    $sql = "SELECT * FROM tblquestions where id='$qid' and id_user='$user->id' LIMIT 1";
    $q = mysql_query($sql);
    $z = mysql_numrows($q);
    if($z > 0){
        $sql = "SELECT * FROM tblanswers where
        id='$answerid' and
        id_question='$qid' and
        id_user<>'$user->id' LIMIT 1";

            $q = mysql_query($sql);
            $z = mysql_numrows($q);
            //echo $z . mysql_error();
            if($z == 1){
                $sql = "UPDATE tblquestions SET id_status='3' where id='$qid' and id_user='$user->id' LIMIT 1";
                mysql_query($sql);
                $sql = "UPDATE tblanswers SET id_status='3' where id_question='$qid'";
                mysql_query($sql);
                $sql = "UPDATE tblanswers SET id_status='5' where id='$answerid' and id_question='$qid' LIMIT 1";
                mysql_query($sql);

            }
        }


?>