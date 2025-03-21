<?php


include_once __DIR__ . "/../config/config.php";
include_once __DIR__ . "/../models/SinhVien.php";

class SinhVienController {
    private $conn;
    private $sinhVien;

    public function __construct() {
        global $conn;  
        $this->conn = $conn;
        $this->sinhVien = new SinhVien($conn);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $result = $this->sinhVien->readAll();
        include __DIR__ . "/../views/sinhvien/index.php";
    }

    // Thêm sinh viên mới
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Populate properties from POST
            $this->sinhVien->MaSV = $_POST['MaSV'];
            $this->sinhVien->HoTen = $_POST['HoTen'];
            $this->sinhVien->GioiTinh = $_POST['GioiTinh'];
            $this->sinhVien->NgaySinh = $_POST['NgaySinh'];
            $this->sinhVien->MaNganh = $_POST['MaNganh'];
            
            // Process the file upload for the image
            if (isset($_FILES['Hinh_new']) && $_FILES['Hinh_new']['error'] === 0) {
                $newImageName = time() . "_" . basename($_FILES['Hinh_new']['name']);
                // Ensure the "images" folder exists and is writable
                if (move_uploaded_file($_FILES['Hinh_new']['tmp_name'], "images/" . $newImageName)) {
                    $this->sinhVien->Hinh = "images/" . $newImageName;
                } else {
                    $error = "Error uploading the image.";
                    include __DIR__ . "/../views/sinhvien/add.php";
                    return;
                }
            } else {
                // No image uploaded; set default or empty
                $this->sinhVien->Hinh = "";
            }
            
            if ($this->sinhVien->create()) {
                header("Location: " . dirname($_SERVER['PHP_SELF']) . "/index.php?action=index");
                exit();
            } else {
                $error = "Error adding record.";
            }
        }
        include __DIR__ . "/../views/sinhvien/add.php";
    }
    

    // Sửa thông tin sinh viên
    public function edit() {
        if (!isset($_GET['MaSV'])) {
            die("MaSV not provided.");
        }
        $MaSV = $_GET['MaSV'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->sinhVien->MaSV = $MaSV;
            $this->sinhVien->HoTen = $_POST['HoTen'];
            $this->sinhVien->GioiTinh = $_POST['GioiTinh'];
            $this->sinhVien->NgaySinh = $_POST['NgaySinh'];
            $this->sinhVien->MaNganh = $_POST['MaNganh'];
            
            // Check if a new image was uploaded
            if (isset($_FILES['Hinh_new']) && $_FILES['Hinh_new']['error'] === 0) {
                $newImageName = time() . "_" . basename($_FILES['Hinh_new']['name']);
                // Make sure the folder "images" exists and is writable
                if (move_uploaded_file($_FILES['Hinh_new']['tmp_name'], "images/" . $newImageName)) {
                    $this->sinhVien->Hinh = "images/" . $newImageName;
                } else {
                    $error = "Error uploading the new image.";
                    $record = $this->sinhVien->readOne($MaSV);
                    include __DIR__ . "/../views/sinhvien/edit.php";
                    return;
                }
            } else {
                // No new file uploaded, so use the existing image
                $record = $this->sinhVien->readOne($MaSV);
                $this->sinhVien->Hinh = $record['Hinh'];
            }
        
            if ($this->sinhVien->update()) {
                header("Location: /Kiemtra/index.php?action=index");
                exit();
            } else {
                $error = "Error updating record.";
            }
        }
        
        $record = $this->sinhVien->readOne($MaSV);
        if (!$record) {
            $error = "Không tìm thấy sinh viên với MaSV = $MaSV.";
            include __DIR__ . "/../views/sinhvien/index.php";
            return;
        }
        
        include __DIR__ . "/../views/sinhvien/edit.php";
    }
    
    

    public function confirmDelete() {
        if (!isset($_GET['MaSV'])) {
            die("MaSV not provided.");
        }
        $MaSV = $_GET['MaSV'];
    
        // Lấy thông tin để hiển thị
        $record = $this->sinhVien->readOne($MaSV);
        if (!$record) {
            $error = "Không tìm thấy sinh viên với MaSV = $MaSV.";
            include __DIR__ . "/../views/sinhvien/index.php";
            return;
        }
    
        // Hiển thị trang confirm
        include __DIR__ . "/../views/sinhvien/confirm-delete.php";
    }
    
    public function delete() {
        if (!isset($_GET['MaSV'])) {
            die("MaSV not provided.");
        }
        $MaSV = $_GET['MaSV'];
    
        // Thực hiện xóa
        if ($this->sinhVien->delete($MaSV)) {
            header("Location: " . dirname($_SERVER['PHP_SELF']) . "/index.php?action=index");
            exit();
        } else {
            die("Error deleting record.");
        }
    }
    public function detail() {
        if (!isset($_GET['MaSV'])) {
            die("MaSV not provided.");
        }
        $MaSV = $_GET['MaSV'];
    
        // Lấy thông tin sinh viên
        $record = $this->sinhVien->readOne($MaSV);
        if (!$record) {
            $error = "Không tìm thấy sinh viên với MaSV = $MaSV.";
            include __DIR__ . "/../views/sinhvien/index.php";
            return;
        }
    
        // Hiển thị trang chi tiết
        include __DIR__ . "/../views/sinhvien/detail.php";
    }
}
?>
