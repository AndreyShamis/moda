<?


    include_once "db.php";  
//header('Content-Type: text/html; charset=utf-8');

    $sql = "Select * from tblrss";
    $r = mysql_query($sql);
    $z=mysql_numrows($r);
    $element = 0;
    $saved = 0;  
        for ($i=0; $i<$z; $i++){
         $f = mysql_fetch_array($r);

            $url    = $f[id_link];
            $id     = $f[id];
            $id_site= $f[id_site];
            $id_type =$f[id_type];

        	$doc = new DOMDocument();
        	@$doc->load($url);

        	$arrFeeds = array();
            //echo $doc->getElementsByTagName('title')->item(0)->nodeValue . "<br />";
            //echo $doc->getElementsByTagName('copyright')->item(0)->nodeValue. "<br />";
            //echo $doc->getElementsByTagName('link')->item(0)->nodeValue. "<br />";
            //echo $doc->getElementsByTagName('description')->item(0)->nodeValue. "<br />";
            //echo $doc->getElementsByTagName('language')->item(0)->nodeValue. "<br />";
            //echo $doc->getElementsByTagName('ttl')->item(0)->nodeValue. "<br />";
            $sql = "UPDATE tblrss SET
            id_title    = '". mysql_escape_string($doc->getElementsByTagName('title')->item(0)->nodeValue)."',
            id_cop      = '".mysql_escape_string($doc->getElementsByTagName('copyright')->item(0)->nodeValue)."',
            id_desc     = '".mysql_escape_string($doc->getElementsByTagName('description')->item(0)->nodeValue)."',
            id_lang     = '".$doc->getElementsByTagName('language')->item(0)->nodeValue."',
            ttl         = '".$doc->getElementsByTagName('ttl')->item(0)->nodeValue."'
            WHERE id= '$id'";
            @mysql_query($sql);
            if(mysql_errno() != 0 ){
                write_log("News Parser Error",mysql_error() . "<br /> $sql \n<br />" . mysql_errno() . "<br />");
            }

        	foreach ($doc->getElementsByTagName('item') as $node) {
        		$itemRSS = array (
        			'title' => trim($node->getElementsByTagName('title')->item(0)->nodeValue),
        			'desc' => trim($node->getElementsByTagName('description')->item(0)->nodeValue),
        			'link' => trim($node->getElementsByTagName('link')->item(0)->nodeValue),
        			'date' => trim($node->getElementsByTagName('pubDate')->item(0)->nodeValue)
        			);
        		array_push($arrFeeds, $itemRSS);
                $element += 1;
        	}


            foreach($arrFeeds as $val){
            //    echo $val[title] . "<br />";
            //    echo $val[desc] . "<br />";
            //    echo $val[link] . "<br />";
            //    echo $val[date] . "<br /><br />";
            $sql = "INSERT INTO news (title,id_desc,link,id_date,id_site,id_xml,id_uniq,id_type) VALUES
            ('". mysql_escape_string($val[title]) ."',
            '". mysql_escape_string($val[desc]) ."',
            '". $val[link] ."',
            '". $val[date] ."',
            '". $id_site ."',
            '". $id ."',
            '". md5($val[link]) ."',
            '". $id_type ."')";
            mysql_query($sql);
            if(mysql_errno() != 0 and mysql_errno() != 1062){
            write_log("News Parser Error",mysql_error() . "<br /> $id_site - $id :" . mysql_errno() . "<br />");

            }
            elseif(mysql_errno() == 0){
                $saved +=1;
            }
            }
     }
     write_log("News Parser" ,"<h1>$element elementsparsed.</h1><h2>$saved saved.</h2>");

?>