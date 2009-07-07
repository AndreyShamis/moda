<?
require_once "ajax_win_settings.php";


function sock_data($host,$path){

//echo $host . "<br /><br />";
//echo "<textarea>$path</textarea>";
                //       $path =  urldecode($path);
     $fp = @fsockopen($host, 80, $errno, $errstr, 10);
     if (!$fp) {
        $log .= "Socket dosnt work<br />\n";
         return false;
     }
     else {
         $out  = "GET $path HTTP/1.1\r\n";
         $out .= "Host: $host\r\n";
         $out .= "Proxy-Connection: keep-alive\r\n";
         $out .= "Cache-Control: max-age=0\r\n";
         $out .= "Accept: application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
         $out .= "Accept-Encoding: gzip,deflate,bzip2,sdch\r\n";
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
     $str =   substr($buffer,0,100);
 if (eregi("HTTP/1.1 200 OK", $str)) {
    return "1";
}else{
    return "01";
}
   //  return $buffer;
}



  $link_type = (int)($_POST[link_type]);

  $link = ($_POST[link]);
  $link_makor = $link;
   $start = 0;
   $link = str_replace("http://","",$link);

  $end = strlen($link);
  for($i=$start;$i< strlen($link);$i++){
       if(  substr($link,$i,1) == "/" ){
          $page =   substr($link,$i);
          $end = $i;
          break;
       }
  }
  if($link_type == 1){
    //echo $link ;
       $data_to_file = sock_data(substr($link,$start,$end),$page);
       //$data_to_file = strstr($data_to_file,"<title>");
       //echo $data_to_file;
       if($data_to_file == 1){
            echo "<span>$link_makor</span>";
       }
  }
  elseif($link_type == 2){

  }
  elseif($link_type == 3){

  }



//vio_search_link.php
?>