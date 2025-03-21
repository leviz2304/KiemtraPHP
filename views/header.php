<!-- views/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sinh Viên CRUD</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <header>
        <h1>Quản lý Sinh Viên</h1>
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        ?>
        <nav>
            <a href="/Kiemtra/index.php?controller=sinhvien&action=index">Trang chủ</a> |
            <a href="/Kiemtra/index.php?controller=sinhvien&action=add">Thêm Sinh Viên</a> |
            <a href="/Kiemtra/index.php?controller=hocphan&action=index">Đăng ký Học Phần</a>
            <a href="/Kiemtra/index.php?controller=hocphan&action=showRegistered">DS Đã Đăng Ký</a>

            <?php if (isset($_SESSION['MaSV'])): ?>
                | Xin chào, <?php echo $_SESSION['HoTen']; ?> |
                <a href="/Kiemtra/index.php?controller=auth&action=logout">Đăng Xuất</a>
            <?php else: ?>
                | <a href="/Kiemtra/index.php?controller=auth&action=showLogin">Đăng Nhập</a>
            <?php endif; ?>
        </nav>
        <hr>
    </header>
