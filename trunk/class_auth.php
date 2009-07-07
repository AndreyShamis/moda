<?
class auth{
      public $nick;
      public $id = 0;
      public $level = 1;
      public $guests = 1;
      public $admin = 0;
      function login(){

                $kuki = @$_COOKIE["moda"] ;
               // echo $kuki;

                //print_r($_COOKIE);
                //if ($kuki == ""){
                //    $this->nick     = "";
                //    $this->id       = 0;
                    //echo "sdawdA";
                //    header("location: login.php");
                //}
                //else{
                $arr_cook = explode(":",$kuki);
                //echo $arr_cook[0] . "<br />";
                //echo $arr_cook[1] . "<br />";
                    $sql = "select id,id_name from tblusers where id='". $arr_cook[1] ."' and cook='". $arr_cook[0] ."' LIMIT 1";
                    $r=@mysql_query($sql);
                    $z = mysql_numrows($r);
                    if ($z > 0){
                        $f=mysql_fetch_array($r);
                        $this->nick     = @$f[id_name];
                        $this->id       = @$f[id];
                        $cook = md5($this->nick . "lol" . $this->id) ;
                        $str_cook = $cook . ":" . $this->id;
                        setcookie("moda", $str_cook, time() + 60 * 60 * 24 * 31);
                    }
                    else{
                        if($this->guests == 1){
                            $this->nick     = "Guest";
                            $this->id       = 0;
                        }
                        else{
                        header("location: login.php");
                        }
                    }

                //}

       }
    function logout(){

        $kuki = $_COOKIE["moda"] ;

        $sql = "UPDATE tblusers SET cook='outed' where id='".$this->id."' LIMIT 1";
        mysql_query($sql);
        setcookie("moda", "", 0);
        header("location: ?");
    }

    function munu(){
        if($this->id == 0){
            ?><div><span><a title="כניסה" href="login.php">כניסה</a></span></div>
            <div><span><a title="הרשמה לאתר" href="?register=1">הרשמה</a></span></div>
            <?

        }
        elseif($this->id > 0){
           ?><div><a href="?rand=<?=md5(rand(1,999999) . time() . rand(1,999999))?>&amp;act=logout">Log out</a></div><?
        }
    }
}
?>