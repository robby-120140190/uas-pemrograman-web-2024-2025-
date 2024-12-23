<?php
include_once 'Koneksi.php';

class ServisController {
    private $conn;
    private $table = 'servis_table';

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct() {
        $this->conn = (new Koneksi())->getConnection();
    }

    // Fungsi untuk membuat servis baru (Create)
    public function create($servis, $kendaraan, $tanggal) {
        $sql = "INSERT INTO " . $this->table . " (servis, kendaraan, tanggal) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$servis, $kendaraan, $tanggal]);
    }

    // Fungsi untuk mengambil semua data servis (Read)
    public function read() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil satu data servis berdasarkan ID (Read - by ID)
    public function readById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengupdate data servis (Update)
    public function update($id, $servis, $kendaraan, $tanggal) {
        $sql = "UPDATE " . $this->table . " SET servis = ?, kendaraan = ?, tanggal = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$servis, $kendaraan, $tanggal, $id]);
    }

    // Fungsi untuk menghapus data servis (Delete)
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
