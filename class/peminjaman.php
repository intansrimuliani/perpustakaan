<?php
class peminjaman
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
            self::$instance = new peminjaman($pdo);
        }
        return self::$instance;
    }

    // Add peminjaman
    public function tambah($nama_anggota, $nama_buku, $jumlah_peminjaman, $tanggal_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO peminjaman (nama_anggota, nama_buku, jumlah_peminjaman, tanggal_peminjaman) VALUES (:nama_anggota, :nama_buku, :jumlah_peminjaman, :tanggal_peminjaman)");
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":nama_buku", $nama_buku);
            $stmt->bindParam(":jumlah_peminjaman", $jumlah_peminjaman);
            $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get peminjaman by ID
    public function getById($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Update peminjaman
    public function update($id_peminjaman, $nama_anggota, $nama_buku, $jumlah_peminjaman, $tanggal_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("UPDATE peminjaman SET nama_anggota = :nama_anggota, nama_buku = :nama_buku, jumlah_peminjaman = :jumlah_peminjaman, tanggal_peminjaman = :tanggal_peminjaman WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":nama_buku", $nama_buku);
            $stmt->bindParam(":jumlah_peminjaman", $jumlah_peminjaman);
            $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Hapus peminjaman
    public function hapus($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Get all peminjaman
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
