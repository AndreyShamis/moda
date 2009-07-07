<?

$act = $_GET[act];
$id = $_GET[id];

require_once "vio_class.php";
$sd = new vio($user->id);


if($act == "askadd"){
    //$sd->Add_Question();
}

if($act == "" or $act == "key"){

//$sd->list_view();

}

if($act == "ask"){
//$Win_text = " שאל שאלה ";


//$sd->Build_Question_Add_Form();

}
if($act == "view"){
  //$sd->Build_Question();

}
/*
$r = new WikiParser() ;
    $sql = "SELECT * FROM tblquestions where id='$id' LIMIT 1";

    $q = mysql_query($sql);
    $z = mysql_numrows($q);
    $f = mysql_fetch_array($q);
    $question_owner_id = $f[id_user];
    $question_id = $f[id];
    $status = $f[id_status];
    $user_name = get_name($f[id_user]);
    $Win_text = "שאלה מס $question_id, מאת $user_name";

    */


if($rtt ==324234){
    ?>
    <a title="חזרה" href="<?=$ref?>">חזרה</a><br />
    <strong style="font-size: 22px;" title="<?=$f[id_key1]?> שאלה <?=$f[id_subj]?>">שאלה &nbsp;&nbsp; <?=$f[id_subj]?></strong>
<table width="100%" bgcolor="#FFFFFF"><tr><td>
<a title="<?=$user_name?>" href="?user=view&amp;userid=<?=$f[id_user]?>"><?=$user_name?></a>
</td><td>
<?=gmdate(' H:i:s Y.m.d',$f[id_date])?>
<span class="keywords" title="<?=$f[id_key1]?>"><?=$f[id_key1]?></span>
<span class="keywords" title="<?=$f[id_key2]?>"><?=$f[id_key2]?></span>
<span class="keywords" title="<?=$f[id_key3]?>"><?=$f[id_key3]?></span>
</td><td>
<script language="javascript" type="text/javascript">
var question_id = <?=$f[id]?>;
function addanswer(){
    document.getElementById('answer_window').style.visibility = 'visible';

    document.getElementById("answer_window").innerHTML =
'<form method="post" id="answer_form" name="answer_form"><table width="100%"><tr><td>' +
'<span id="answer_err"></span><input type="hidden" name="questionid" value="'+ question_id + '"><div class="buttonwrapper">' +
'<a onclick="submit_answer();" title="לענות על השאלה" class="ovalbutton_green" style="float: right;"><span><strong title="לענות">לענות</strong></span></a>' +
'<a onclick="if(confirm(\'האם אתה בטוח שאתה רוצה לבטל את התשובה?\')){ cancel_question();}" title="לא יודע" class="ovalbutton_red" style="float: right;"><span>ביטול</span></a></div>' +
'</td></tr><tr><td><textarea name="txtanswer" id="txtanswer" cols="20" rows="10"></textarea></td></tr>' +
'<tr><td></td></tr>' +
'</table></form>';
}
function cancel_question(){
    document.getElementById('answer_window').style.visibility = 'hidden';
    document.getElementById("answer_window").innerHTML = '';
}
function submit_answer(){
    if(document.getElementById("txtanswer").value.length > 2){
        post('vio_answer_add.php','answer_err','answer_form');
        cancel_question();
        get('answers_list.php?qid='+question_id,'answer_list');
    }
}
function localtion_list(){
    window.location = '?<?=$get?>';
    }
</script>
<?
    if($status==1){?>
    <div class="buttonwrapper">
    <a href="#answer_form" onclick="addanswer();" title="לענות על השאלה" class="ovalbutton_green" style="float: right;">
    <span>תשובה</span></a>

    <a onclick="if(confirm('אתה מסמן את השאלה זו כי ספאם!\n\nלהמשיך?')){get('vio_admin.php?act=close_spam&amp;obj=q&amp;id=<?=$f[id]?>','status');localtion_list();}" title="סגירת שאלה כי ספאם" class="ovalbutton_gray" style="float: right;">
    <span>ספאם</span>
    </a></div>
<?  }

    if($status==61){?>
    <div class="buttonwrapper">
    <a onclick="get('vio_admin.php?act=not_spam&amp;obj=q&amp;id=<?=$f[id]?>','status');localtion_list();" title="סגירת שאלה כי ספאם" class="ovalbutton_gray" style="float: right;">
    <span>לא ספאם</span>
    </a></div>
<?  }  ?>
</td></tr><tr>
<td colspan="3" bgcolor="#FFFFFF">
<p style="overflow: auto;"><? echo $r->parse(@$f[id_question]) ;  ?></p>
</td></tr><tr>
<td>הדירוג</td>
<td></td>
<td></td>
</tr>
<?

/*
    <tr>
        <td colspan="3">
            <script language="javascript" type="text/javascript">

            function set_type(type_id){
            document.getElementById('link_type').value = type_id;
            }

            </script>
        <form method="post" name="links" id="links">
            <table>
              <tr>
                <td><a onclick="set_type(1);"><strong>URL</strong></a></td>
                <td><a onclick="set_type(2);"><strong>IMAGE</strong></a></td>
                <td><a onclick="set_type(3);"><strong>YOUTUBE</strong></a></td>
              </tr>
              <tr>
                <td colspan="3">
                    <input type="text" id="link_type" name="link_type" value="1">
                    <input type="text" name="link" id="link"  />
                    <input type="button" value="הוספה" onclick="post('vio_search_link.php','nisuy','links');" />
                </td>
              </tr>
            </table>
        </form>
            <div dir="ltr" id="nisuy"></div>

        </td>
  <tr>
<td colspan="3"><div id="answer_window" style="visibility:hidden;height: auto;"></div>
</td></tr></table>
<div style="width:100%;background-color: #ffffff;">
<script type="text/javascript"><!--
google_ad_client = "pub-1468799388949959";
// 728x15, kanal moda 1 09.06.09 ////
google_ad_slot = "5858046483";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script><script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
    */
?>

<!-- ANSWER LIST START -->
<h2>תשובות</h2>
<div id="answer_list">
<?  $sql = "SELECT * FROM tblanswers where id_question='$f[id]'";

    $q = mysql_query($sql);
    $z = mysql_numrows($q);
/////////////////////////////////////////////////////////////////
//
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
      ?>
<div class="curlycontainer">
    <div>
    <img src="media/man.gif" onclick="" />
    <?=get_name($f[id_user])?>
    <em title="להתלונן על התוכן"><a>להתלונן על התוכן <?=$f[id]?></a></em>
    <span ><a>ספם</a></span>
    [<?=gmdate('H:i:s  d.m.Y.',$f[id_time])?>]
    </div>

    <div class="innerdiv"  style="max-width: 600px;">
    <?=$r->parse($f[id_answer])?><br />

    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?
    if($user->id != $f[id_user]  and $status==1){
?>
<img id="up<?=$f[id]?>" src="media/up_big.gif" onclick="update_value(<?=$f[id]?>,1);get('vio_answer_rating.php?qid=<?=$question_id?>&amp;answerid=<?=$f[id]?>&amp;bvalue=u','status')"/>
<img src="media/down_big.gif"  onclick="update_value(<?=$f[id]?>,2);get('vio_answer_rating.php?qid=<?=$question_id?>&amp;answerid=<?=$f[id]?>&amp;bvalue=d','status')" />
<?
    }

    if($user->id == $question_owner_id and $f[id_user] !=$question_owner_id and $status==1){
?>
<input type="button" name="check_good_answer" value="תיבחר תשובה כי הכי טובה" onclick="if(confirm('?האם אתה בטוח שאתה רוצה לבחור את התשובה כי הטובה ביותר ולסגור את השאלה')) {get('vio_close.php?qid=<?=$question_id?>&amp;answerid=<?=$f[id]?>','answer_list');}" />
<?
    }
?>
    <span dir="ltr" id="ball<?=$f[id]?>"> <?=$f[id_ball]?> </span>
    </div>
    </div>
    </div>

      <?

    }
