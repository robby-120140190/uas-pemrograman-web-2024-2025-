<?php
// Kelas untuk menangani session dan cookie
class SessionCookieController {
    // Fungsi untuk memulai session
    public function startSession() {
        session_start();
    }

    // Fungsi untuk menyimpan data ke session
    public function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Fungsi untuk mengambil data dari session
    public function getSession($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Fungsi untuk menghancurkan session
    public function destroySession() {
        session_unset();
        session_destroy();
    }

    // Fungsi untuk menyimpan cookie
    public function setCookie($name, $value, $expire) {
        setcookie($name, $value, $expire, "/");
    }

    // Fungsi untuk mengambil data dari cookie
    public function getCookie($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    // Fungsi untuk menghapus cookie
    public function deleteCookie($name) {
        setcookie($name, "", time() - 3600, "/");
    }
}
?>
