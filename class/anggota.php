<?php
class Anggota
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
            self::$instance = new Anggota($pdo);
        }
        return self::$instance;
    }

    // Add Anggota
    public function tambah($nama_anggota, $alamat_anggota, $no_telepon)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO anggota (nama_anggota, alamat_anggota, no_telepon) VALUES (:nama_anggota, :alamat_anggota, :no_telepon)");
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":alamat_anggota", $alamat_anggota);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get Anggota by ID
    public function getById($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Update Anggota
    public function update($id_anggota, $nama_anggota, $alamat_anggota, $no_telepon)
    {
        try {
            $stmt = $this->db->prepare("UPDATE anggota SET nama_anggota = :nama_anggota, alamat_anggota = :alamat_anggota, no_telepon = :no_telepon WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":alamat_anggota", $alamat_anggota);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Delete Anggota
    public function delete($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get All Anggota
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
