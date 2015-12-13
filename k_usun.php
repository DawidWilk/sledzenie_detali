<form name="form_usun_wyszukaj" action="" method="post" id="596398804">
          <center>Operacja usuwania detalu:</center><br><br>
          <center>Id detalu: <input type="text" name="wyszukaj_detal_id"> </center>
          <center><input type="submit" name="detal_wyszukaj" value="Wyszukaj"> </center>
</form>

<?php
if (isset($_POST['detal_wyszukaj']))
{
    if (!empty($_POST['wyszukaj_detal_id']))  //jeżeli id detalu jest wpisana
    {
        $question = 'SELECT * FROM system_detale.detal WHERE id_detal='.$_POST['wyszukaj_detal_id'].' AND stan="uzycie";';
        $res=mysql_query($question);    //pobranie id, nazwy i maszyny detalu
        while ($baza=mysql_fetch_array($res))
            {
                $local_detal_id = $baza['id_detal'];
                $local_nazwa_detalu = $baza['nazwa'];
                $local_maszyna = $baza['maszyny_id_maszyny'];
            }
        $_SESSION['usun_id']=$local_detal_id;
        if ($local_detal_id && $local_nazwa_detalu)
            {    
                echo 'Wyszukano:'; echo '<br>';
                echo "id: $local_detal_id, nazwa: $local_nazwa_detalu, maszyna: $local_maszyna"; 
                $temp=$local_detal_id;
                ?>
                    <form name="form_usun" action="" method="post" id="596398805">
                    <center><input type="submit" name="detal_usun1" value="Usuń"> </center>
                    </form>
                <?php
            }
        else
            {
                echo 'Nie odnaleziono';
            }
    }
}

if (isset($_POST['detal_usun1']))
{
    $question = 'UPDATE system_detale.detal SET stan="usuniety" WHERE id_detal='.$_SESSION['usun_id'].';';
    $zapytanie_usun = mysql_query($question);  //usuniecie detalu
    
    $question = 'INSERT INTO system_detale.historia (operatorzy_id_operatorzy, detal_id_detal, maszyny_id_maszyny, typ_operacji, maszyna_poprzednia, data) VALUES ('.$SESSION ['osoba_id'].','.$_SESSION['usun_id'].',0,"usuniecie",0,"'.date('H:i:s Y-m-d').'");';
    $usuniecie_historia = mysql_query($question);  //wpis do historii
    
    if (( $zapytanie_usun === \TRUE) && ( $usuniecie_historia === \TRUE))
        {
            echo "Pomyślnie usunieto detal";
        } 
    else 
        {echo "Błąd sql";}
}
?>
