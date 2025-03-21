<?php include __DIR__ . "/../header.php"; ?>

<h2>Thông tin chi tiết</h2>
<h3>SinhVien</h3>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<table border="0" cellpadding="5">
    <tr>
        <td>Họ Tên:</td>
        <td><?php echo $record['HoTen']; ?></td>
    </tr>
    <tr>
        <td>Giới Tính:</td>
        <td><?php echo $record['GioiTinh']; ?></td>
    </tr>
    <tr>
        <td>Ngày Sinh:</td>
        <td><?php echo $record['NgaySinh']; ?></td>
    </tr>
    <tr>
        <td>Hình:</td>
        <td>
            <?php if (!empty($record['Hinh'])): ?>
                <img src="<?php echo $record['Hinh']; ?>" alt="Hình Sinh Viên" width="150">
            <?php else: ?>
                Không có hình
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>MaNganh:</td>
        <td><?php echo $record['MaNganh']; ?></td>
    </tr>
</table>

<br>
<a href="/Kiemtra/index.php?controller=sinhvien&action=edit&MaSV=<?php echo $record['MaSV']; ?>">Edit</a> |
<a href="/Kiemtra/index.php?controller=sinhvien&action=index">Back to List</a>

<?php include __DIR__ . "/../footer.php"; ?>
