<?
class templ{

    private $tr_found = 0;
    private $replace;
    public  $result;

    private $top;
    private $down;
    private $constructor;
    private $center;

	public function __construct($tplDir,$tplFile){
		$this->tplDir = $tplDir;
        $this->tplFile = $tplFile;
	}

	public function set($value = NULL){
        $this->replace[$this->tr_found] = $value;
        $this->tr_found += 1;
	}

    public function Set_Panel($i,$name){
        $this->Panel[$name][$i] = 1;
    }
    public function Construct($Panels=0){
        $this->constructor = file_get_contents("tample/".$this->tplDir.$this->tplFile.'.tpl');

        preg_match_all('|(.+?){foreach}(.+?){/foreach}(.*)|s', $this->constructor, $cycles);
        $this->top=$cycles[1][0];
        $this->constructor=$cycles[2][0];
        $this->down=$cycles[3][0];

        $cycles = null;
        preg_match_all('|({\$\d+})|s',  $this->constructor, $cycles);
        $count = count($cycles[0]);
        for($a=0;$a<$this->tr_found;$a++){
            $shab =$this->constructor;
		    for($i = 0; $i < $count; $i++){
 	            $shab =  str_replace("{\$". $i ."}", $this->replace[$a][$i] ,$shab);
		    }
            $this->center .=  $shab;
        }
        if($Panels == 1){
            $this->center = $this->IF_FOUND($this->center);
        }
        $this->result = $this->top.$this->center.$this->down;
        return $this->result;
    }

    public function Easy_Construct($Panels=0){
        $this->constructor = file_get_contents("tample/".$this->tplDir.$this->tplFile.'.tpl');
        if($Panels == 1){
            $this->constructor = $this->IF_FOUND($this->constructor);
        }
        preg_match_all('|({\$\d})|s',  $this->constructor, $cycles);
        $count = count($cycles[0]);
		for($i = 0; $i < $count; $i++){
 	        $this->constructor =  str_replace("{\$". $i ."}", $this->replace[0][$i] ,$this->constructor);
		}
        $this->constructor =  preg_replace("/(\{\\$[\d]{1,}\})/", "" ,$this->constructor); // Сборщик мусора
        $this->result = $this->constructor;
        return $this->result;
    }

    public function IF_FOUND($tpl){
        preg_match_all('|({PANEL ([A-z0-9]*)})(.+?)({/PANEL})(.+?)|si', $tpl, $cycles);
        $count = count($cycles[0]);
        $param;
        for($i=0;$i<$count;$i++){
            $param[$cycles[2][$i]] = (int)($param[$cycles[2][$i]]);
            if(isset($this->Panel[$cycles[2][$i]][$param[$cycles[2][$i]]])){
                $tpl =  preg_replace('/\{PANEL '. $cycles[2][$i] .'\}(.+?)\{\/PANEL\}/is', " $1 ", $tpl,1);
            }else{
                $tpl =  preg_replace('/\{PANEL '. $cycles[2][$i] .'\}(.+?)\{\/PANEL\}/is', "", $tpl,1);
            }
            $param[$cycles[2][$i]] +=1;
        }
        return($tpl);
    }
}
?>