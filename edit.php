<?

$id	= (int)(@$_GET[editid]);
    $sql = "SELECT * FROM tbl_theory WHERE id=$id limit 0,1";
 		$q=@mysql(DBName,$sql);
        $z = mysql_numrows($q);
        $f = mysql_fetch_array($q);
if(@$user->id == @$f[id_author]) {
?>
<div id="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
<div class="inner-box">Edit :  <?=@$f[id_title]?>
<div class="inner-box2">
<a href="?theory=<?=$id?>">View this page</a> <br />
<form method="post" action="?vl=<?=chr(rand(97,122))?><?=chr(rand(97,122))?><?=rand(1,99999999)?><?=chr(rand(97,122))?><?=chr(rand(97,122))?>&amp;editid=<?=@$id?>&amp;act=save&amp;rand=<?=chr(rand(97,122))?><?=rand(1,999999)?><?=chr(rand(97,122))?>">
Title<br />
    <input type="text" name="title" value="<?=@$f[id_title]?>" style="width:100%;" />
	Description<br />
    <input type="text" name="desc" value="<?=@$f[id_desc]?>" style="width:100%;" />
	 Select level : <select name="level">
<?
        function get_selected($value,$view_options){
        $selected =  " selected=\"selected\"";
            if($value == $view_options){
                echo $selected;
            }
        }
for($i=1;$i<=$user->level;$i++){ ?>
		<option value="<?=$i?>" <?=get_selected($i,@$f[id_view_level])?>>Level <?=$i?></option>
<? } ?>
	</select>	<br />
<input class="text_btn" type="button" value="URL" onclick="insertTags('[',']','www.domain.com')" />
<input class="text_btn" type="button" value="URL" onclick="insertTags('[',']','www.domain.com Main Domain')" />
<input class="text_btn" type="button" value="i" onclick="insertTags('\'\' ',' \'\'','i')" />
<input class="text_btn" type="button" value="b" onclick="insertTags('\'\'\' ',' \'\'\'','b')" />
<input class="text_btn" type="button" value="b" onclick="insertTags('\'\'\'\' ',' \'\'\'\'','b')" />
<input class="text_btn" type="button" value="b+i" onclick="insertTags('\'\'\'\'\' ',' \'\'\'\'\'','b+i')" />

<input class="text_btn" type="button" value="H1" onclick="insertTags('= ',' =','H1')" />
<input class="text_btn" type="button" value="H2" onclick="insertTags('== ',' ==','H2')" />
<input class="text_btn" type="button" value="H3" onclick="insertTags('=== ',' ===','H3')" />
<input class="text_btn" type="button" value="H4" onclick="insertTags('==== ',' ====','H4')" />
<input class="text_btn" type="button" value="H5" onclick="insertTags('===== ',' =====','H5')" />
<input class="text_btn" type="button" value="H6" onclick="insertTags('====== ',' ======','H6')" />
<input class="text_btn" type="button" value="img" onclick="insertTags('[[Image:',']]','bao1.gif')" />
<input class="text_btn" type="button" value="img f" onclick="insertTags('[[Image:|frame|',']]','description')" />
<input class="text_btn" type="button" value="img r" onclick="insertTags('[[Image:|right|',']]','description')" />
<input class="text_btn" type="button" value="*" onclick="insertTags('* ','','Without number')" />
<input class="text_btn" type="button" value="-1" onclick="insertTags('# ','','With number')" />
<input onclick="javascript: window.open('upload_picture.php','_blank','height=220,width=550,scrollbars=no,status=yes,toolbar=no,menubar=no,location=no')" class="text_btn" type='button' class="buttons" value='IMG' />
<textarea tabindex="1" accesskey="," name="wpTextbox1" id="wpTextbox1" rows="20" style="width:100%;"><?=@$f[id_text]?></textarea>
<br />
<input type="submit" value="Save" />
<a target="_self" href="?theory=<?=@$id?>"><input type='button' class="buttons" value='Cancel' /></a></form><br />
</div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>

<?
}
else{
    echo "Error";
}
 ?>