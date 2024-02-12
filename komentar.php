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
    <title>Halaman Komentar</title>
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
            <h1>Komentar</h1>
        </header>
    </div>

<!-- Modal -->
<div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCommentModalLabel">Tambah Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="tambah_komentar.php" method="post">
                    <?php
                    include "koneksi.php";
                    $fotoid = $_GET['fotoid'];
                    $sql = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                        <div class="mb-3">
                            <label for="judulfoto" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judulfoto" name="judulfoto" value="<?= $data['judulfoto'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsifoto" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="lokasifile" class="form-label">Foto</label><br>
                            <img src="gambar/<?= $data['lokasifile'] ?>" width="200px">
                        </div>
                        <div class="mb-3">
                            <label for="isikomentar" class="form-label">Komentar</label>
                            <input type="text" class="form-control" id="isikomentar" name="isikomentar">
                        </div>
                    <?php
                    }
                    ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
       <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCommentModal"><i class="bi bi-plus-circle-fill"></i>
        Tambah Komentar
    </button>
    <table class="table table-bordered table-striped mt-4">
        <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>Komentar</td>
            <td>Tanggal</td>
        </tr>
        <?php
            include "koneksi.php";
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "SELECT * FROM komentarfoto,user WHERE komentarfoto.userid=user.userid"); 
            while ($data = mysqli_fetch_array($sql)) { 

        ?>


            <tr>
                <td><?=$data['komentarid']?></td>
                <td><?=$data['namalengkap']?></td>
                <td><?=$data['isikomentar']?></td>
                <td><?=$data['tanggalkomentar']?></td>
            </tr>
        <?php
          }
        ?>
    </table>
</div> 

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>