<?

require_once "../ajax_win_settings.php";
    $qid = (int)($_GET[qid]);
    $answerid = (int)($_GET[answerid]);
    $value = $_GET[bvalue];

    $sql = "SELECT * FROM tblanswers where
    id='$answerid' and
    id_question='$qid' and
    id_user<>'$user->id' LIMIT 1";
    $q = mysql(DBName,$sql);
	$z = mysql_numrows(DBName,$sql);
	$f = mysql_fetch_array($q);
	$id_ball = $f[id_ball];
		//echo $z . mysql_error() . " $sql";
	if($z == 1){
		$sql = "SELECT * FROM tblvioanswers where
			id_question='$qid' and id_answer='$answerid' and id_user='$user->id' LIMIT 1";
        //echo $sql . "<br />";
		$q = mysql(DBName,$sql);
		$z = mysql_numrows($q);
		if($z < 1){
			if($value == "u"){
				$value = "1";
			}elseif($value == "d"){
				$valuee = "-1";
			}

			$new_ball = $id_ball +  $value;
			$sql = "INSERT INTO tblvioanswers
			(id_question,id_answer,id_user,id_ball) VALUES
			('".$qid."','".$answerid."','".$user->id."','".$value."')";
			mysql(DBName,$sql);
			if(mysql_errno() !=0){
				echo mysql_error() . "<br />" . $sql . "<br />";
			}
			//$sql = "UPDATE tblquestions SET id_ball='$new_ball' where id='$qid' LIMIT 1";
			//mysql(DBName,$sql);
			$sql = "UPDATE tblanswers SET id_ball=id_ball + $value where id_question='$qid' and id='$answerid' LIMIT 1";
			mysql(DBName,$sql);
			if(mysql_errno() !=0 ){
				echo mysql_error() . "<br />" . $sql . "<br />";
			}
			$sql = "UPDATE tblquestions SET id_ball=id_ball + '$value' where id='$qid' LIMIT 1";
			mysql(DBName,$sql);
 			if(mysql_errno() !=0 ){
				echo mysql_error() . "<br />" . $sql . "<br />";
			}
		}
	$err .= "Answer by this id ($answerid) not found<br />\n";
}
?>