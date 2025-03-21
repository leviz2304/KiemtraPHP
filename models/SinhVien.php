<?php
// models/SinhVien.php

class SinhVien {
    private $conn;
    private $table = "SinhVien";

    public $MaSV;
    public $HoTen;
    public $GioiTinh;
    public $NgaySinh;
    public $Hinh;
    public $MaNganh;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY MaSV ASC";
        $result = $this->conn->query($query);
        return $result;
    }
    public function readOne($MaSV) {
        $query = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về 1 dòng hoặc null
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ssssss", $this->MaSV, $this->HoTen, $this->GioiTinh, $this->NgaySinh, $this->Hinh, $this->MaNganh);
        return $stmt->execute();
    }
    public function update() {
        $query = "UPDATE " . $this->table . " SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssss", $this->HoTen, $this->GioiTinh, $this->NgaySinh, $this->Hinh, $this->MaNganh, $this->MaSV);
        return $stmt->execute();
    }
    public function delete($MaSV) {
        $query = "DELETE FROM " . $this->table . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaSV);
        return $stmt->execute();
    }
}
?>
