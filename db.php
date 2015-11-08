 <?php 
  $dbhost = 'localhost';     //Taki zostal utworzony uzytkownik
  $dblogin = 'user';
  $dbpass = 'lol';
  $dbselect = 'system_detale';
  mysql_connect($dbhost,$dblogin,$dbpass);
  mysql_select_db($dbselect) or die("Błąd przy wyborze bazy danych");
  mysql_query("SET CHARACTER SET UTF8");
?>
