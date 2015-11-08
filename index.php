<?php session_start();
    require_once('db.php');
?>

<?php
    //wyswietlenie formularzy
    if (!isset($_POST['imie']) && !isset($_POST['nazwisko']) && !isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
?>
      <form name="form-logowanie" action="index.php" method="post" id="596398808">
          Imie: <input type="text" name="imie"><br>
          Nazwisko: <input type="text" name="nazwisko"><br>
          Haslo: <input type="password" name="password">
          <input type="submit" name="zaloguj" value="Zaloguj">
      </form>
  
  <?php
  }
    //logowanie
    elseif (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
        // jeżeli pole z loginem i hasłem nie jest puste      
        if (!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['password'])) {
          
        // dodaje znaki unikowe
        $nazwisko = mysql_real_escape_string($_POST['nazwisko']);
        $imie = mysql_real_escape_string($_POST['imie']);
        $password = mysql_real_escape_string($_POST['password']);
        
        // szyfruję wpisane hasło za pomocą funkcji md5()
        //$password = md5($password);
        
        /* zapytanie do bazy danych
         * mysql_num_rows - sprawdzam ile wierszy odpowiada zapytaniu mysql_query
         * mysql_query - pobierz wszystkie dane z tabeli user gdzie login i hasło odpowiadają wpisanym danym
         */
        $sql = mysql_num_rows(mysql_query("SELECT * FROM system_detale.operatorzy WHERE imie = '$imie' AND nazwisko = '$nazwisko' AND haslo = '$password';"));
            // jeżeli powyższe zapytanie zwraca 1, to znaczy, że dane zostały wpisane poprawnie i rejestruję sesję
            if ($sql == 1) {
                // zmienne sesysje user (z loginem zalogowanego użytkownika) oraz sesja autoryzacyjna ustawiona na TRUE
                $_SESSION['user'] = $nazwisko;
                $_SESSION['auth'] = TRUE;  
                //przekierwuję użytkownika na stronę
                echo '<meta http-equiv="refresh" content="1; URL=hide.php">';
                echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa logowanie i wczytywanie danych<p></p>';
            }
            // jeżeli zapytanie nie zwróci 1, to wyświetlam komunikat o błędzie podczas logowania
            else {
                echo '<p style="padding-top:10px;color:red" ;="">Błędne dane<br>';
                echo '<a href="index.php" style="">Wróć do formularza</a></p>';
            }
        }
        // jeżeli pole login lub hasło nie zostało uzupełnione wyświetlam błąd
        else {
            echo '<p style="padding-top:10px;color:red" ;="">Nie wszystkie dane wprowadzone<br>';
            echo '<a href="index.php" style="">Wróć do formularza</a></p>';    
        }
    }
    // jeżeli sesja auth jest TRUE to przekieruj na stronę
	elseif ($_SESSION['auth'] == TRUE && !isset($_GET['logout'])) {
		echo '<meta http-equiv="refresh" content="1; URL=hide.php">';
		echo '<p style="padding-top:10px"><strong>Proszę czekać...</strong><br />trwa wczytywanie danych</p>';
	}
    // wyloguj się
	elseif ($_SESSION['auth'] == TRUE && isset($_GET['logout'])) {
		$_SESSION['user'] = '';
		$_SESSION['auth'] = FALSE;
		echo '<meta http-equiv="refresh" content="1; URL=index.php">';
		echo '<p style="padding-top:10px"><strong>Proszę czekać...</strong><br />trwa wylogowywanie</p>';
	}
 ?>
