<?

function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function DetectBot(){
        $bot_list = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler", "StackRambler", "Yandex", "Aport");
        foreach($bot_list as $bot) {
            if(stristr($_SERVER['HTTP_USER_AGENT'], $bot)) {
              return $bot;
            }
        }
}

function get_name($id){
    if ($id == "" or $id==0) {return ("אורח");}
    $id= (int)($id);
    $q=mysql_query("SELECT * FROM tblusers where id='$id' limit 1");
    $f=mysql_fetch_array($q);

	if ($f[id_name]!=""){
		return $f[id_name];
	}
    else{
        return ("אורח וותיק");
    }
}

function hack($str){
$search = array("+","-","pp","union","select","\\");
    for ($i=0; $i<strlen($str); $i++){

        foreach($search as $val){

            if (!strcasecmp(substr($str,$i,strlen($val)) , $val)) {
                echo "Hack!!!- Запросы содержащие \"<b>" . substr($str,$i,strlen($val)) . "</b>\" запрещенны!!!<br>";
                echo "Внимание при повторении засылания таких запросов вы будете забаненнннннны! =) <br> Желаю Удачи.";
                exit;
            }

        }
    }
return ($str);
}


function write_log($script,$log,$errors=0){
    $sql = "INSERT into tbllog
    (id_log,id_script,id_errors,id_time) VALUES
    ('$log', '".$script."','".$errors."','" . time() . "')";
    mysql_query($sql);
}

function refresh($sec,$page) {
     $sec=$sec*1000;
     return("<script>
     function refpage(){
        window.location='".$page."';
     }

     setTimeout('refpage()',".$sec.");
     </script>");
    }
?>