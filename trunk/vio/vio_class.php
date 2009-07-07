<?

class vio{

    public $LIST_PEER_PAGE  = 35;
    public $MENU_LEN        = 5;

    /////// $l_{VAR} Буква Л чёрточка переменные для всего что связанно с листов

    public $l_menu;
    public $l_list;

    //////// $vio_(var) Переменные для оформеления старницы
    public $vio_WinText;    //span in indezx_big
    public $vio_Title_Text; // title
    public $vio_meta_Keywords; // Keywords
    private $q_Status;
    private $q_Owner_ID;
    private $q_ID;
    private $q_OrderBy;
    private $l_adress_without_page;

    function vio($user_id){
        $this->status_need = (int)($_GET[view]);
        $this->vio = $_GET[vio];
        $this->page_now = (int)($_GET[page]);
        $this->act = $_GET[act];

        $this->id = (int)($_GET[id]);
        $this->r = new WikiParser() ;
        $this->user_id = $user_id;
        $this->q_OrderBy = $_GET[order];

        if($this->act == "askadd"){
            $this->Add_Question();
        }
        if($this->act == "" or $this->act == "key"){
            $this->list_view();
        }
        if($this->act == "ask"){
            $Win_text = " שאל שאלה ";
            $this->Build_Question_Add_Form();
        }
        if($this->act == "view"){
            $this->Build_Question();
        }
    }

    function Build_List_Menu($question_found){
        $templator = new templ('vio/','qustion_list_menu');
        if($question_found > $this->LIST_PEER_PAGE){
            $pages = $question_found / $this->LIST_PEER_PAGE;
            $pages = ceil($pages);
            $cent = ceil($this->MENU_LEN/2)-1;
            if($this->page_now > $this->MENU_LEN-$cent-1){
                $sart = $this->page_now - $cent;

            }
            $max = $sart + $this->MENU_LEN;
            if($max>$pages){
                $max = $pages;
                $sart = $pages -$this->MENU_LEN;
                if($sart < 0){$sart = 0;}
                }
            for($i=$sart;$i<$max;$i++){
                if($this->id){$id_vstavka = "id=$this->id&amp;";}
                if($this->status_need > 0){$view = "view=".$this->status_need."&amp;";}
                if($i != 0){$page_vstavka = "page=$i&amp;";}
                if(!empty($this->act)){$act_vstavka = "act=".$this->act."&amp;";}
                if(!empty($this->q_OrderBy)){$sql_order_vstavka = "order=".$this->q_OrderBy."&amp;";}
                $page_1 = $i +1;
                $this->l_adress_without_page = "window.location='?vio=$this->vio&amp;".$view ."".$id_vstavka.$act_vstavka."'";
                if($this->page_now != $i){
                    $vas = "window.location='?vio=$this->vio&amp;".$view ."".$id_vstavka.$page_vstavka.$act_vstavka.$sql_order_vstavka."'";
                    $page_menu = " title=\"$vas\" onclick=\"$vas\"";
                }else{
                    $page_menu = " style=\"background-color: #EEFFCC;\"";
                }
                $templator->set(array(
                    $page_menu,
                    $page_1
                    ));
            }
            $this->l_menu =  $templator->Construct();

        }
       // return  "";
    }

