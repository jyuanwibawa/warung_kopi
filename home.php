<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Recomend Cafe</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg">
    <div class="bg_atas">
        <div class="meetnmugatas"><b>MeetNMug</b></div>
        <div class="fyc"><b>Find your cafe!</b></div>
        <div class="temukanatas">Temukan cafe sesuai mood dan kebutuhanmu</div>
    </div>

    <div class="home"><b>Home</b></div>
    <div class="bm">By Mood</div>
    <div class="ba">By Activity</div>
    <div class="hi">
        <div class="hi_elips"></div>
        <div class="hi_user">Hi, <?php echo $_SESSION['username']; ?>👋🏻</div>
    </div>

    <!-- Search Form -->
    <div class="bg_tengah">
        <div class="formcaritengah">
            <input type="text" placeholder="Cari disini..." class="search-input">
            <button class="search-button">
                <img src="search-icon.png" alt="Search" class="search-icon">
            </button>
        </div>
        <div class="border_icon">
            <img src="assets/maskot.svg" width="277" height="277" >
        </div>

        <div class="howday"><b>How’s your day?</b><br></div>
        <div class="ratehari">Rate harimu dengan emoji! Gimana hari ini?</div>

        <div class="howmood"><b>How’s your mood?</b><br></div>
        <div class="tetengah">Temukan kafe yang cocok dengan suasana hatimu</div>

        


        <div class="wdy"><b>What do you want to do now?</b><br></div>
        <div class="kira">Kira kira apa agenda kamu hari ini?</div>

        <div class="gambar_rapat">
            <img src="assets/cafe-rapat.svg">
        </div>
        <div class="gambar_belajar">
            <img src="assets/cafe-belajar.svg">
        </div>
        <div class="gambar_tim">
            <img src="assets/cafe-bekerjatim.svg">
        </div>

        <div class="kotak_rapat"></div>
        <div class="kotak_belajar"></div>
        <div class="kotak_tim"></div>

        <div class="word_rapat"><b>Rapat</b></div>
        <div class="word_belajar"><b>Belajar</b></div>
        <div class="word_tim"><b>Bekerja Tim</b></div>
    </div>

    <div class="bg_bawah">
        <div class="meetnmugbawah"><b>MeetnMug</b></div>
        <div class="temukanbawah">Temukan kafe terbaik yang sempurna untuk<br>
                                mood dan kebutuhanmu! Nikmati suasana<br>
                                yang pas untuk bekerja atau bersantai.<br></div>
        <div class="ig"></div>
        <div class="yt"></div>
        <div class="fb"></div>
        <div class="call"></div>

        <hr class="garis">
        <div class="copyright">Copyright © 2024 | By Kelompok 2 🤍</div>
    </div>
</body>
</html>
