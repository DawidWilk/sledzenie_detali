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
                echo '<center> Panel operatora - wybierz pozycję z pośród dostępnych lokalizacji: </center><br><br>'; 
          
                echo '<center>Maszyna: <strong>'.$local_typ.' '.$local_nazwa.'</strong> położenie: <strong>'.$local_lokalizacja.'</strong></center>';
     
                $question = 'SELECT id_detal, nazwa FROM system_detale.detal WHERE maszyny_id_maszyny=\''.$local_maszyna.'\';';
                $res=mysql_query($question);
                $i=0;
                while ($user_id=mysql_fetch_array($res))
                {
                    $local_moja_id_detal[$i] = $user_id['id_detal'];
                    $local_moja_nazwa[$i] = $user_id['nazwa'];
                    $i++;
                }
                $ilosc_wierszy = $i-1;
                $tresc = '<table border="2" rules="all"><tr><td><strong> numer: </strong></td><td><strong> nazwa: </strong></td></tr>';
                for($i=0;$i<=$ilosc_wierszy;$i++)
                {
                    $tresc.='<tr><td><center>'.$local_moja_id_detal[$i].'</center></td><td><center>'.$local_moja_nazwa[$i].'</center></td></tr>';
                }
                $tresc.= '</table>';
                echo '<center>'.$tresc.'</center>';
               
                

             
                echo '<br><br>';
                echo '<center>Źródło:</center>';
                
                $i=0;
                $question = 'SELECT id_detal, nazwa FROM system_detale.detal WHERE maszyny_id_maszyny=0;';
                $res=mysql_query($question);
                while ($user_id=mysql_fetch_array($res))
                {
                    $local_src_id_detal[$i] = $user_id['id_detal'];
                    $local_src_nazwa[$i] = $user_id['nazwa'];
                    $i++;
                }    
                
                $ilosc_wierszy = $i-1;
                $tresc = '<table border="2" rules="all"><tr><td><strong> numer: </strong></td><td><strong> nazwa: </strong></td></tr>';
                for($i=0;$i<=$ilosc_wierszy;$i++)
                {
                    $tresc.='<tr><td><center>'.$local_src_id_detal[$i].'</center></td><td><center>'.$local_src_nazwa[$i].'</center></td></tr>';
                }
                $tresc.= '</table>';
                echo '<center>'.$tresc.'</center>';
                
                
                
                

            }
        else {
          echo '<meta http-equiv="refresh" content="1; URL=index.php">';
          echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
             }
        ?>
      
    </body>
    </html>