    function list_view(){

        $Win_text = " רשימת שאלות ";

        $sql_min = $this->page_now * $this->LIST_PEER_PAGE;
        //$sql_max = $sql_min  + $this->LIST_PEER_PAGE;

        // echo "MIN: $sql_min <br /> MAx: $sql_max<br />";

        if(!empty($this->q_OrderBy)){
            switch ($this->q_OrderBy){
                case 1:
                    $sql_OrderBy = " id_rating ";
                    break;
                case 2:
                    $sql_OrderBy = " id_ball ";
                    break;
                case 3:
                    $sql_OrderBy = " id_user ";
                    break;
                case 4:
                    $sql_OrderBy = " id_answers ";
                    break;
            }
        }else{
            $sql_OrderBy = " id ";
        }
        if($this->act == "key"){
            $id_keyword = (int)($_GET[id]);
            $sql = "SELECT * FROM tbl_vio_keywords WHERE id='$id_keyword' LIMIT 1";
            $q = mysql(DBName,$sql);
            $f = mysql_fetch_array($q);
            $keyword_need = $f[id_key];
            $Win_text .= " לפי מילת מפתח [ $keyword_need ] ";
            $sql = "
            SELECT * FROM tblquestions
            WHERE (
                id_key1='$keyword_need' or
                id_key2='$keyword_need' or
                id_key3='$keyword_need')
            AND
                id_status < 10

            ORDER BY ".$sql_OrderBy." DESC
            LIMIT
                $sql_min, $this->LIST_PEER_PAGE ";
        }else{
          if(empty($this->status_need)) {$this->status_need=1;}

            if($this->status_need == 1){      $Win_text .= " פתוחות ";}
            elseif($this->status_need == 3){  $Win_text .= " סגורות ";}
            elseif($this->status_need > 60 and $this->status_need < 80){ $Win_text .= " מסומנות כי ספאם ";}
            $sql = "
            SELECT * FROM tblquestions
            WHERE
                id_status='$this->status_need'

            ORDER BY ".$sql_OrderBy." DESC
            LIMIT
                $sql_min, $this->LIST_PEER_PAGE ";
        }
        // Data To Build Menu Block

        $sql_count = str_replace("SELECT * FROM","SELECT count(*) FROM",$sql);
        $sql_count = preg_replace("/(ORDER BY .*)/usi", $replacement, $sql_count);;
        $q = mysql(DBName,$sql_count);
        $f = mysql_fetch_array($q);
        $this->Build_List_Menu($f['count(*)']);
        // Finsish  To Build Menu Block

        $q = mysql(DBName,$sql);
        $z = mysql_numrows($q);

        $templator = new templ('vio/','question_list');
        for($i=0;$i<$z;$i++){
            $f = mysql_fetch_array($q);
            // Check Picture Syle
            if($f[id_status] == 1){     $pic_class="question_open";}
            elseif($f[id_status] == 3){ $pic_class="question_closed";}
            else{                       $pic_class="question_problem";}
            //Send Data to Taplator
            $image_id =(int)($f[id_rating]);
            if($image_id%2 != 0){$image_id +=1; }
            $vajnost_1 = round($f[id_points] / $f[id_days]);
            $templator->set(array(
                $f[id_subj],
                $pic_class,
                $f[id],
                mb_substr($f[id_subj],0,122),
                $f[id_ball],
                get_name($f[id_user]),
                $f[id_answers],
                gmdate('d/m H:i',$f[id_date]),
                $i,
                $f[id_rating],
                $image_id,
                $f[id_points],
                $vajnost_1
                ));

        }


        $this->l_list = $templator->Construct();


        if($this->page_now > 0){ $Win_text .= " - עמוד  $page_1 - ";}
        $this->vio_WinText = $Win_text;
        echo $this->l_list;
        echo $this->l_menu;
    }



    function Build_Answer_List(){

    $sql = "SELECT * FROM tblanswers where id_question='".$this->q_ID."'";

    $q = mysql(DBName,$sql);
    $z = mysql_numrows($q);
    $templator = new templ('vio/','answer_list');
    for($i=0;$i<$z;$i++){
        $f = mysql_fetch_array($q);
        //echo "USER: $this->user_id - $f[id_user] <br /><br /><br /><br />";
        if($this->user_id != $f[id_user]  and $this->q_Status==1 and $this->user_id){
            $templator->Set_Panel($i,"User");
            //echo "Dal user<br />";
        }
        if($this->user_id == $this->q_Owner_ID and $f[id_user] !=$this->q_Owner_ID and $this->q_Status==1 ){
            $templator->Set_Panel($i,"GoodAnswer");
        }
        $obj = array(
                get_name($f[id_user]),
                $f[id],
                gmdate('H:i:s  d.m.Y.',$f[id_time]),
                $this->r->parse($f[id_answer]),
                $f[id_ball],
                $this->q_ID
                );
        $templator->set($obj);


    }
        echo $templator->Construct(1);
        return 0;



    }

