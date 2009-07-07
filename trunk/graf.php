<?
header("Content-Type: image/png");
  require_once "db.php";
  $type = $_GET[vtype];
  $sql = "SELECT id FROM tblvaluta_history where id_kratko='$type'";
  $q = mysql_query($sql);
  $z = mysql_numrows($q);
  $start = $z - 40;
    $sql = "SELECT * FROM tblvaluta_history where id_kratko='$type'  limit $start, $z";
  $q = mysql_query($sql);
  $z = mysql_numrows($q);
    for($i=0;$i<$z;$i++){
    $f = mysql_fetch_array($q);
    $comin .= "|" . $f[id_price] ;
    $comin_date .= "|" . $f[id_date] ;
    }
    //echo $comin . $sql;
$v = $_GET[v];
$w =$_GET[w];
if($v < 15){
    $v = 400;
}
if($w < 25){
    $w = 650;
}
$arr = explode("|" ,$comin);
$arr_date = explode("|" ,$comin_date);
$i = 0;
$new_arr =  $arr;
foreach($new_arr as $q){
    if($q!=""){

        $new_arr[$i] = $q;
        //echo $q ." - }<br />";
        $i += 1;
    }
}
$arr = $new_arr;
   //echo "asas";

$x2 = $w - 3;
$y2 = $v - 3;
$xcenter = (int)($v/2);

$im = imagecreatetruecolor($w, $v);
$white = imagecolorallocate($im,  255, 255, 255);
$seriy = imagecolorallocate($im,30, 20, 10);
$hz = imagecolorallocate($im,80, 210, 458);
$hz2 = imagecolorallocate($im,70, 110, 218);
$hz3 = imagecolorallocate($im,50, 130, 118);
$hz4 = imagecolorallocate($im,210, 180, 75);

$black = imagecolorallocate($im, 0x00, 0x00, 0x00);

$red = imagecolorallocate($im,255, 0, 0);
//$white = imagecolorallocate($im,  255, 255, 255);
// Draw a white rectangle
imagefilledrectangle($im, 2, 2, $x2, $y2, $white);
imageline($im,0,$xcenter,$w,$xcenter,$seriy);
$shag = $w / count($arr);

$min = 0;
/*
foreach($arr as $v){
    if($v > $max){
        $max = $v;
    }
    if($v < $min){
        $min = $v;
    }
}
   */
$show_x = $_GET[show_x];
$show_shipua = $_GET[show_sh];
   $max = max($arr);
   $min = min($arr);
$summa_modul = abs($min) + abs($max);
  //$v = 400;
if($min<0 and $max >= 0 ){
$summa_modul = abs($min) + abs($max);
} else if($min>0 and $max >0 ){
$summa_modul =$max - $min;
} else if($min<0 and $max <0 ){
$summa_modul = abs($min) - abs($max);
}
if($summa_modul  <2 ) {$summa_modul = 2 ;}
//echo $summa_modul . "<br />";
$lineyka = round(($v - 10) / $summa_modul,9);
$x_polosa = abs($lineyka * $max)+ ($lineyka/2);
//$x1_polosa = abs($lineyka * $min);


 $tahoma_file = 'media/fonts/tahoma.ttf';
 $times_file = 'media/fonts/times.ttf';
 $arialbdfile = 'media/fonts/arialbd.ttf';
  $maxim  = 30;


for($i=0;$i<count($arr);$i++){
    $iii = $i + 1;
    $this_shag_start = $i * $shag;
    $this_shag_finish = $i * $shag + $shag;
    $yy1 = $xcenter - $arr[$i];
    $yy2 = $xcenter - $arr[$i+1];
    imageline($im,$this_shag_start,$yy1,$this_shag_finish,$yy2,$hz);
}

    for($i=0;$i<count($arr)-1;$i++){
    //echo "asd";
        $iii = $i + 1;
        $this_shag_start =5+ ( $i * $shag);
        $this_shag_finish =5+ (  $i * $shag + $shag);
        $yy1 =$x_polosa -  ($lineyka * $arr[$i]);
        $yy2 =$x_polosa -  ($lineyka * $arr[$i+1]);
        $yy1_nadpis = $yy1;

        imageline($im,$this_shag_start,$yy1,$this_shag_finish,$yy2,$red);
                   if($yy1 < 5){
                      $yy1_nadpis = $yy1 + 15;
                   }
                   $nadpis = round($arr[$i],2);
        @imagefttext($im, 12, 30, $this_shag_start, $yy1_nadpis, $black, $times_file, $nadpis);
                    $mon = substr($arr_date[$i],4,2);
                    $day = substr($arr_date[$i],6,2);
                    $nadpis = $mon. " / " .$day;
        @imagefttext($im, 12, 70, $this_shag_start, $yy1_nadpis+100, $black, $times_file,$nadpis );
        imageline($im,$this_shag_start,$yy1_nadpis,$this_shag_finish-45,$yy1_nadpis+100,$hz4);
        if($show_x){

            if((count($arr)> ($w/80))){
                if($iii%10 == 0){
                    imagefttext($im, 18, 90, $this_shag_start + 7, $x_polosa, $black, $times_file, $iii);
                }
            }else{
                imagefttext($im, 8, 90, $this_shag_start + 7, $x_polosa, $black, $times_file, $iii);
            }
        }
        if($show_shipua){
            $this_shag_start =5+ ( $i * $shag) + ($shag/2);
            $yy1 =$x_polosa -  ($lineyka * $arr[$i])+ 10;
            $shipua =( $arr[$i+1] - $arr[$i]) / 10;
            $shipua = round($shipua,4);
            $naklon = 60;
            if($shipua < 0 ){
             $naklon = -1 * $naklon;
            }
            @imagefttext($im, 12, $naklon, $this_shag_start, $yy1, $hz2, $arialbdfile, $shipua);
             $shipua_db[$i] =$shipua;
        }



    }





// Save the image
imagepng($im);
imagedestroy($im);

?>