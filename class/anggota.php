<?php

class Anggota
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
            self::$instance = new Anggota($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan anggota dimulaiiiii 
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
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->execute(array(":id_anggota" => $id_anggota));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah anggota doneee

    // function for mengedit anggota dimulaiiiii 
    public function edit($id_anggota, $nama_anggota, $alamat_anggota, $no_telepon)
    {
        try {
            $stmt = $this->db->prepare("UPDATE anggota SET nama_anggota = :nama_anggota, alamat_anggota   WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":alamat_anggota", $alamat_anggota);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for mengedit anggota doneee

    // function for menghapus anggota dimulaiiiii 
    public function hapus($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus anggota doneee

    // function for mendapatkan semua anggota dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua anggota doneee
}