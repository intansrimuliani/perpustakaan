<?php

class pegawai
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
            self::$instance = new pegawai($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan pegawai dimulaiiiii 
    public function tambah($nama_pegawai, $alamat_pegawai)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pegawai (nama_pegawai,alamat_pegawai) VALUES (:nama_pegawai, :alamat_pegawai)");
            $stmt->bindParam(":nama_pegawai", $nama_pegawai);
            $stmt->bindParam(":alamat_pegawai", $alamat_pegawai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_pegawai)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pegawai WHERE id_pegawai = :id_pegawai");
            $stmt->execute(array(":id_pegawai" => $id_pegawai));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah pegawai doneee

    // function for mengedit pegawai dimulaiiiii 
    public function edit($id_pegawai, $nama_pegawai, $alamat_pegawai,)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pegawai SET nama_pegawai = :nama_pegawai, alamat_pegawai = :alamat_pegawai WHERE id_pegawai = :id_pegawai");
            $stmt->bindParam(":id_pegawai", $id_pegawai);
            $stmt->bindParam(":nama_pegawai", $nama_pegawai);
            $stmt->bindParam(":alamat_pegawai", $alamat_pegawai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for mengedit pegawai doneee

    // function for menghapus pegawai dimulaiiiii 
    public function hapus($id_pegawai)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pegawai WHERE id_pegawai = :id_pegawai");
            $stmt->bindParam(":id_pegawai", $id_pegawai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus pegawai doneee

    // function for mendapatkan semua pegawai dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pegawai");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
            //config berhasil
        }
    }
    // function for menampilkan semua pegawai doneee
}
?>