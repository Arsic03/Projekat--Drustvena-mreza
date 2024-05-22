<?php
// Povezivanje sa bazom podataka
include 'konekcija.php';

// Čitanje podataka iz tabele "podaci"
$upitObjave = "SELECT slika, objava FROM podaci";
$rezultatObjave = mysqli_query($conn, $upitObjave);

// Provera da li ima rezultata
if ($rezultatObjave && mysqli_num_rows($rezultatObjave) > 0) {
    // Prikazivanje podataka
    while ($red = mysqli_fetch_assoc($rezultatObjave)) {
        echo '<div class="card mb-3">';
        echo '<img src="data:image/jpeg;base64,'.base64_encode($red['slika']).'" class="card-img-top" alt="Slika objave">';
        echo '<div class="card-body">';
        echo '<p class="card-text">'.$red['objava'].'</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // Ako nema rezultata
    echo '<div class="alert alert-warning" role="alert">Nema objava.</div>';
}

// Zatvaranje konekcije
mysqli_close($conn);
?>
