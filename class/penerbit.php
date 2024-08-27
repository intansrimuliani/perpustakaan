<?php
class penerbit
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
            self::$instance = new penerbit($pdo);
        }
        return self::$instance;
    }

    // Add penerbit
    public function tambah($nama_penerbit, $alamat_penerbit)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO penerbit (nama_penerbit, alamat_penerbit) VALUES (:nama_penerbit, :alamat_penerbit)");
            $stmt->bindParam(":nama_penerbit", $nama_penerbit);
            $stmt->bindParam(":alamat_penerbit", $alamat_penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get penerbit by ID
    public function getById($id_penerbit)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penerbit WHERE id_penerbit = :id_penerbit");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Update penerbit
    public function update($id_penerbit, $nama_penerbit, $alamat_penerbit, $jumlah_penerbit, $tanggal_penerbit)
    {
        try {
            $stmt = $this->db->prepare("UPDATE penerbit SET nama_penerbit = :nama_penerbit, alamat_penerbit = :alamat_penerbit, WHERE id_penerbit = :id_penerbit");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->bindParam(":nama_penerbit", $nama_penerbit);
            $stmt->bindParam(":alamat_penerbit", $alamat_penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Hapus penerbit
    public function hapus($id_penerbit)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM penerbit WHERE id_penerbit = :id_penerbit");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get all penerbit
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penerbit");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
