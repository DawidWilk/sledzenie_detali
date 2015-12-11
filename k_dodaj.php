<form name="form-dodawanie" action="" method="post" id="596398803">
          <center>Operacja dodawania detalu:</center><br><br>
          <center>Nazwa detalu: <input type="text" name="nowy_detal_nazwa"> </center>
          <center><input type="submit" name="detal_dodaj" value="Dodaj"> </center>
</form>

<?php
if (isset($_POST['detal_dodaj']))
{
    if (!empty($_POST['nowy_detal_nazwa']))  //jeżeli nazwa nowego detalu jest wpisana
    {
        $question = 'INSERT INTO system_detale.detal (nazwa, maszyny_id_maszyny) VALUES ("'.$_POST['nowy_detal_nazwa'].'",0);';
        $zapytanie = mysql_query ($question);   //dodanie detalu
        //echo $question;
        
        $question = 'SELECT id_detal, nazwa FROM system_detale.detal WHERE nazwa=\''.$_POST['nowy_detal_nazwa'].'\';';
        $res=mysql_query($question);    //pobranie id detalu
                while ($baza=mysql_fetch_array($res))
                {
                    $local_detal_id = $baza['id_detal'];
                    $nazwa_detalu_temp = $baza['nazwa'];
                } 
                
        $question = 'INSERT INTO system_detale.historia (operatorzy_id_operatorzy, detal_id_detal, maszyny_id_maszyny, typ_operacji, maszyna_poprzednia, data) VALUES ('.$SESSION ['osoba_id'].','.$local_detal_id.',0,"dodanie",0,"'.date('H:i:s Y-m-d').'");';
        $zapytanie_historia = mysql_query($question);  //wpis do historii
        //echo $question;

        if (( $zapytanie === \TRUE)&& ( $zapytanie_historia === \TRUE))
            {
                echo "Pomyślnie dodano detal:"; echo "<br>";
                echo "id: $local_detal_id, nazwa: $nazwa_detalu_temp";
            } 
        else 
            {echo "Błąd sql";}
    }
}
?>

