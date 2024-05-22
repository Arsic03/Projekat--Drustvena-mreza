<?php
// Pokretanje sesije
session_start();

// Provera da li je korisnik ulogovan
if (!isset($_SESSION['korisnik_id'])) {     
    // Korisnik nije ulogovan, preusmeravanje na stranicu za prijavljivanje
    header("Location: index.php");
    exit();
}

// Povezivanje sa bazom podataka
include 'konekcija.php';

// Provera da li su svi potrebni podaci poslati iz forme
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['imePrijatelja']) && isset($_POST['tekstObjave']) && isset($_FILES['slika'])) {
    // Dobijanje podataka iz forme
    $imePrijatelja = $_POST['imePrijatelja'];
    $tekstObjave = $_POST['tekstObjave'];
    $slika = $_FILES['slika']['tmp_name']; // Privremeno ime datoteke
    $slikaTip = $_FILES['slika']['type']; // Tip slike

    // Čitanje binarnih podataka slike
    $sadrzajSlike = file_get_contents($slika);

    // Dobijanje idKorisnika iz sesije
    $idKorisnika = $_SESSION['korisnik_id'];

    // Priprema upita za unos podataka u bazu
    $upit = "INSERT INTO podaci (idKorisnika, prijatelji, objava, slika) VALUES (?, ?, ?, ?)";

    // Priprema naredbe
    $stmt = $conn->prepare($upit);

    // Provera da li je uspelo pripremanje naredbe
    if ($stmt) {
        // Povezivanje parametara
        $stmt->bind_param("isss", $idKorisnika, $imePrijatelja, $tekstObjave, $sadrzajSlike);

        // Izvršavanje naredbe
        if ($stmt->execute()) {
            // Uspešno upisani podaci
            echo "Podaci su uspešno upisani u bazu.";
        } else {
            // Greška pri izvršavanju naredbe
            echo "Greška pri upisu podataka u bazu: " . $stmt->error;
        }
        
        // Zatvaranje naredbe
        $stmt->close();
    } else {
        // Greška pri pripremanju naredbe
        echo "Greška pri pripremanju upita: " . $conn->error;
    }

    // Zatvaranje konekcije sa bazom
    $conn->close();
} else {
    // Nisu svi potrebni podaci poslati iz forme
    echo "Niste poslali sve potrebne podatke iz forme.";
}
?>
