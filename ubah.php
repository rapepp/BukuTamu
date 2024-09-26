<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

// Example of ubah.php
$nama = $_GET['nama'];
$tamu = query("SELECT * FROM tamu WHERE nama = '$nama'")[0];


if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data tamu berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data tamu gagal diubah!');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="img/bg/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="css/style.css">

    <title>Update Data Tamu </title>
</head>

<body background="img/bg/bg.jpg">

    <nav class="navbar navbar-expand-lg navbar-dark text-uppercase" style="background: #3dc0eb; position: relative;">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="img/bg/logo.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-text position-absolute start-50 translate-middle-x">
                <span>Sistem Admin Data Tamu</span>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row my-2 text-light">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase ubah_data"></h3>
            </div>
            <hr>
        </div>
        <div class="row my-2 text-light">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gambarLama" value="<?= $tamu['gambar']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control w-100" id="nama" value="<?= $tamu['nama']; ?>" name="nama" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_Temu" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control w-100" id="tgl_Temu" value="<?= $tamu['tgl_Temu']; ?>" name="tgl_Temu" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="kepentingan" class="form-label">Kepentingan</label>
                                <textarea class="form-control w-100" id="kepentingan" rows="2" name="kepentingan" placeholder="Masukkan Kepentingan kepada siapa" autocomplete="off" required><?= $tamu['kepentingan']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <textarea class="form-control w-100" id="keperluan" rows="2" name="keperluan" placeholder="Masukkan Keperluanmu" autocomplete="off" required><?= $tamu['keperluan']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control w-25" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-end">
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                                <img src="img/<?= $tamu['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                                <input class="form-control form-control-sm w-100" id="gambar" name="gambar" type="file">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
    <script>
        gsap.registerPlugin(TextPlugin);
        gsap.to('.ubah_data', {
            duration: 2,
            delay: 1,
            text: '<i class="bi bi-pencil-square"></i>Ubah Data Tamu'
        })
        gsap.from('.navbar', {
            duration: 1,
            y: '-100%',
            opacity: 0,
            ease: 'bounce',
        })
    </script>
</body>

</html>