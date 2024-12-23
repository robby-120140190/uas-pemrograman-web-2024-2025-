<?php
include_once 'ServisController.php';
include_once 'SessionCookieController.php';

session_start(); // Memulai session di awal file
$session = new SessionCookieController();

// Cek cookie login status, jika tidak true kembali ke login.php
if($session->getCookie('login_status') !== 'true') {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $servis = $_POST['servis'];
    $kendaraan = $_POST['kendaraan'];
    $tanggal = $_POST['tanggal'];
    $service = new ServisController();
    if ($service->update($id, $servis, $kendaraan, $tanggal)) {
        // Redirect ke index.php setelah berhasil mengubah data
        header("Location: index.php");
        exit(); // Jangan lupa panggil exit setelah header untuk menghentikan eksekusi kode selanjutnya
    } else {
        echo "Gagal mengubah mata kuliah!";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = new ServisController();
    $serviceData = $service->readById($id);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Mata Kuliah</title>
    <link rel="stylesheet" href="update.css">
    <script>
        // Validasi client-side
        function validateForm() {
            var jenisServis = document.getElementById('servis').value;
            var jenisKendaraan = document.getElementById('kendaraan').value;
            var tanggal = document.getElementById('tanggal').value;
            var errorMessages = [];

            // Menghapus pesan error sebelumnya 
            document.getElementById('error-messages').innerHTML = "";

            // Validasi "jenis Servis" sudah di isi
            if (jenisServis.trim() === "") {
                errorMessages.push("jenis Servis harus diisi.");
            }

            // Validasi panjang minimal "jenis Servis"
            if (jenisServis.length < 5) {
                errorMessages.push("jenis Servis minimal 5 karakter.");
            }
            
            // Validasi "jenis Kendaraan" sudah di isi
            if (jenisKendaraan.trim() === "") {
                errorMessages.push("jenis Kendaraan harus diisi.");
            }

            // Validasi panjang minimal "jenis Kendaraan"
            if (jenisKendaraan.length < 5) {
                errorMessages.push("jenis Kendaraan minimal 5 karakter.");
            }

            // Validasi "tanggal" sudah di isi
            if (tanggal.trim() === "") {
                errorMessages.push("tanggal harus diisi.");
            }

            // Validasi panjang minimal "tanggal"
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
                return false;  // Prevent form submission
            }

            return true;  // Melanjutkan form submission
        }
    </script>
</head>

<body>
    <form method="POST" onsubmit="return validateForm()">
        <h1>Ubah Jenis Servis</h1>
        <input type="hidden" name="id" value="<?php echo isset($serviceData['id']) ? $serviceData['id'] : ''; ?>">
        
        <label for="servis">Jenis Servis:</label>
        <input type="text" id="servis" name="servis"
        value="<?php echo isset($serviceData['servis']) ? htmlspecialchars($serviceData['servis'], ENT_QUOTES, 'UTF-8') : ''; ?>"><br><br>

        <label for="kendaraan">Jenis Kendaraan:</label>
        <input type="text" id="kendaraan" name="kendaraan"
        value="<?php echo isset($serviceData['kendaraan']) ? htmlspecialchars($serviceData['kendaraan'], ENT_QUOTES, 'UTF-8') : ''; ?>"><br><br>
        
        <label for="tanggal">Tanggal:</label>
        <input type="text" id="tanggal" name="tanggal"
        value="<?php echo isset($serviceData['tanggal']) ? htmlspecialchars($serviceData['tanggal'], ENT_QUOTES, 'UTF-8') : ''; ?>"><br><br>
        
        <input type="hidden" name="action" value="update">
        <button type="submit">Ubah</button>
        <div id="error-messages" style="color: red;"></div> <!-- Menampilkan pesan error -->
    </form>
</body>

</html>