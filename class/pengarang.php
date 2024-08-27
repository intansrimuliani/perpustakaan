<?php
class pengarang
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
            self::$instance = new pengarang($pdo);
        }
        return self::$instance;
    }

    // Add pengarang
    public function tambah($nama_pengarang, $alamat_pengarang)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pengarang (nama_pengarang, alamat_pengarang) VALUES (:nama_pengarang, :alamat_pengarang)");
            $stmt->bindParam(":nama_pengarang", $nama_pengarang);
            $stmt->bindParam(":alamat_pengarang", $alamat_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get pengarang by ID
    public function getById($id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengarang WHERE id_pengarang = :id_pengarang");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Update pengarang
    public function update($id_pengarang, $nama_pengarang, $alamat_pengarang, $jumlah_pengarang, $tanggal_pengarang)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pengarang SET nama_pengarang = :nama_pengarang, alamat_pengarang = :alamat_pengarang, WHERE id_pengarang = :id_pengarang");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->bindParam(":nama_pengarang", $nama_pengarang);
            $stmt->bindParam(":alamat_pengarang", $alamat_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Hapus pengarang
    public function hapus($id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pengarang WHERE id_pengarang = :id_pengarang");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get all pengarang
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengarang");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
