<?php
class pengembalian
{
    private $db;
    private static $instance = null;

    private function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    // Singleton pattern
    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new pengembalian($pdo);
        }
        return self::$instance;
    }

    // Add pengembalian
    public function tambah($nama_anggota, $tanggal_kembali)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pengembalian (nama_anggota, tanggal_kembali) VALUES (:nama_anggota, :tanggal_kembali)");
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":tanggal_kembali", $tanggal_kembali);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get pengembalian by ID
    public function getById($id_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengembalian WHERE id_pengembalian = :id_pengembalian");
            $stmt->bindParam(":id_pengembalian", $id_pengembalian);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Update pengembalian
    public function update($id_pengembalian, $nama_anggota, $tanggal_kembali)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pengembalian SET nama_pengembalian = :nama_pengembalian, tanggal_kembali = :tanggal_kembali, WHERE id_pengembalian = :id_pengembalian");
            $stmt->bindParam(":id_pengembalian", $id_pengembalian);
            $stmt->bindParam(":nama_anggota", $nama_pengembalian);
            $stmt->bindParam(":tanggal_kembali", $tanggal_kembali);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Hapus pengembalian
    public function hapus($id_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pengembalian WHERE id_pengembalian = :id_pengembalian");
            $stmt->bindParam(":id_pengembalian", $id_pengembalian);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get all pengembalian
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengembalian");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
