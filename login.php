<?php
include_once 'SessionCookieController.php';

session_start(); // Memulai session di awal file

// Handle form submission for login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $katasandi = $_POST['katasandi'];
    $session = new SessionCookieController();

    // Cek username katasandi
    if ($username === 'gudang2204' && $katasandi === 'servis2024') {
        // Sukses set cookie
        $session->setCookie('login_status', 'true', time() + 3600);
        header("Location: index.php");
        exit();
    } else {
        // Gagal set session
        $session->setSession('login_failed', 'username atau kata sandi salah.');
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script>
        // Validasi client-side
        function validateFormAndLogin() {
            var username = document.getElementById('username').value;
            var katasandi = document.getElementById('katasandi').value;
            var errorMessages = [];

            // Menghapus pesan error sebelumnya 
            document.getElementById('error-messages').innerHTML = "";

            // Validasi "Username" sudah di isi
            if (username.trim() === "") {
                errorMessages.push("username harus diisi.");
            }

            // Validasi panjang minimal "Username"
            if (username.length < 5) {
                errorMessages.push("username minimal 5 karakter.");
            }

            // Validasi "Katasandi" sudah di isi
            if (katasandi.trim() === "") {
                errorMessages.push("katasandi harus diisi.");
            }

            // Validasi panjang minimal "Katasandi"
            if (katasandi.length < 5) {
                errorMessages.push("Nama Mata Kuliah minimal 5 karakter.");
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

        }
    </script>
</head>

<body>
    
    <?php
    // Menampilkan pesan jika ada session 'login_failed'
    $session = new SessionCookieController();
    if ($session->getSession('login_failed')) {
        echo "<p>" . $session->getSession('login_failed') . "</p>";
        $session->destroySession(); // Menghapus pesan setelah ditampilkan
    }
    ?>
    <div class="container">
        <form method="POST" onsubmit="return validateFormAndLogin()">
            <h1>Login</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            
            <label for="katasandi">Katasandi:</label>
            <input type="password" id="katasandi" name="katasandi"><br><br>
            
            <input type="hidden" name="action" value="create">
            <button type="submit">Login</button>
            <div id="error-messages" style="color: red;"></div> <!-- Menampilkan pesan error -->
    </form>
    </div>
</body>

</html>