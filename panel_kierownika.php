    <?php session_start();
          require_once('db.php');
    ?>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>System sledzenia detali - zalogowano</title>
    </head>

    <body>
     
        
        <?php if ($_SESSION['auth'] == TRUE) {
            
            
            $question = 'SELECT id_operatorzy FROM system_detale.operatorzy WHERE imie=\''.$_SESSION['imie'].'\' AND nazwisko=\''.$_SESSION['nazwisko'].'\';';
            $res=mysql_query($question);
            while ($user_id=mysql_fetch_array($res))
            {
                $id = $user_id['id_operatorzy'];
            }
                
              
                    
                    
          echo 'Panel kierownika<br>';
          echo '<a href="index.php?logout">Wyloguj się</a>';
            }
        else {
          echo '<meta http-equiv="refresh" content="1; URL=index.php">';
          echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
             }
        ?>
      
    </body>
    </html>