?>
</div>
<?
}




/*
$question_PEER_page = 15;
$Win_text = " רשימת שאלות ";
    $status_need = $_GET[view];
    $vio = $_GET[vio];
    $page_now = $_GET[page];
    $sql_min = $page_now * $question_PEER_page;
    $sql_max = $sql_min  + $question_PEER_page;
    // echo "MIN: $sql_min <br /> MAx: $sql_max<br />";
        if(empty($status_need)) {$status_need=1;}
        if($act == "key"){
            $id_keyword = (int)($_GET[id]);
                $sql = "SELECT * FROM tbl_vio_keywords WHERE id='$id_keyword' LIMIT 1";
                $q = mysql_query($sql);
                $z = mysql_numrows($q);
                $f = mysql_fetch_array($q);
                $keyword_need = $f[id_key];
                $Win_text .= " לפי מילת מפתח [ $keyword_need ] ";
                $sql = "SELECT * FROM tblquestions where (id_key1='$keyword_need' or id_key2='$keyword_need' or id_key3='$keyword_need') and id_status < 10 ";
        }else{

        if($status_need == 1){
        $Win_text .= " פתוחות ";
        }elseif($status_need == 3){
        $Win_text .= " סגורות ";
        }elseif($status_need > 60 and $status_need < 80){
        $Win_text .= " מסומנות כי ספאם ";
        }

            $sql = "SELECT * FROM tblquestions where id_status='$status_need' order by id desc ";
        }
        $q = mysql_query($sql);
        $z = mysql_numrows($q);

        $question_found = $z;





    if($question_found > $question_PEER_page){
    $pages = $question_found / $question_PEER_page;
    $pages = ceil($pages);
    $page_menu .="<div style=\"text-align: center;\">";
        for($i=0;$i<$pages;$i++){
            if($id){
                $id_vstavka = "id=$id&amp;";
            }
            $page_1 = $i +1;
            $page_menu .= "<span class=\"page_button\" ";
            if($page_now != $i){
                $page_menu .= " onclick=\"window.location='?vio=$vio&amp;act=$act&amp;".$id_vstavka."page=$i'\"";
            }else{
                $page_menu .= " style=\"background-color: #EEFFCC;\"";
            }
            $page_menu .= ">$page_1</span>";
        }
        $page_menu .="</div>";
    }
require_once 'templ_creator.php';

$templator = new templ('tample/vio/','question_list');
        for($i=0;$i<$z;$i++){
            if($i>=$sql_max){break;};
            $f = mysql_fetch_array($q);
            if($i>= $sql_min and $i <$sql_max){
if($f[id_status] == 1){
$pic_class="question_open";
}elseif($f[id_status] == 3){
$pic_class="question_closed";
}else{
$pic_class="question_problem";
}

$templator->set(array(
$f[id_subj],
$pic_class,
$f[id],
mb_substr($f[id_subj],0,122),
$f[id_ball],
get_name($f[id_user]),
$f[id_answers],
gmdate(' H:i',$f[id_date]),
));

        }
        }


 echo $templator->Counstruct();
//$templator->__foreachTpl();


    if($page_now > 0){
        $Win_text .= " - עמוד  $page_1 - ";
    }
    echo $page_menu;
*/

  /*
          <div style="border:2px solid red;font-weight:bold;color:#22BA1C;" title="רשימת שאלות">
      <span style="float:right;letter-spacing: 5px;">נושא</span>
      <span style="left: 240px;position:absolute;"></span>
      <span style="left: 170px;position:absolute;letter-spacing: -1px;">משתמש</span>
      <span style="left: 110px;position:absolute;letter-spacing: -1px;">תשובות</span>
      <span style="left: 65px;position:absolute;letter-spacing: -1px;">תאריך</span>
    </div><br />

        <div style="cursor:pointer;border:1px solid white;" onclick="javascript: window.location='?vio=1&amp;act=view&amp;id=<?=$f[id]?>'" title="<?=$f[id_subj]?>">
      <span class="question_open" style="position:absolute;float:right;"></span>

      <span onclick="javascript: window.location='?vio=1&amp;act=view&amp;id=<?=$f[id]?>'" style="float:right;font-weight:bold;"><?=$f[id_subj]?></span>
      <span style="left: 280px;position:absolute;" class="star"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </span>
      <span style="left: 210px;position:absolute;direction: ltr;"><?=$f[id_ball]?></span>
      <span style="left: 160px;position:absolute;"><?=get_name($f[id_user])?></span>
      <span style="left: 130px;position:absolute;"><?=$f[id_answers]?></span>
      <span style="left: 70px;position:absolute;"><?=gmdate(' H:i',$f[id_date])?></span>
      </div><br />

          */


   //     <span class="question_closed"></span>


?>