<?




 header("Content-type: image/gif");
  //$im = ImageCreateTrueColor( 200, 100 );
 //$im = @imagecreatefromgif("star_on.gif");
 $im = imagecreatefromgif("star_off.gif");
 $on = imagecreatefromgif("star_on.gif");
  $xx = imagesx($im);
  $yy = imagesy($im);


  for($x=0;$x<=$xx;$x++){
for($y=0;$y<=$yy;$y++){
       $return_color    = imagecolorat( $on, $x, $y );
      // echo $return_color . "-";
     //
    //
       if($return_color and $return_color!=16){
    //     $return_color    = imagecolorat( $on, 12, 2 );
         //$red  = imagecolorallocate($on, 234, 123, 56);
         $red = imagecolorallocate($im, 255-($return_color*17), 0, 0);
        imagesetpixel( $im, $x, $y, $red );
       }


    }
    $x_file = ($x + 1) * 2;
    ImageGif($im,"star_on_".$x_file.".gif");
   // echo "<br />";
  }

 ImageGif($im);
 ImageDestroy($im);



?>