<?php
    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }

    $userid = $_SESSION['userid'];
    $sql = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <h2 class="navbar-brand">Gallery foto</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house-door"></i> Home</a>
                    <a class="nav-link" href="album.php"><i class="bi bi-journal-album"></i> Album</a>
                    <a class="nav-link" href="foto.php"><i class="bi bi-card-image"></i> Foto</a>
                    <a class="nav-link" href="logout.php"><i class="bi bi-door-open-fill"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <header class="text-center">
            <h1>Edit Album</h1>
        </header>
    </div>
<div class="container">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <form action="update_album.php" method="post">
                    <?php
                    include "koneksi.php";
                    $albumid = $_GET['albumid'];
                    $sql = mysqli_query($conn, "SELECT * FROM album WHERE albumid='$albumid'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" name="albumid" value="<?= $data['albumid'] ?>" hidden>
                        <div class="mb-3">
                            <label for="namaalbum" class="form-label">Nama Album</label>
                            <input type="text" class="form-control" id="namaalbum" name="namaalbum" value="<?= $data['namaalbum'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $data['deskripsi'] ?>">
                        </div>
                    <?php
                    }
                    ?>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-pencil-fill"></i> Ubah
                            </button>
                            <a href="album.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>