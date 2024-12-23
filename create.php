<?php
include_once 'ServisController.php';
include_once 'SessionCookieController.php';

session_start(); // Memulai session di awal file
$session = new SessionCookieController();

// Cek cookie login status, jika tidak true kembali ke login.php
if($session->getCookie('login_status') !== 'true') {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $servis = $_POST['servis'];
    $kendaraan = $_POST['kendaraan'];
    $tanggal = $_POST['tanggal'];
    
    $service = new ServisController();
    if ($service->create($servis, $kendaraan, $tanggal)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambahkan Data Servis!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Servis</title>
    <link rel="stylesheet" href="create.css">
    <script>
        // Validasi client-side
        function validateForm() {
            var servis = document.getElementById('servis').value;
            var kendaraan = document.getElementById('kendaraan').value;
            var tanggal = document.getElementById('tanggal').value;
            var errorMessages = [];

            // Menghapus pesan error sebelumnya 
            document.getElementById('error-messages').innerHTML = "";

            // Validasi "Jenis Servis" sudah di isi
            if (servis.trim() === "") {
                errorMessages.push("Nama Jenis Servis harus diisi.");
            }

            // Validasi panjang minimal "Jenis Servis"
            if (servis.length < 5) {    
                errorMessages.push("Nama Jenis Servis minimal 5 karakter.");
            }
            
            // Validasi "Jenis Kendaraan" sudah di isi
            if (kendaraan.trim() === "") {
                errorMessages.push("Nama Jenis Kendaraan harus diisi.");
            }

            // Validasi panjang minimal "Jenis Kendaraan"
            if (kendaraan.length < 5) {    
                errorMessages.push("Nama Jenis Kendaraan minimal 5 karakter.");
            }

            // Validasi "Tanggal" sudah di isi
            if (tanggal.trim() === "") {
                errorMessages.push("tanggal harus diisi.");
            }

            // Validasi panjang minimal "Tanggal"
            if (tanggal.length < 5) {    
                errorMessages.push("tanggal minimal 5 karakter.");
            }

            // Menampilkan error jika ada
            if (errorMessages.length > 0) {
                var errorMessageList = "<ul>";
                errorMessages.forEach(function (message) {
                    errorMessageList += "<li>" + message + "</li>";
                });
                errorMessageList += "</ul>";
                document.getElementById('error-messages').innerHTML = errorMessageList;
                return false;  // Menghentikan form submission
            }

            return true;  // Melanjutkan form submission
        }
    </script>
</head>

<body>
    <form method="POST" onsubmit="return validateForm()">
        <h1>Tambah Data Servis</h1>
        <label for="servis">Jenis Servis:</label>
        <input type="text" id="servis" name="servis"><br><br>

        <label for="kendaraan">Jenis Kendaraan:</label>
        <input type="text" id="kendaraan" name="kendaraan"><br><br>
        
        <label for="tanggal">Tanggal:</label>
        <input type="text" id="tanggal" name="tanggal"><br><br>
        
        <input type="hidden" name="action" value="create">
        <button type="submit">Tambah Data</button>
        <div id="error-messages" style="color: red;"></div> <!-- Menampilkan pesan error -->
    </form>
</body>

</html>