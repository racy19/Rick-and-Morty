<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/ramStyle.css">
</head>

<body class="bg-dark">
<div style="background: #001f4c">
        <nav class="navbar navbar-expand-sm navbar-dark px-2 py-0 container">
            <a class="navbar-brand p-0" href="index.php">
                <img src="img/ram.png" width="100" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav"
                aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="main-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Let's discover...
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="characters.php">Characters</a>
                            <a class="dropdown-item" href="location.php">Locations</a>
                            <a class="dropdown-item" href="episode.php">Episodes</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="pexeso.php">Play a game!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
<?php 
$header1 = '<div id="header-hero">
        <div class="container">
            <div class="row g-2" style="justify-content: end;">
                <div class="col-12 col-lg-8">
                    <img src="img/monsters.png" style="width:90%; max-width:350px;position:relative; left: calc(10vw)">
                    <div class="row mt-3">
                        <div class="col-3 d-none d-xl-inline">
                            <img src="img/yellow-cat.png" class="d-block ms-auto" width="150" style="max-width: 150px;">
                        </div>
                        <div class="col-lg-9 col-12 p-3 p-sm-5" style="background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .3)); border-radius: 10px;">
                            <h1 class="mt-sm-1">Rick and Morty</h1>
                            <p class="mt-5 fs-5">Welcome to the database dedicated to the series Rick and Morty. This
                                database offers
                                a list of characters, locations, and episodes, along with their connections. Feel free
                                to discover
                                any details of this captivating show!</p>
                            <a href="characters.php" class="btn btn-outline-light btn-hero mt-3">characters</a>
                            <a href="location.php" class="btn btn-outline-light btn-hero mt-3">locations</a>
                            <a href="episode.php" class="btn btn-outline-light btn-hero mt-3">episodes</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12 text-end">
                    <img src="img/rick-morty.png" style="width: 100%; max-width: 400px; position: relative; left: -calc(3vw)" class="mt-2 mt-sm-5">
                </div>
                <div class="col-xl-8 col-12 d-none d-lg-flex align-items-end justify-content-center">
                    <img src="img/pickle.png" class="me-xxl-3" width="90">
                    <div class="d-flex flex-column justify-content-end align-items-end me-xxl-3">
                        <img src="img/rick-and-morty.png" alt="" style="max-width: 300px;">
                        <span>
                            <a href="about.php#series" class="btn btn-outline-light btn-hero align-self-center">about the
                                show</a>
                            <a href="about.php#about-app" class="btn btn-outline-light btn-hero align-self-center">about this
                                app</a>
                        </span>
                    </div>
                    <img src="img/orange-monkey.png" style="max-width: 75px;">
                    <img src="img/blue.png" style="width: 100%;max-width: 110px;" class="mt-4">
                    <div class="d-flex flex-column justify-content-start align-items-start" style="min-width: 178px;">
                        <a href="pexeso.php" class="btn btn-outline-light btn-hero align-self-center justify-content-end mb-5">try matching
                        game!</a>
                        <img src="img/rick-morty-fuckoff.png" style="max-width: 130px;">
                    </div>
                </div>
                <div class="col-xl-4 col-sm-8 col-12 d-flex flex-xxl-column align-items-end justify-content-end mt-5" style="justify-content: center;">
                    <img src="img/rick-sanchez.png" width="110">
                    <div class="p-3 text-center bubble align-item-start" style="border-radius: 10px;max-width: 280px;">
                        <h1 class="fs-5">Dunno what to do?</h1>
                        <p class="mt-3">Try to explore random characters and get familiar with them!</p>
                        <a href="#random-characters" class="btn btn-outline-light btn-hero">yes!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>';
$header2 = '<div id="header-hero">
        <div class="container">
            <div class="row g-2" style="justify-content: end;">
                <div class="col-12 col-lg-8">
                    <img src="img/monsters.png" style="width:90%; max-width:350px;position:relative; left: calc(10vw)">
                    <div class="row mt-3">
                        <div class="col-3 d-none d-xl-inline">
                            <img src="img/yellow-cat.png" class="d-block ms-auto" width="150" style="max-width: 150px;">
                        </div>
                        <div class="col-lg-9 col-12 p-3 p-sm-5" style="background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .3)); border-radius: 10px;">
                            <h1 class="mt-sm-1">Rick and Morty</h1>
                            <p class="mt-5 fs-5">Welcome to the database dedicated to the series Rick and Morty. This
                                database offers
                                a list of characters, locations, and episodes, along with their connections. Feel free
                                to discover
                                any details of this captivating show!</p>
                            <a href="characters.php" class="btn btn-outline-light btn-hero mt-3">characters</a>
                            <a href="location.php" class="btn btn-outline-light btn-hero mt-3">locations</a>
                            <a href="episode.php" class="btn btn-outline-light btn-hero mt-3">episodes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 text-end">
                    <img src="img/rick-morty.png" style="width: 100%; max-width: 400px; position: relative; left: -calc(3vw)" class="mt-2 mt-sm-5">
                </div>
                <hr class="mt-5 mb-0 d-none d-xl-inline" style="border: none;border-top: 1px solid rgba(255, 255, 255, 0.1);box-shadow: 0 4px 5px rgba(255, 255, 255, 1);">
                <div class="col-xl-8 col-12 d-none d-lg-flex align-items-end justify-content-center">
                        <div class="d-flex gap-2">
                            <div class="p-3 text-center bubble d-flex flex-column justify-content-between align-items-center" style="border-radius: 10px;min-width:210px;max-width: 220px;">
                                <img src="img/orange-monkey.png" style="max-width: 75px;">
                                <a href="about.php#series" class="btn btn-outline-light btn-hero">about the show</a>
                            </div>
                            <div class="p-3 text-center bubble d-flex flex-column justify-content-between align-items-center" style="border-radius: 10px;min-width:210px;max-width: 220px;">
                                <img src="img/rick-morty-fuckoff.png" style="max-width: 140px;">
                                <a href="about.php#about-app" class="btn btn-outline-light btn-hero">about this app</a>
                            </div>
                            <div class="p-3 text-center bubble d-flex flex-column justify-content-between align-items-center" style="border-radius: 10px;min-width:210px;max-width: 220px;">
                                <img src="img/blue.png" style="max-width: 80px;">
                                <a href="pexeso.php" class="btn btn-outline-light btn-hero">try matching game!</a>
                            </div>
                        </div>
                </div>
                <div class="col-xl-4 col-sm-8 col-12 d-flex flex-xl-column align-items-end justify-content-end" style="justify-content: center;">
                    <img src="img/rick-sanchez.png" width="110">
                    <div class="p-3 text-center bubble align-item-start" style="border-radius: 10px;max-width: 280px;">
                        <h1 class="fs-5">Dunno what to do?</h1>
                        <p class="mt-3">Try to explore random characters and get familiar with them!</p>
                        <a href="#random-characters" class="btn btn-outline-light btn-hero">yes!</a>
                    </div>
                </div>
            </div>
        </div>
</div>';
if ($currentPageName == "index.php") echo $header2 ?>

<main class="bg-light pt-5 pb-5">
  <div class="container">