<?php
    session_start();
    include "koneksi.php";

    if(!isset($_SESSION['userid'])){
        header("location:login.php");
        exit; // Added to stop further execution if user is not logged in
    }

    $userid = $_SESSION['userid'];
    $sql_album = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
        <!-- Navigator -->
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
            <h1>Edit Foto</h1>
        </header>
    </div>

    <div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form action="update_foto.php" method="post" enctype="multipart/form-data">
                <?php
                include "koneksi.php";
                $fotoid = $_GET['fotoid'];
                $sql_foto = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'");
                while ($data = mysqli_fetch_array($sql_foto)) {
                ?>
                    <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                    <div class="mb-3">
                        <label for="judulfoto" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judulfoto" name="judulfoto" value="<?= $data['judulfoto'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsifoto" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lokasifile" class="form-label">Lokasi File</label>
                        <input type="file" class="form-control" id="lokasifile" name="lokasifile">
                    </div>
                    <div class="mb-3">
                        <label for="albumid" class="form-label">Album</label>
                        <select class="form-select" id="albumid" name="albumid">
                            <?php
                            while ($data_album = mysqli_fetch_array($sql_album)) {
                            ?>
                                <option value="<?= $data_album['albumid'] ?>" <?php if ($data_album['albumid'] == $data['albumid']) {echo 'selected';} ?>>
                                    <?= $data_album['namaalbum'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                <?php
                }
                ?>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-fill"></i> Ubah</button>
                    <a href="foto.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

    

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
