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

    // FUNCTION TAMBAH PEGAWAI START
    public function add( $nama_pegawai, $alamat_pegawai)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pegawai (id_pegawai, nama_pegawai, alamat_pegawai) VALUES (:id_pegawai, :nama_pegawai,  :alamat_pegawai)");
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
    // FUNCTION TAMBAH PEGAWAI END

    // FUNCTION EDIT PEGAWAI START
    public function update($id_pegawai, $nama_pegawai,  $alamat_pegawai)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pegawai SET id_pegawai = :id_pegawai, nama_pegawai = :nama_pegawai,  alamat_pegawai = :alamat_pegawai WHERE id_pegawai = :id_pegawai");
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
    // FUNCTION EDIT PEGAWAI END

    // FUNCTION DELETE PEGAWAI START
    public function delete($id_pegawai)
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
    // FUNCTION DELETE PEGAWAI END

    // FUNCTION GET ALL PEGAWAI START
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
        }
    }
    // FUNCTION GET ALL PEGAWAI END
}
?>