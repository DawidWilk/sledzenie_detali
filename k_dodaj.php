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
        
        //dorobić pobranie id usera,
        //pobranie id dodanego detalu
        //wpisanie id dodanego detalu do zapytania historii
        //wpisanie id usera do historii
                
        $question = 'INSERT INTO system_detale.historia (operatorzy_id_operatorzy, detal_id_detal, maszyny_id_maszyny, typ_operacji, maszyna_poprzednia, data) VALUES (15,9,0,"dodanie",0,"'.date('H:i:s Y-m-d').'");';
        $zapytanie_historia = mysql_query($question);  //wpis do historii
        //echo $question;

        if (( $zapytanie === \TRUE)&& ( $zapytanie_historia === \TRUE))
            {
                echo "Pomyślnie dodano detal"; 
                //header('Refresh: 1; url=panel_operatora.php'); //odświez stronę
            } 
        else 
            {echo "Błąd sql";}
    }
}
?>
