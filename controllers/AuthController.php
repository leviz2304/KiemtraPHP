<?php

include_once __DIR__ . "/../config/config.php";

class AuthController {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function showLogin() {
        include __DIR__ . "/../views/login.php";
    }

    // Xử lý đăng nhập
    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSV = trim($_POST['MaSV']);

            $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $maSV);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $_SESSION['MaSV'] = $row['MaSV'];
                $_SESSION['HoTen'] = $row['HoTen'];
                header("Location: /Kiemtra/index.php?action=index");
                exit();
            } else {
                $error = "MaSV không tồn tại.";
                include __DIR__ . "/../views/login.php";
            }
        } else {
            $this->showLogin();
        }
    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /Kiemtra/index.php?action=index");
        exit();
    }
  
}
