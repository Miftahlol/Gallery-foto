<?php
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['userid'])) {
        header("location:login.php");
    }

    $userid = $_SESSION['userid'];
    $result = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
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
            <h1>Album</h1>
        </header>
    </div>

    

    <!-- Modal -->
    <div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="albumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="albumModalLabel">Tambah Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="tambah_album.php" method="post">
                        <div class="mb-3">
                            <label for="namaAlbum" class="form-label">Nama Album</label>
                            <input type="text" class="form-control" id="namaAlbum" name="namaalbum">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        </div>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="container">
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#albumModal">
        Tambah Album
    </button>
<table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Tanggal dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        ?>
        <?php $i = 1; ?>
        <?php foreach($result as $d) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $d['namaalbum'] ?></td>
                <td><?= $d['deskripsi'] ?></td>
                <td><?= $d['tanggaldibuat'] ?></td>
                <td>
                    <a href="hapus_album.php?albumid=<?= $d['albumid'] ?>" class="btn btn-danger"><i class='bi bi-trash'></i> Hapus</a>
                    <a href="edit_album.php?albumid=<?= $d['albumid'] ?>" class="btn btn-primary"><i class='bi bi-pencil'></i> Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>
</body>
</html>
