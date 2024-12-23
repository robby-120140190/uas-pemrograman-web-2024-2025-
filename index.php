<?php
include_once 'ServisController.php';
include_once 'SessionCookieController.php';

session_start(); // Memulai session di awal file
$session = new SessionCookieController();

// Cek cookie login status, jika tidak true kembali ke login.php
if ($session->getCookie('login_status') !== 'true') {
    header("Location: login.php");
}

// Menangani aksi delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $servis = new ServisController();
    if ($servis->delete($id)) {
        // Set pesan sukses ke session
        $session->setSession('success', 'Data Servis berhasil dihapus.');
        header("Location: index.php");
        exit(); // Pastikan tidak ada kode lain yang dijalankan setelah redirect
    } else {
        echo "Gagal menghapus Data Servis!";
    }
}

// Menangani aksi logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'logout') {
    $session->deleteCookie('login_status');
    header("Location: login.php");
    exit();
}

// Mengambil Log Servis
$servis = new ServisController();
$listServis = $servis->read();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Servis</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <h1>Data Servis</h1>

    <?php
    // Menampilkan pesan jika ada session 'success'
    $session = new SessionCookieController();
    if ($session->getSession('success')) {
        echo "<p>" . $_SESSION['success'] . "</p>";
        $session->destroySession(); // Menghapus pesan setelah ditampilkan
    }
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Jenis Servis</th>
                <th>Jenis Kendaraan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listServis as $servis): ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($servis['servis']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($servis['kendaraan']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($servis['tanggal']); ?>
                    </td>
                    <td>
                        <a href="update.php?id=<?php echo $servis['id']; ?>">Ubah</a> |
                        <a href="?action=delete&id=<?php echo $servis['id']; ?>"
                            onclick="return confirm('Hapus Data Servis?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="form-button">
    <a class="tombol" href="create.php">Tambah Data Servis</a>
    <form method="POST">
        <input type="hidden" name="action" value="logout">
        <button class="tombol_logout" type="submit">Logout</button>
    </form>
    </div>
</body>

</html>