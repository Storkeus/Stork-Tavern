<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
    <title>Załaduj obrazek na serwer</title>
    <style type="text/css" title="text/css" media="all">
    .error {
        font-weight: bold;
        color: #C00
    }
    </style>
</head>
<body>
<?php # Skrypt 10.3 - zaladuj_obrazek.php

// SprawdĽ czy formularz wysłany.
if (isset($_POST['submitted'])) {

    // SprawdĽ ładowany obrazek.
    if (isset($_FILES['upload'])) {
        
        // SprawdĽ typ, pownien być JPEG lub PNG.
        $allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
        if (in_array($_FILES['upload']['type'], $allowed)) {
        
            // Przenie&#182; plik do docelowego katalogu.
            if (move_uploaded_file ($_FILES['upload']['tmp_name'], "../uploads/{$_FILES['upload']['name']}")) {
                echo '<p><em>Plik został załadowany!</em></p>';
            } // Koniec instrukcji if move...
            
        } else { // Niepoprawny typ.
            echo '<p class="error">Proszę załadować plik typu JPEG lub PNG.</p>';
        }

    } // Koniec instrukcji if isset($_FILES['upload']).
    
    // Okre&#182;l bł&#177;d.
    
    if ($_FILES['upload']['error'] > 0) {
        echo '<p class="error">Plik nie został załadowany pomy&#182;lnie: <strong>';
    
        // Wy&#182;wietl odpowiedni komunikat w zależno&#182;ci od błędu.
        switch ($_FILES['upload']['error']) {
            case 1:
                print 'Rozmiar pliku większy niż upload_max_filesize w php.ini.';
                break;
            case 2:
                print 'Rozmiar pliku większy niż okre&#182;lony przez parametr MAX_FILE_SIZE formularza HTML.';
                break;
            case 3:
                print 'Plik został czę&#182;ciowo załadowany.';
                break;
            case 4:
                print 'Żaden plik nie został załadowany.';
                break;
            case 6:
                print 'Katalog tymczasowy był niedostępny.';
                break;
            case 7:
                print 'Brak możliwo&#182;ci zapisu na dysk.';
                break;
            case 8:
                print 'Proces ładowania został wstrzymany.';
                break;
            default:
                print 'Wyst&#177;pił bł&#177;d systemu.';
                break;
        } // Koniec instrukcji switch.
        
        print '</strong></p>';
        
    } // Koniec instukcji if zwi&#177;zanej z obsług&#177; błędów.
    
    // Usuń plik je&#182;li jeszcze istnieje.
    if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
        unlink ($_FILES['upload']['tmp_name']);
    }
            
} // Koniec głównej instrukcji if.
?>
    
<form enctype="multipart/form-data" action="zaladuj_obrazek.php" method="post">

    <input type="hidden" name="MAX_FILE_SIZE" value="524288">
    
    <fieldset><legend>Załaduj plik JPEG lub PNG o wielko&#182;ci do 512KB:</legend>
    
    <p><b>Plik:</b> <input type="file" name="upload" /></p>
    
    </fieldset>
    <div align="center"><input type="submit" name="submit" value="Załaduj" /></div>
    <input type="hidden" name="submitted" value="TRUE" />
</form>
</body>
</html>
