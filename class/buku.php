<?php

class buku
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new buku($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan buku dimulaiiiii 
    public function add($judul, $pengarang, $penerbit)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO buku (judul, pengarang, penerbit) VALUES (:judul, :pengarang, :penerbit)");
            $stmt->bindParam(":judul", $judul);
            $stmt->bindParam(":pengarang", $pengarang);
            $stmt->bindParam(":penerbit", $penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_buku)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
            $stmt->execute(array(":id_buku" => $id_buku));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah buku doneee

    // function for mengedit buku dimulaiiiii 
    public function edit($id_buku, $judul, $pengarang, $penerbit)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pegawai SET nama = :nama, nisn = :nisn, alamat = :alamat, WHERE id_pegawai = :id_pegawai");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->bindParam(":judul", $judul);
            $stmt->bindParam(":pengarang", $pengarang);
            $stmt->bindParam(":penerbit", $penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for mengedit buku doneee

    // function for menghapus buku dimulaiiiii 
    public function hapus($id_buku)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus buku doneee

    // function for mendapatkan semua buku dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua buku doneee
}
?>