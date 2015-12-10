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
        
        <?php if ($_SESSION['auth'] == TRUE) 
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
                
                echo 'Zalogowano: '; echo '<strong> '.$local_imie.' '.$local_nazwisko.' </strong>';     echo '<br>';      
                echo '<a href="index.php?logout">Wyloguj się</a>'; echo '<br><br><br>'; 
                echo '<center>Panel kierownika</center>';
                
                        $go = $_GET['opcja'];  //pobieranie wybranej opcji
              ?>  

                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                 <td width="30%"><div align="left">
                 
                                        <span style="font-weight: bold;">Wybór operacji:</span><br>

                                        <a href="panel_kierownika.php?opcja=1" title="dodaj">dodaj</a><br>
                                        <a href="panel_kierownika.php?opcja=2" title="usun">usun</a><br>
                                        <a href="panel_kierownika.php?opcja=3" title="przenies">przenies</a><br>
                                        <a href="panel_kierownika.php?opcja=4" title="historia">historia</a><br>

                     </div></td>
                     
                 <td width="70%"><div align="center">  
                  <?php 
                  
                   // echo $go;  echo '<br>';
                    switch($go) //petla wyboru opcji
                    {
                        case 1:  include "k_dodaj.php"; break;
                        case 2:  include "k_usun.php"; break; 
                        case 3:  include "k_przenies.php"; break; 
                        case 4:  include "k_historia.php"; break;    
                    }
                  ?> </div></td>
                </tr>
                </table>
           <?php     
                
            }
        else 
            {
                echo '<meta http-equiv="refresh" content="1; URL=index.php">';
                echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
            }
        ?>
    </body>
    </html>
