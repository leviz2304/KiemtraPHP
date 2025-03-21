<?php


include_once __DIR__ . "/../config/config.php";
include_once __DIR__ . "/../models/HocPhan.php";

class HocPhanController {
    private $conn;
    private $hocPhan;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->hocPhan = new HocPhan($conn);
    }

    // Hiển thị danh sách học phần
    public function index() {
        session_start();
        $result = $this->hocPhan->readAll();
        include __DIR__ . "/../views/hocphan/index.php";
    }

    // Đăng ký học phần
    public function dangKy() {
        session_start(); 

        if (!isset($_SESSION['MaSV'])) {
            header("Location: /Kiemtra/index.php?controller=auth&action=showLogin");
            exit();
        }

        if (!isset($_GET['MaHP'])) {
            die("MaHP not provided.");
        }
        $MaHP = $_GET['MaHP'];

        $maSV = $_SESSION['MaSV'];

        $ngayDK = date("Y-m-d");
        $sql1 = "INSERT INTO DangKy(NgayDK, MaSV) VALUES (?, ?)";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->bind_param("ss", $ngayDK, $maSV);
        $stmt1->execute();
        $maDK = $this->conn->insert_id;

        $sql2 = "INSERT INTO ChiTietDangKy(MaDK, MaHP) VALUES (?, ?)";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("is", $maDK, $MaHP);
        $stmt2->execute();

        header("Location: /Kiemtra/index.php?controller=hocphan&action=index");
        exit();
    }
    public function showRegistered() {
        session_start();
        if (!isset($_SESSION['MaSV'])) {
            header("Location: /Kiemtra/index.php?controller=auth&action=showLogin");
            exit();
        }
        $maSV = $_SESSION['MaSV'];
        $sql = "
            SELECT dk.MaDK, dk.NgayDK, ctdk.MaHP, hp.TenHP, hp.SoTinChi
            FROM DangKy dk
            JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK
            JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
            WHERE dk.MaSV = ?
            ORDER BY dk.MaDK DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maSV);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        $soHP = 0;
        $tongTin = 0;
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            $soHP++;
            $tongTin += $row['SoTinChi'];
        }

        include __DIR__ . "/../views/hocphan/registered.php";
    }
    public function removeOne() {
        session_start();
        if (!isset($_SESSION['MaSV'])) {
            header("Location: /Kiemtra/index.php?controller=auth&action=showLogin");
            exit();
        }
        if (!isset($_GET['MaDK']) || !isset($_GET['MaHP'])) {
            die("Missing MaDK or MaHP");
        }
        $maDK = $_GET['MaDK'];
        $maHP = $_GET['MaHP'];

        $sql = "DELETE FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $maDK, $maHP);
        $stmt->execute();

        $sql2 = "SELECT COUNT(*) as cnt FROM ChiTietDangKy WHERE MaDK = ?";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bind_param("i", $maDK);
        $stmt2->execute();
        $r2 = $stmt2->get_result()->fetch_assoc();
        if ($r2['cnt'] == 0) {
            $sql3 = "DELETE FROM DangKy WHERE MaDK = ?";
            $stmt3 = $this->conn->prepare($sql3);
            $stmt3->bind_param("i", $maDK);
            $stmt3->execute();
        }

        header("Location: /Kiemtra/index.php?controller=hocphan&action=showRegistered");
        exit();
    }

    public function removeAll() {
        session_start();
        if (!isset($_SESSION['MaSV'])) {
            header("Location: /Kiemtra/index.php?controller=auth&action=showLogin");
            exit();
        }
        $maSV = $_SESSION['MaSV'];
        $sql1 = "SELECT MaDK FROM DangKy WHERE MaSV = ?";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->bind_param("s", $maSV);
        $stmt1->execute();
        $res1 = $stmt1->get_result();
        while ($row1 = $res1->fetch_assoc()) {
            $maDK = $row1['MaDK'];
            $sql2 = "DELETE FROM ChiTietDangKy WHERE MaDK = ?";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bind_param("i", $maDK);
            $stmt2->execute();
        }
        $sql3 = "DELETE FROM DangKy WHERE MaSV = ?";
        $stmt3 = $this->conn->prepare($sql3);
        $stmt3->bind_param("s", $maSV);
        $stmt3->execute();

        header("Location: /Kiemtra/index.php?controller=hocphan&action=showRegistered");
        exit();
    }
    public function saveRegistration() {
        session_start();
        if (!isset($_SESSION['MaSV'])) {
            header("Location: /Kiemtra/index.php?controller=auth&action=showLogin");
            exit();
        }
        $maSV = $_SESSION['MaSV'];
    
    
        $sql = "UPDATE DangKy SET status='saved' WHERE MaSV=? AND (status IS NULL OR status='')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maSV);
        $stmt->execute();
    
        include __DIR__ . "/../views/hocphan/save_success.php";
    }
}
