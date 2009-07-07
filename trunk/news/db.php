<?
if(!mysql_connect("localhost", "xml_news_heb", "baraban")){
    echo "<b>Ошибка подключения к MySQL</b>" . NEWS;
    exit;
}
mysql_select_db("xml_news_heb");


?>