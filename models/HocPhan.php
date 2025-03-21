<?php
class HocPhan {
    private $conn;
    private $table = "HocPhan";

    public $MaHP;
    public $TenHP;
    public $SoTinChi;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả học phần
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY MaHP ASC";
        $result = $this->conn->query($query);
        return $result;
    }

    // Lấy 1 học phần theo MaHP
    public function readOne($MaHP) {
        $query = "SELECT * FROM " . $this->table . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaHP);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // 1 row hoặc null
    }

    // Tạo học phần (nếu cần)
    public function create() {
        $query = "INSERT INTO " . $this->table . " (MaHP, TenHP, SoTinChi) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->MaHP, $this->TenHP, $this->SoTinChi);
        return $stmt->execute();
    }

    // Sửa học phần (nếu cần)
    public function update() {
        $query = "UPDATE " . $this->table . " SET TenHP = ?, SoTinChi = ? WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sis", $this->TenHP, $this->SoTinChi, $this->MaHP);
        return $stmt->execute();
    }

    // Xóa học phần (nếu cần)
    public function delete($MaHP) {
        $query = "DELETE FROM " . $this->table . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $MaHP);
        return $stmt->execute();
    }
}
