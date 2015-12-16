<form name="form_przenies_wyszukaj_wydzial" action="" method="post" id="596398800">
          <center>Przeniesienie detalu:</center><br><br>
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
                $local_nazwa_detalu = $baza['nazwa_detalu'];
                $local_maszyna = $baza['maszyny_id_maszyny'];
            }
        $_SESSION['przenies_detal_id']=$local_detal_id;
        if ($local_detal_id && $local_nazwa_detalu)
        {    
            echo 'Wyszukano:'; echo '<br>';
            echo "Id detalu: $local_detal_id, Nazwa: $local_nazwa_detalu, Id maszyny: $local_maszyna"; //nazwa znalezionego detalu
            
            //wyswietlenie maszyn///////////////////////////////////////////////
                echo '<center>Nowe położenie detalu:</center>';
                echo '<br>';
                
                ?> 
                <form method=post action=''> 
                <center><select name='maszyny_przen'>
                <option value=''> </option>
                <?php 
                
                $zapytanie = mysql_query ("SELECT * FROM system_detale.maszyny;");
                while($option = mysql_fetch_assoc($zapytanie)) {
                    echo '<option value="'.$option['id_maszyny'].'">'.$option['id_maszyny'].' '.$option['nazwa_maszyny'].' '.$option['typ'].' '.$option['lokalizacja'].'</option>';
                }
                
                ?>               
                </form></center>
                       
                   <form name="form_przen" action="" method="post" id="596398805">
                   <center><input type="submit" name="detal_przen" value="Przenieś"> </center>
                   </form>
                   <?php 
        }        
        else
        {echo 'Nie odnaleziono';} 
    }
    else
    {echo 'Nie wypołniono pola.';}
}     
    

if (isset($_POST['detal_przen']))  //PRZENIESIENIE DETALU DO INNEJ MASZYNY /////////////////////////////////////
{
    if(isset($_POST['maszyny_przen']))
    {
        $question = 'UPDATE system_detale.detal SET maszyny_id_maszyny=\''.$_POST['maszyny_przen'].'\' WHERE id_detal=\''.$_SESSION['przenies_detal_id'].'\';';
        $zapytanie = mysql_query ($question);
                
        $question = 'INSERT INTO system_detale.historia (operatorzy_id_operatorzy, detal_id_detal, maszyny_id_maszyny, typ_operacji, maszyna_poprzednia, data) VALUES ('.$SESSION ['osoba_id'].','.$_SESSION['przenies_detal_id'].','.$_POST['maszyny_przen'].',"przeniesienie_k",'.$local_maszyna.',"'.date('H:i:s Y-m-d').'");';
        $zapytanie_historia = mysql_query($question);  //wpis do historii
                
        if (( $zapytanie === \TRUE)&& ( $zapytanie_historia === \TRUE))
            {echo "Pomyślnie przeniesiono detal"; } 
        else    
            {echo "Błąd sql";} 
    }
    else    
    {echo 'Wypełnij pola!';}
}  
?>
