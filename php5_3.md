Настройка PHP 5.3 В связке с APACHE 2.0.x
И так раз заебавшись с настройкой сервака решил написать
что надо делать что бы не заебатся так как я только что заебался.
А заебался именно по тому что грёбанный мануал на php сайте не фига не соответствует жестокой реальности
И так.

1.
Первое:
открываем httpd.conf и добовляем этакие строки

#load the php main library to avoid dll hell
Loadfile "C:/Program Files/PHP/php5ts.dll"

#load the sapi so that apache can use php
LoadModule php5\_module "C:/Program Files/PHP/php5apache2\_2.dll"

#set the php.ini location so that you don't have to waste time guessing where it is
PHPIniDir "C:/Program Files/PHP"

#Hook the php file extensions, notice that Addtype is NOT USED, since that's just stupid
AddHandler application/x-httpd-php .php
AddHandler application/x-httpd-php-source .phps

2.