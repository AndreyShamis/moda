<?

require_once "../ajax_win_settings.php";
    require_once "../function.php";

    require_once "../parser.php";
    $r = new WikiParser() ;

$qid = $_GET[qid];
    $sql = "SELECT * FROM tblanswers where id_question='$qid'";

    $q = mysql_query($sql);
    $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
      ?>
    <div class="curlycontainer">
        <div>
          <img src="media/man.gif" onclick="" />
          <?=$f[id_user]?>
          <em title="להתלונן על התוכן"><a>להתלונן על התוכן <?=$f[id]?></a></em>
          <span ><a>ספם</a></span>
          [<?=gmdate('H:i:s  d.m.Y.',$f[id_time])?>]
        </div>
        <div class="innerdiv">
            <?=$r->parse($f[id_answer])?><br />

        <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <img src="media/up_big.gif" onclick=""/>
          <img src="media/down_big.gif" onclick="" />
          - <?=$f[id_rating]?>
        </div>

        </div>



    </div>
<br />
      <?
    }
    ?>