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
     <?php 
        if ($_SESSION['auth'] == TRUE) 
            {
                $question = 'SELECT id_operatorzy, imie, nazwisko, maszyny_id_maszyny FROM system_detale.operatorzy WHERE imie=\''.$_SESSION['imie'].'\' AND nazwisko=\''.$_SESSION['nazwisko'].'\';';
                $res=mysql_query($question);
                while ($user_id=mysql_fetch_array($res))
                {
                    $local_id = $user_id['id_operatorzy'];
                    $local_imie = $user_id['imie'];
                    $local_nazwisko = $user_id['nazwisko'];
                    $local_maszyna = $user_id['maszyny_id_maszyny'];
                } 

                $question = 'SELECT nazwa, typ, lokalizacja FROM system_detale.maszyny WHERE id_maszyny=\''.$local_maszyna.'\';';
                $res=mysql_query($question);
                while ($user_id=mysql_fetch_array($res))
                {
                    $local_nazwa = $user_id['nazwa'];
                    $local_typ = $user_id['typ'];
                    $local_lokalizacja = $user_id['lokalizacja'];
                }                 
                
                echo 'Zalogowano: '; echo '<strong> '.$local_imie.' '.$local_nazwisko.' </strong>';  echo'       maszyna: ';  echo '<strong>'.$local_typ.' '.$local_nazwa.'</strong> położenie: <strong>'.$local_lokalizacja.'</strong>';     echo '<br>';
                echo '<a href="index.php?logout">wyloguj się</a>';
                
                echo '<br><br><br>';  
                echo '<center> Panel operatora - wybierz pozycję z pośród dostępnych lokalizacji: </center><br><br><br><br>'; 
          
                //Pobranie detalu z miejsca żródłowego//////////////////////////////////////////////////////////////////
                
                echo '<center>Pobieranie detalu z miejsca źródłowego do: <strong>'.$local_typ.' '.$local_nazwa.'</strong> położenie: <strong>'.$local_lokalizacja.'</strong></center>';
                echo '<br>';
                
                $zapytanie = mysql_query ("SELECT id_detal, nazwa FROM system_detale.detal WHERE maszyny_id_maszyny=0;");
                echo '<center><select name="zrodlo">';
                while($option = mysql_fetch_assoc($zapytanie)) {
                    echo '<option value="'.$option['id_detal'].'">'.$option['id_detal'].' '.$option['nazwa'].'</option>';
                }
                echo '</select></center>';
                ?>
                    <center><form action="" method="post">
                    <input type="hidden" name="zatwierdz1" value="true">
                    <input type="submit" value="Zatwierdź">
                    </form></center>
                <?php
                
                echo '<br><br>';
                
                //Przenoszenie detalu z maszyny do innej maszyny/////////////////////////////////////////////////////////
             
                echo '<center>Przenoszenie detalu z maszyny: <strong>'.$local_typ.' '.$local_nazwa.'</strong> położenie: <strong>'.$local_lokalizacja.'</strong> do innej maszyny.</center>';
                echo '<br>';
                $question = 'SELECT id_detal, nazwa FROM system_detale.detal WHERE maszyny_id_maszyny=\''.$local_maszyna.'\';';
                $zapytanie = mysql_query ($question);
                echo '<center><select name="maszyna">';
                while($option = mysql_fetch_assoc($zapytanie)) {
                    echo '<option value="'.$option['id_detal'].'">'.$option['id_detal'].' '.$option['nazwa'].'</option>';
                }
                echo '</select></center>';
                echo '<br>';
                
                $zapytanie = mysql_query ("SELECT * FROM system_detale.maszyny WHERE id_maszyny <> 0;");
                echo '<center><select name="maszyny">';
                while($option = mysql_fetch_assoc($zapytanie)) {
                    echo '<option value="'.$option['id_maszyny'].'">'.$option['id_maszyny'].' '.$option['nazwa'].' '.$option['typ'].' '.$option['lokalizacja'].'</option>';
                }
                echo '</select></center>';
                ?>
                    <center><form action="" method="post">
                    <input type="hidden" name="zatwierdz2" value="true">
                    <input type="submit" value="Zatwierdź">
                    </form></center>
                  
                <?php            
                
                
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
            
        else 
            {
                echo '<meta http-equiv="refresh" content="1; URL=index.php">';
                echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
            }
            
            
        if (isset($_POST['zatwierdz1'])) 
        {
            echo 'zat1 ok';  //kod do przyjecia detalu
        }
        
        if (isset($_POST['zatwierdz2'])) 
        {
            echo 'zat2 ok'; //kod do przeniesienia detalu
        }
            
        ?>
            
    </body>
    </html>
