<?


$a = array('a' =>1,
            'd' => 2,
            'ds' => 'esgshsh',
            'v' => 4,
            'e' => 5
);

print_r($a) ."<br />";

echo $b = serialize($a) . "\n <br /><br />";
echo $c = json_encode($a) . "\n<br /><br /><br />";

print_r(unserialize($b)) . "<br /><br />";
print_r(json_decode($c)) . "<br /><br />";

$filename = "news.xml";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
fclose($handle);
$arr = XMLtoArray($contents);

foreach($arr as $v){
    print_r($v);
    //echo  "<br /><br /><br /><br />";
}
echo $arr[title] . "<br />";
 function ArrayToXML($array)
    {
        $RetStr = "";
        foreach($array as $key=>$val)
        {
            if(is_array($val))
            {
                $RetStr .= "<$key>".ArrayToXML($val)."</$key>";

            }
            else
            {
                $RetStr .= "<$key>$val</$key>";
            }
        }
        return $RetStr;
    }

     function XMLtoArray($xmlStr)
    {
        $ArrRet = array();
        // Using regular expressions we are trying to get all tags and data
        preg_match_all("/<([^>]+)>(.*)<\/\\1>/is", $xmlStr, $result, PREG_SET_ORDER);
        foreach($result as $item)
        {
            if(preg_match("/<([^>]+)>(.*)<\/\\1>/is", $item[2]))
            {
                $ArrRet[$item[1]] = XMLtoArray($item[2]);
            }
            else
            {
                $ArrRet[$item[1]] = $item[2];
            }
        }
        return $ArrRet;
    }

    ?>