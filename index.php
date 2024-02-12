<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['userid'])){
    ?>
        <div class="container mt-5">
  <div class="jumbotron text-center">
    <h1 class="display-4">Selamat Datang</h1>
    <p class="lead">Gallery foto!</p>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Register</h5>
          <p class="card-text">Create an account to access our services.</p>
          <a href="register.php" class="btn btn-primary btn-block">Register</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Login</h5>
          <p class="card-text">Already have an account? Log in here.</p>
          <a href="login.php" class="btn btn-primary btn-block">Login</a>
        </div>
      </div>
    </div>
  </div>
</div>
    <?php        
        } else {
    ?>
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
        <header class="text-center">
            <h1>Home</h1>
            <p>Selamat datang <b><?= $_SESSION['namalengkap'] ?></b></p>
        </header>
    <?php        
        }
    ?>

    <div class="container mt-4">
        <div class="row">
            <?php
                include "koneksi.php";
                $sql=mysqli_query($conn,"SELECT * FROM  foto,user WHERE foto.userid=user.userid");
                while($data=mysqli_fetch_array($sql)){
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="gambar/<?=$data['lokasifile']?>" class="card-img-top" alt="<?=$data['judulfoto']?>" width="250" height="350">
                    <div class="card-body">
                        <h5 class="card-title"><?=$data['judulfoto']?></h5>
                        <p class="card-text"><?=$data['deskripsifoto']?></p>
                        <p class="card-text">Uploader: <?=$data['namalengkap']?></p>
                        <p class="card-text">Likes: <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='{$data['fotoid']}'")); ?></p>
                        <a href="like.php?fotoid=<?=$data['fotoid']?>" class="btn btn-primary"><i class="bi bi-heart-fill"></i></a>
                        <a href="komentar.php?fotoid=<?=$data['fotoid']?>" class="btn btn-secondary"><i class="bi bi-chat-dots-fill"></i></a>
                    </div>
                </div>
            </div>
            <?php        
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
