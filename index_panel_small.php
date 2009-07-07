<div class="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
<div class="inner-box">תפריט ראשי
<div class="inner-box2">

<div  dir="ltr" id="status">-----</div>

<?
echo get_name($user->id);
    if(@!empty($_GET[nadlan]) or @!empty($_GET[add_nadlan])){
?>
<div class="buttonwrapper"><a class="ovalbutton_green" href="?nadlan=1&amp;act=buy" style="width:80px;float: right;"><span title="דורות למכירה">למכירה</span></a>
<a class="ovalbutton_green" href="?nadlan=1&amp;act=rent" style="width:80px;float: right;"><span title="דירות להשכרה">להשכרה</span></a></div>
<div class="buttonwrapper"><a class="ovalbutton" href="?nadlan=1&amp;act=pip" style="width:100px;float: right;"><span>שותפים</span></a></div>
<div class="buttonwrapper"><a class="ovalbutton_red" href="?add_nadlan=1&amp;act=pip" style="width:100px;float: right;"><span>להשיר מודעה</span></a></div>
<?
    }
    if(@!empty($_GET[company_list])){
?>
<div class="buttonwrapper">
<a title="הוספה" class="ovalbutton" href="?company_list=1&amp;act=add" style="float: right;width:100px;"><span>להוסיף חברה</span></a></div>
<?
    }
    if(@!empty($_GET[vio])){
?>
<div class="buttonwrapper">
<a title="לפרסם שאלה" class="ovalbutton_green" href="?vio=1" style="float: right;width:100px;"><span>רשימת שאלות</span></a></div>
<div class="buttonwrapper"><a title="סגורות" class="ovalbutton_gray" href="?vio=1&amp;view=3" style="float: right;width:100px;"><span>סגורות</span></a></div>
<div class="buttonwrapper"><a title="ספאם" class="ovalbutton_gray" href="?vio=1&amp;view=61" style="float: right;width:100px;"><span>ספאם</span></a></div>
<div class="buttonwrapper"><a title="שאל" class="ovalbutton_red" href="?vio=1&amp;act=ask" style="float: right;width:100px;"><span>לכתוב שאלה</span></a></div>
אם יש לךה מה להציע? אתה מוזמן להירשם במערכת פירסום שלנו, ובמקרה אם יהיה מישהו מעוניין בסחורותך אצלו יופיע פרסום חינם
<?
    }
?>
</div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>
<?
    if(@!empty($_GET[vio])){
        require_once "vio/vio_keywords_list.php";
    }elseif(@!empty($_GET[news])){
        require_once "news/news_win.php";
    }else{
        require_once "valuta_win.php";
    }
?>
<div class="vertical_ads">
<script type="text/javascript"><!--
google_ad_client = "pub-1468799388949959";
/* 160x600, vertikal moda09.06.09 */
google_ad_slot = "5544911219";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script><script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>

<div class="rounded-box-3"><b class="r3"></b><b class="r1"></b><b class="r1"></b>
<div class="inner-box"><strong>חדשות</strong>
<div class="inner-box2">עוד מט"ח.<br /> נגזרים דולר דולר גלום/רציף מחשבון
<span id="time_left"></span><br />
<br />
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a><br />
</div></div><b class="r1"></b><b class="r1"></b><b class="r3"></b></div><div class="tab"></div>