    function Build_Question(){
        $templator = new templ('vio/','question');


    $sql = "SELECT * FROM tblquestions where id='".$this->id."' LIMIT 1";


    $q = mysql(DBName,$sql);
    $z = mysql_numrows($q);
    $f = mysql_fetch_array($q);
    $this->q_Owner_ID = $f[id_user];
    $this->q_ID = $f[id];
    $this->q_Status = $f[id_status];
    $user_name = get_name($f[id_user]);
    $Win_text = "שאלה מס $question_id, מאת $user_name";
    if($this->q_Status==1 and $this->user_id){
    $templator->Set_Panel(0,"User");

    }
    if($this->user_id and $this->user_id != $this->q_Owner_ID and $this->q_Status){
       $templator->Set_Panel(0,"RatingOn");
       $templator->Set_Panel(0,"Rating");
    }
    if($this->q_Status==61){
    $templator->Set_Panel(0,"Spam");
    }

    $obj = array(
                $f[id_subj],
                gmdate(' H:i:s Y.m.d',$f[id_date]),
                $f[id_key1],
                $f[id_key2],
                $f[id_key3],
                $f[id_user],
                $user_name,
                $this->r->parse(@$f[id_question]),
                $this->q_ID,
                $f[id_visited],
                $f[id_rating],
                $f[id_points],
                $f[id_days],
                $this->l_adress_without_page
                );

    $templator->set($obj);
    $sql = "UPDATE tblquestions SET id_visited=id_visited+1 where id='".$this->id."' LIMIT 1";

    $q = mysql(DBName,$sql);

    echo $templator->Easy_Construct(1);
    $this->Build_Answer_List();

    }

    function Build_Question_Add_Form(){
        $templator = new templ('vio/','question_add_form');
        $templator->set(array(
                $this->subj,
                $this->quest,
                $this->keywords_data
                ));
        echo $templator->Easy_Construct();
    }

    function Add_Question(){
        $subj =  $_POST[subj];
        $quest =  $_POST[quest];
        $keywords_data =  $_POST[keywords];
        $this->subj =  $subj;
        $this->quest =  $quest;
        $this->keywords_data =  $keywords_data;
        $days =  $_POST[days];
        $points =  $_POST[points];
        $keywords = $keywords_data;


        if(!empty($subj) and !empty($quest) and !empty($keywords) and !empty($days)){
            $keywords = explode(",",$keywords) ;
            for($i=0;$i<3;$i++){
                if(mb_strlen($keywords[$i])> 2 and mb_strlen($keywords[$i])< 25){
                    $found +=1;
                    $keywory[$found] = $keywords[$i];
                }
            }
            foreach($keywory as $val){
                if(!empty($val)){
                    $sql = "INSERT INTO tbl_vio_keywords (id_key) values('".$val."');";
                    mysql(DBName,$sql);
                }
            }
            if($found > 0){
                $sql = "SELECT id,id_subj FROM tblquestions ORDER BY id LIMIT 1";
                $q = mysql(DBName,$sql);
;               $f = mysql_fetch_array($q);
                if($f[id_subj] == $subj){

                    $this->id  = $f[id];
                    $this->Build_Question();
                    return 0;
                }else{
                    $key1 = $keywory[1];
                    $key2 = $keywory[2];
                    $key3 = $keywory[3];

                    if ($key2 == $key1){
                        $key2 = "";
                    }
                    if ($key3 == $key1){
                        $key3 = "";
                    }
                    if ($key3 == $key2){
                        $key3 = "";
                    }
                    $sql = "INSERT INTO tblquestions
                        (id_subj,id_question,id_days,id_key1,id_key2,id_key3,id_date,id_user,id_points)
                    VALUES
                        ('$subj','$quest','$days','$key1','$key2','$key3','" . time() . "', '" . (int)($this->user_id) . "','".$points."')";
                    mysql(DBName,$sql);
                    if(mysql_errno() == 0){
                        $this->act = "view";
                        $this->id  = mysql_insert_id();
                        //$this->Build_Question();
                        return 0;
                    }else{
                        echo "Isert error: ".mysql_error();
                    }
                }
            }else{
            //echo "asdasD";
            $this->Build_Question_Add_Form();
            }
        }
    }
}

  //  foreach($_GET as $key=>$value){
  //      eval("$".$key."=\"". $value . "\";");
  //  }
?>