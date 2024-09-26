<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Twilio\Rest\Client;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Connect to the database using environment variables
$koneksi = mysqli_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));

function query($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi untuk mengirim pesan WhatsApp menggunakan Twilio
function sendWhatsAppMessage($message, $recipientNumber) {
    $sid = getenv('TWILIO_SID');
    $token = getenv('TWILIO_TOKEN');
    $twilio = new Client($sid, $token);

    try {
        $message = $twilio->messages
                          ->create("whatsapp:$recipientNumber", // Penerima
                                   [
                                       "from" => "whatsapp:+14155238886", 
                                       "body" => $message
                                   ]
                          );

        return $message->sid;
    } catch (Exception $e) {
        // Menangani error
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function tambah($data) {
    global $koneksi;
    $nama = htmlspecialchars($data['nama']);
    $tgl_Temu = htmlspecialchars($data['tgl_Temu']);
    $kepentingan = htmlspecialchars($data['kepentingan']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $telp = htmlspecialchars($data['telp']);
    $gambar = upload();

    $query = "INSERT INTO tamu (nama, tgl_Temu, kepentingan, keperluan, telp, gambar) VALUES ('$nama', '$tgl_Temu', '$kepentingan', '$keperluan', '$telp', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus($nama) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tamu WHERE nama = '$nama'");

    return mysqli_affected_rows($koneksi);
}

function ubah($data) {
    global $koneksi;
    $nama = htmlspecialchars($data['nama']);
    $tgl_Temu = htmlspecialchars($data['tgl_Temu']);
    $kepentingan = htmlspecialchars($data['kepentingan']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $telp = htmlspecialchars($data['telp']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    $gambar = ($gambarLama != $_FILES['gambar']['name']) ? upload() : $gambarLama;

    $query = "UPDATE tamu SET tgl_Temu = '$tgl_Temu', kepentingan = '$kepentingan', telp = '$telp', keperluan = '$keperluan', gambar = '$gambar' WHERE nama = '$nama'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('username sudah terdaftar');</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>alert('konfirmasi password tidak sesuai');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);
}
?>
