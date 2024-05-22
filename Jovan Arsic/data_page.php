<?php
    // Pokretanje sesije
    session_start();

    // Provera da li je korisnik ulogovan
    if (!isset($_SESSION['korisnik_id'])) {     
        // Korisnik nije ulogovan, redirekcija na stranicu za login
        header("Location: index.php");
        exit();
    }

    // Dobijanje imena i prezimena korisnika iz baze podataka
    include 'php/konekcija.php';

    $korisnikId = $_SESSION['korisnik_id'];
    $upit = "SELECT ime, prezime FROM korisnici WHERE id = '$korisnikId'";
    $rezultat = mysqli_query($conn, $upit);
    
    if ($rezultat && mysqli_num_rows($rezultat) === 1) {
        $korisnik = mysqli_fetch_assoc($rezultat);
        $imePrezime = $korisnik['ime'] . ' ' . $korisnik['prezime'];
    } else {
        // Greška pri dobijanju podataka iz baze
        $imePrezime = 'Nepoznati korisnik';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dodavanje objave</title>
</head>
<body>


<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">Pozdrav, <?php echo $imePrezime; ?></h5>
        </div>
        <div class="card-body">
            <form action="php/podaci.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="imePrijatelja" class="form-label">Username prijatelja</label>
                    <input type="text" class="form-control" id="imePrijatelja" name="imePrijatelja" required>
                </div>
                <div class="mb-3">
                    <label for="tekstObjave" class="form-label">Tekst objave</label>
                    <textarea class="form-control" id="tekstObjave" name="tekstObjave" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="slika" class="form-label">Izaberite sliku</label>
                    <input type="file" class="form-control" id="slika" name="slika" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Kreiraj objavu</button>
            </form>
            <a href="objave.php" class="btn btn-secondary mt-3">Pogledaj objave</a>
            <a href="index.php" class="btn btn-secondary mt-3">Odjava</a>
        </div>
    </div>
</div>

<style>
    body {
    background-color: rgb(51, 18, 63);
  }

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
