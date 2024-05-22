<?php
// Povezivanje sa bazom podataka
include 'konekcija.php';

// Čitanje liste prijatelja iz tabele "podaci"
$upitPrijatelji = "SELECT prijatelji FROM podaci"; // Prilagodite ovaj upit vašoj bazi
$rezultatPrijatelji = mysqli_query($conn, $upitPrijatelji);

// Provera da li ima rezultata
if ($rezultatPrijatelji && mysqli_num_rows($rezultatPrijatelji) > 0) {
    // Prikazivanje liste prijatelja
    while ($red = mysqli_fetch_assoc($rezultatPrijatelji)) {
        echo '<p>' . $red['prijatelji'] . '</p>';
    }
} else {
    // Ako nema rezultata
    echo '<div class="alert alert-warning" role="alert">Nema prijatelja.</div>';
}

// Zatvaranje konekcije
mysqli_close($conn);
?>
