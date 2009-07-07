<?
require_once "../ajax_win_settings.php";

    $act = $_GET[act];

/*
QUESTIONS
61 = spam  question  admin


ANSWERS
71 = spam question      admin
72 = spam answer        admin


*/
    if($act == "close_spam"){
        $object = $_GET[obj];
        $id= $_GET[id];
        if($object == "q"){
           $sql = "UPDATE tblquestions SET id_status='61' where id='$id' LIMIT 1";
           mysql(DBName,$sql);
           $sql = "UPDATE tblanswers SET id_status='71' where id_question='$id'";
           mysql(DBName,$sql);
           echo refresh(1,"/index.php?vio=1");
        }elseif($object == "a"){
           $sql = "UPDATE tblanswers SET id_status='72' where id='$id'";
           mysql(DBName,$sql);
           refresh(1,"?vio=1") ;
        }
    }
    if($act == "not_spam"){
        $object = $_GET[obj];
        $id= $_GET[id];
        if($object == "q"){
           $sql = "UPDATE tblquestions SET id_status='1' where id='$id' LIMIT 1";
           mysql(DBName,$sql);
           $sql = "UPDATE tblanswers SET id_status='1' where id_question='$id'";
           mysql(DBName,$sql);
           echo refresh(1,"/index.php?vio=1");
        }elseif($object == "a"){
           $sql = "UPDATE tblanswers SET id_status='72' where id='$id'";
           mysql(DBName,$sql);
           refresh(1,"?vio=1") ;
        }
    }
?>