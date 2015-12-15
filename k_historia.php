<form name="form_historia_wyszukaj" action="" method="post" id="596398800">
          <center>Historia:</center><br><br>
          <center>Id detalu: <input type="text" name="wyszukaj_detal_id"> </center>
          <center><input type="submit" name="detal_wyszukaj" value="Wyszukaj"> </center>
</form>

<?php
if (isset($_POST['detal_wyszukaj']))
{
    if (!empty($_POST['wyszukaj_detal_id']))  //jeżeli id detalu jest wpisana
    {
        $question = 'SELECT nazwa_detalu, maszyny_id_maszyny FROM system_detale.detal WHERE id_detal='.$_POST['wyszukaj_detal_id'].';';
        $res=mysql_query($question);    //pobranie id, nazwy i maszyny detalu
        while ($baza=mysql_fetch_array($res))
            {
                $local_nazwa_detalu = $baza['nazwa_detalu'];
                $local_maszyna_id = $baza['maszyny_id_maszyny'];
            }
        
        echo 'Detal Id: '.$_POST['wyszukaj_detal_id'].', Nazwa: '.$local_nazwa_detalu.', Maszyna:  '.$local_maszyna.''; echo '<br>';
        
        $question = 'SELECT operatorzy.imie, operatorzy.nazwisko, historia.maszyna_poprzednia, historia.maszyny_id_maszyny, historia.typ_operacji, historia.data FROM system_detale.operatorzy, system_detale.maszyny, system_detale.historia WHERE operatorzy.id_operatorzy=historia.operatorzy_id_operatorzy AND historia.maszyny_id_maszyny=maszyny.id_maszyny AND historia.detal_id_detal='.$_POST['wyszukaj_detal_id'].';';
        $res=mysql_query($question);    //pobranie historii
        
        echo "<table frame=box rules='all'  cellspacing='1'  cellpadding='5' >
        <tr style='text-align:center'>
        <tr><td>      </td><td>Operator Id</td><td>Maszyna</td><td>Operacja</td><td>Data</td></tr>";
        $i=1;
        while ($baza=mysql_fetch_array($res))  //wyswietlanie historii
            {
                echo "<tr><td>$i</td>"; 
                echo "<td>"; echo $baza['imie'];  echo " "; echo $baza['nazwisko']; echo "</td>";
                echo "<td>"; echo $baza['maszyna_poprzednia']; echo '->'; echo $baza['maszyny_id_maszyny']; echo "</td>";
                echo "<td>"; echo $baza['typ_operacji']; echo "</td>";
                echo "<td>"; echo $baza['data']; echo "</td>";
                echo "</tr>";
                $i++;
            }
        echo "</table>";
    }    
    else
    {
        echo 'Nie wypołniono pola.';
    }
}

?>
