<?php
 require_once "ajax_win_settings.php";
 //mysql_query("SET character_set_results=utf8");

 //$handle = fopen("http://www.bankisrael.gov.il/currency.xml", "r");

function sock_data($host,$path){

     $fp = fsockopen($host, 80, $errno, $errstr, 10);
     if (!$fp) {
        $log .= "Socket dosnt work<br />\n";
         return false;
     }
     else {
         $out  = "GET $path HTTP/1.1\r\n";
         $out .= "Host: $host\r\n";
         $out .= "Referer: $host$path\r\n";
         $out .= "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n";
         $out .= "Connection: Close\r\n";
         $out .= "\r\n";

         fwrite($fp, $out);
         while (!feof($fp)) {
             $buffer .= fgets($fp, 1024);
         }
         fclose($fp);
     }
     return $buffer;
}
$file = "currency.xml";
$data_to_file = sock_data("bankisrael.gov.il","/currency.xml");
  save_file();
  parse();
    konec();
 //http://www.bankisrael.gov.il/heb.shearim/currency.php?rdate=20031205

 /*for($x=2005;$x<2010;$x++){
 for($y=1;$y<13;$y++){
  for($z=1;$z<32;$z++){
  $taarih = "";
  $old = "";
  $i = 0;
  $d = 0;
  $massiv = null;
  $db = null;
  $found = 0;
  $log = "";
  if($z < 10) {$zz = "0" . $z;}else{$zz=$z;}
  if($y < 10) {$yy = "0" . $y;}else{$yy=$y;}
  $date_xe =  $x . $yy . $zz ;
  echo $date_xe . "<br />";
  //exit;
$data_to_file = sock_data("bankisrael.gov.il","/heb.shearim/currency.php?rdate=" . $date_xe . "");
  save_file();
  parse();
  konec();
 }
 }
 }
  */
function save_file(){

global    $data_to_file,$somecontent ,$filename  ,$file,$log;
$filename =$file;
$somecontent =  strstr($data_to_file,"<?xml version") ;

// Вначале давайте убедимся, что файл существует и доступен для записи.
if (is_writable($filename)) {

    // В нашем примере мы открываем $filename в режиме "дописать в конец".
    // Таким образом, смещение установлено в конец файла и
    // наш $somecontent допишется в конец при использовании fwrite().
    if (!$handle = fopen($filename, 'w+')) {
         $log .=  "Cant open ($filename)";
         exit;
    }

    // Записываем $somecontent в наш открытый файл.
    if (fwrite($handle, $somecontent) === FALSE) {
        $log .=  "Cant write into ($filename)";
        exit;
    }
     // echo " ";
    $log .= "OK! -  ($filename)\n";

    fclose($handle);

} else {
    $log .=  "File $filename not accessed to write";
}
}


$map_array = array(
    "BOLD"     => "B",
    "EMPHASIS" => "I",
    "LITERAL"  => "TT"
);

class parn{
    public $vse;
}


function startElement($parser, $name, $attrs)
{

    global $map_array;
    if (isset($map_array[$name])) {
       // echo "<$map_array[$name]>";
    }
}

function endElement($parser, $name)
{
    global $map_array;
    if (isset($map_array[$name])) {
      //  echo "</$map_array[$name]>";
    }
}


function characterData($parser, $data)
{
    global $old,$i,$d;
    global $taarih,$massiv;
    if(strlen($data) == 1 and $data=="\n" and $old == $data){
       // echo "<br />";
        $i = $i +1;
        $massiv[$i] = new parn();
        $d = 0;

    }else{
        if(!empty($taarih) and strlen($data)> 0 and $data != "\n"){
            $d = $d + 1;
            $massiv[$i]->vse[$d] = $data;

        }elseif(empty($taarih) and strlen($data) > 3){

         $taarih = $data ;
         $taarih = str_replace("-","",$taarih );
        }

    }
     $old = $data;

}


class valuta{
    public $name;
    public $edenic;
    public $vlt;
    public $strana;
    public $price;
    public $change;
    public $taarih;
    function save(){

  //$sql = "INSERT INTO tblvaluta (id_name,id_edenic,id_kratko,id_country)VALUES
 // ('" . $this->name . "','" . $this->edenic . "','" . $this->vlt . "','" . $this->strana . "')";
 // mysql(DBName,$sql);
 // $date =  date("Ymd");
 // $date_korotko = $date . $this->vlt;
 // $sql = "INSERT INTO tblvaluta_history(id_date,id_kratko,id_price,id_change,id_date_korotko)VALUES
 // ('" . $date. "','" . $this->vlt . "','" . $this->price . "','" . $this->change . "', '" . $date_korotko . "')";
 // mysql(DBName,$sql);

   $date =  $this->taarih;
  $date_korotko = $date . $this->vlt;
  $sql = "INSERT INTO tblvaluta_history(id_date,id_kratko,id_price,id_change,id_date_korotko)VALUES
  ('" . $date. "','" . $this->vlt . "','" . $this->price . "','" . $this->change . "', '" . $date_korotko . "')";
  mysql(DBName,$sql);
 //$log .=  " mysql_error();

 $sql = "UPDATE tblvaluta
 SET
     id_price='" . $this->price. "',
     id_change='" . $this->change. "',
     id_time='" . time() . "'
 WHERE
    id_kratko='" . $this->vlt . "'" ;
  mysql(DBName,$sql);
  if(mysql_errno() != 0 ){
    $log .=  mysql_error() . $sql . "<br />\n";
    $num_err += 1;
  }
    }
}


function parse(){
global $xml_parser,$num_err,$data,$log,$file,$data;
 $xml_parser = xml_parser_create();
// use case-folding so we are sure to find the tag in $map_array
xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
if (!($fp = fopen($file, "r"))) {
    die("could not open XML input");
    $num_err += 1;
    $log .= "could not open XML input! \n";
}

while ($data = fread($fp, 4096)) {
    if (!xml_parse($xml_parser, $data, feof($fp))) {
 //       die(sprintf("XML error: %s at line %d",
 //                   xml_error_string(xml_get_error_code($xml_parser)),
 //                   xml_get_current_line_number($xml_parser)));
 //           $num_err += 1;
 //           $log .= "XML error parsing! \n";
    }
}
xml_parser_free($xml_parser);
}


  function konec(){
  global  $log,  $massiv ,$db, $found, $num_err,$taarih;
$log .=  "Taarih : $taarih <br />\n";

$log .=  "Found: "  . count($massiv) ." <br />\n" ;




foreach($massiv as $param){
    foreach($param as $val){
            if(empty($val[1])) {
             break;
             }
             $found = $found +1;
             $db[$found] = new valuta();
             $db[$found]->name = $val[1];
             $db[$found]->edenic = $val[2];
             $db[$found]->vlt  = $val[3];
             $db[$found]->strana = $val[4];
             $db[$found]->price = $val[5];
             $db[$found]->change = $val[6];
             $db[$found]->taarih = $taarih;
             $db[$found]->save();
            for($i=1;$i<=count($val);$i++){
               $log .=  $val[$i] . "/\n";
            }

    }
$log .= "<br />\n"  ;
}
    $sql = "INSERT into tbllog (id_log,id_script,id_errors,id_time) VALUES ('$log', 'valuta parse','" . (int)($num_err) . "','" . time() . "')";
    mysql(DBName,$sql);
    //echo mysql_error();
    //echo $log;
    }
?>