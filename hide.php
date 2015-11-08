    <?php session_start();
          require_once('db.php');
    ?>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Hide      </title>
    </head>

    <body>
     
        
        <?php if ($_SESSION['auth'] == TRUE) {
          echo 'UKRYTA TREŚĆ!<br>';
          echo '<a href="index.php?logout">Wyloguj się</a>';
            }
        else {
          echo '<meta http-equiv="refresh" content="1; URL=index.php">';
          echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
             }
        ?>
      
    </body>
    </html>
