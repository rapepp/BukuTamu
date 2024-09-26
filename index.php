<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';



$tamu = query("SELECT * FROM tamu");

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
    
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
     
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
   
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
     <link rel="stylesheet" href="css/style.css">

     <title>Buku Tamu Pusat Data Kabupaten Situbondo</title>
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
          <div class="row my-2">
               <div class="col-md">
                    <h3 class="text-center fw-bold text-uppercase text-light data_tamu"></h3>
                    <hr>
               </div>
          </div>
          <div class="row my-2">
               <div class="col-md">
                    <a href="addData.php" class="btn btn-primary" data-aos="fade-right" data-aos-duration="800"
                         data-aos-delay="1200"><i class="bi bi-person-plus-fill"></i>Tambah Data</a>
                    <a href="export.php" target="_blank" class="btn btn-success ms-1" data-aos="fade-left"
                         data-aos-duration="1000" data-aos-delay="1600"><i
                              class="bi bi-file-earmark-spreadsheet-fill"></i>Ekspor ke Excel</a>
               </div>
          </div>
          <div class="row my-3" data-aos="fade" data-aos-duration="1000" data-aos-delay="2000">
               <div class="col-md">
                    <table id="data" class="table table-striped table-responsive table-hover text-center"
                         style="width:100%">
                         <thead class="" style="background-color: #3dc0eb;">
                              <tr>
                                   <th>No.</th>
                                   <th>Nama</th>
                                   <th>Tanggal Temu</th>
                                   <th>Kepentingan</th>
                                   <th>Telepon</th>
                                   <th>Keperluan</th>
                                   <th>Aksi</th>
                                  
                              </tr>
                         </thead>
                         <tbody>
                              <?php $no = 1; ?>
                              <?php foreach ($tamu as $row) : ?>
                              <tr class="table-secondary text-dark">
                                   <td><?= $no++; ?></td>
                                   <td><?= $row['nama']; ?></td>
                                   <?php
                                $now = time();
                                $timeTahun = strtotime($row['tgl_Temu']);
                                $setahun = 31536000;
                                $hitung = ($now - $timeTahun) / $setahun;
                                ?>
                                   <td><?= date('d-m-Y', strtotime($row['tgl_Temu'])); ?></td>
                                   <td><?= $row['kepentingan']; ?></td>
                                   <td><?= $row['telp']; ?></td>
                                   <td><?= strlen($row['keperluan']) >20 ? substr($row['keperluan'],0,20). '...': $row['keperluan']; ?></td>
                                   <td>
                                        <button class="btn btn-success btn-sm text-white detail"
                                             data-id="<?= $row['nama']; ?>" style="font-weight: 600;"><i
                                                  class="bi bi-info-circle-fill" data-aos="fade-right"
                                                  data-aos-duration="800"></i>Detail</button> |

                                        <a href="ubah.php?nama=<?= $row['nama']; ?>" class="btn btn-warning btn-sm"
                                             style="font-weight: 600;"><i class="bi bi-pencil-square"></i>Ubah</a> |

                                        <a href="hapus.php?nama=<?= $row['nama']; ?>" class="btn btn-danger btn-sm"
                                             style="font-weight: 600;"
                                             onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['nama']; ?> ?');"><i
                                                  class="bi bi-trash-fill"></i>Hapus</a>
                                   </td>
                              </tr>
                              <?php endforeach; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
    
     <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title fw-bold text-uppercase" id="detail"></h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="detail-tamu">
                    </div>
               </div>
          </div>
     </div>
   
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>

  
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

     <script>
     $(document).ready(function() {
          
          $('#data').DataTable();
         
          $('.detail').click(function() {
               var dataTamu = $(this).attr("data-id");
               $.ajax({
                    url: "detail.php",
                    method: "post",
                    data: {
                         dataTamu,
                         dataTamu
                    },
                    success: function(data) {
                         $('#detail-tamu').html(data);
                         $('#detail').modal("show");
                    }
               });
          });

     });
     </script>

     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script>
     AOS.init({
          once: true,

     });
     </script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
     <script>
     gsap.registerPlugin(TextPlugin);
     gsap.to('.data_tamu', {
          duration: 1,
          delay: 0.6,
          text: 'Data Tamu'
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
