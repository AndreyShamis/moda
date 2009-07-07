<?



//define("DBName","moda");
if(!mysql_connect("localhost", "root", "223256")){
    echo "<b>Ошибка подключения к MySQL</b>" . DBName;
    exit;
}
mysql_select_db("moda");

//mysql_query("SET character_set_client=utf8");
//alter database my_own_db character set utf8;

//mysql_query("SET character_set_server=utf8");
//mysql_query("SET character_set_system =utf8");
?>