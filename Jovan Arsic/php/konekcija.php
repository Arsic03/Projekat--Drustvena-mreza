
<?php
    // Podaci za konekciju
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $database = "drustvenamreza";

    // Konekcija sa bazom
        $conn = new mysqli($servername, $username, $password, $database);
    
     // Provera konekcije
        if ($conn->connect_error) {
        die("Greška prilikom povezivanja sa bazom podataka: " . $conn->connect_error);
    }
?>

