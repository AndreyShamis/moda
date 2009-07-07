<?
require_once "../ajax_win_settings.php";
  $question_id = (int)($_POST[questionid]);
  $answer_text = $_POST[txtanswer];
       if($question_id > 0 and strlen($answer_text) > 2){
       $sql = "INSERT INTO tblanswers
       (id_question,id_user,id_time,id_rating,id_answer)
       VALUES
       ('$question_id','".$user->id."','" . time() . "', '1', '" . $answer_text . "')";
       mysql_query($sql);
       //echo mysql_error();
       $sql = "SELECT id_answers FROM tblquestions WHERE id='$question_id' limit 1";
       $q = mysql_query($sql);
       $f= mysql_fetch_array($q);
       $new_value = 1 + $f[id_answers];
       $sql = "UPDATE tblquestions SET id_answers='$new_value' WHERE id='$question_id'";
       mysql_query($sql);

       }


?>