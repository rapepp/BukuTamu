<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

if (isset($_GET['nama']) && !empty($_GET['nama'])) {
    $nama = htmlspecialchars($_GET['nama']); // Sanitize input

    if (hapus($nama) > 0) {
        echo "<script>
                alert('Data tamu berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data tamu gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Data yang dihapus tidak valid!');
            document.location.href = 'index.php';
        </script>";
}
?>
