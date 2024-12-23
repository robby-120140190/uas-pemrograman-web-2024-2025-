<?php
// Koneksi ke database menggunakan OOP
class Koneksi {
    private $host = "localhost"; // Host database
    private $user = "root"; // Username database
    private $password = ""; // Password database
    private $dbname = "servis_log"; // Nama database

    private $conn;

    // Fungsi untuk membuka koneksi
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
