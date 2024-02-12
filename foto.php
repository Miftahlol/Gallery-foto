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
    <title>Halaman Foto</title>
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
        <h1>Foto</h1>
    </header>
</div>

<div class="container mt-5">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal"><i class="bi bi-plus-circle-fill"></i> Tambahkan Foto
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPhotoModalLabel">Tambahkan Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judulfoto">Judul</label>
                            <input type="text" class="form-control" id="judulfoto" name="judulfoto">
                        </div>
                        <div class="form-group">
                            <label for="deskripsifoto">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsifoto" name="deskripsifoto">
                        </div>
                        <div class="form-group">
                            <label for="lokasifile">Lokasi File</label>
                            <input type="file" class="form-control-file" id="lokasifile" name="lokasifile">
                        </div>
                        <div class="form-group">
                            <label for="albumid">Album</label>
                            <select class="form-control" id="albumid" name="albumid">
                                <?php
                                include "koneksi.php";
                                $userid = $_SESSION['userid'];
                                $sql = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>  
                                    <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option> 
                                <?php       
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-4">
    <div class="row">
      
        
        <?php
        include "koneksi.php";
        $userid = $_SESSION['userid'];
        $sql = mysqli_query($conn, "SELECT * FROM foto,album WHERE foto.userid='$userid' AND foto.albumid=album.albumid"); 
        while ($data = mysqli_fetch_array($sql)) { ?>   
            <div class="col-md-4 mb-4">
                <div class="card">
                <img src="gambar/<?=$data['lokasifile']?>" class="card-img-top" width="250" height="350" >
                <div class="card-body">
                    <h5 class="card-title"><?= $data['judulfoto'] ?></h5>
                    <p class="card-text"><?= $data['deskripsifoto'] ?></p>
                    <p class="card-text"><small class="text-muted">Tanggal Unggah: <?= $data['tanggalunggah'] ?></small></p>
                    <p class="card-text">Album: <?= $data['namaalbum'] ?></p>
                    <p class="card-text">Disukai: 
                        <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                        ?>
                    </p>
                    <div class="btn-group" role="group">
                        <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-danger btn-sm"><i class='bi bi-trash'></i> Hapus</a>
                        <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-primary btn-sm"><i class='bi bi-pencil'></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
       
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>