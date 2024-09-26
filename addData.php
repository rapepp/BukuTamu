<?php
// session_start();

// if (!isset($_SESSION['login'])) {
//      header('location:login.php');
//      exit;
// }

require 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (tambah($_POST) > 0) {
          $nama = htmlspecialchars($_POST["nama"]);
          $kepentingan = htmlspecialchars($_POST["kepentingan"]);
          $keperluan = htmlspecialchars($_POST["keperluan"]);
          $tgl_Temu = htmlspecialchars($_POST['tgl_Temu']);
          $telp = htmlspecialchars($_POST['telp']);

          // Pesan yang akan dikirim ke WhatsApp
          $message = "Data baru telah ditambahkan:\nNama: $nama\nKepentingan: $kepentingan\nKeperluan: $keperluan\nTanggal Temu: $tgl_Temu\nNo. HandPhone Tamu: $telp";
          $recipientNumber = '+6285224186718';

          // Mengirim pesan WhatsApp
          sendWhatsAppMessage($message, $recipientNumber);

          echo "<script>
                 alert('Data berhasil ditambahkan!');
                 document.location.href = 'confirmation.php';
               </script>";
     } else {
          echo "<script>
                 alert('Data gagal ditambahkan!');
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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <link rel="stylesheet" href="css/style.css">
     <title>Tambah Data</title>
</head>

<body background="img/bg/bg.jpg">
     <nav class="navbar navbar-expand-lg navbar-dark text-uppercase" style="background: #3dc0eb; position: relative;">
          <div class="container">
               <a class="navbar-brand" href="index.php">
                    <img src="img/bg/logo.png" alt="Logo" style="height: 40px;">
               </a>
               <div class="navbar-text position-absolute start-50 translate-middle-x">
                    <span>Sistem Admin Data Tamu</span>
               </div>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Home</a>
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
          <div class="row my-2">
               <div class="col-md text-light">
                    <h3 class="fw-bold text-uppercase Tambah_data"></h3>
               </div>
               <hr>
          </div>
          <div class="row my-2 text-light">
               <div class="col-md">
                    <form action="" method="post" enctype="multipart/form-data">
                         <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control form-control-md w-50" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <div class="col-md-6 mb-3">
                                   <label for="tgl_Temu" class="form-label">Tanggal Temu</label>
                                   <input type="date" class="form-control w-25" id="tgl_Temu" name="tgl_Temu" max="2062-01-01" required>
                              </div>
                         </div>
                         <div class="mb-3">
                              <label for="gambar" class="form-label">Gambar</label>
                              <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                         </div>
                         <div class="mb-3">
                              <label for="kepentingan" class="form-label">Kepentingan Kepada</label>
                              <textarea class="form-control w-50" id="kepentingan" rows="2" name="kepentingan" placeholder="Masukkan Kepentingan kepada siapa" autocomplete="off" required></textarea>
                         </div>
                         <div class="mb-3">
                              <label for="keperluan" class="form-label">Keperluan</label>
                              <textarea class="form-control w-50" id="keperluan" rows="3" name="keperluan" placeholder="Masukkan Keperluanmu" autocomplete="off" required></textarea>
                         </div>
                         <div class="mb-3">
                              <label for="telp" class="form-label">Nomor Telepon</label>
                              <input type="number" class="form-control w-25" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" required>
                         </div>
                         <hr>
                         <a href="index.php" class="btn btn-secondary">Kembali</a>
                         <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </form>
               </div>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
     <script>
          gsap.registerPlugin(TextPlugin);
          gsap.to('.Tambah_data', {
               duration: 2,
               delay: 1,
               text: '<i class="bi bi-person-plus-fill"></i> Silahkan Isi Form berikut sebagai Tamu KOMINFO'
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