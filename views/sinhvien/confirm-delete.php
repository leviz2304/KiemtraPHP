<?php include __DIR__ . "/../header.php"; ?>

<h2>XÓA THÔNG TIN</h2>
<p>Are you sure you want to delete this?</p>

<!-- Hiển thị thông tin sinh viên -->
<table border="1" cellpadding="10">
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
                <img src="<?php echo $record['Hinh']; ?>" alt="Hình Sinh Viên" width="100">
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
<!-- Nút xác nhận và hủy -->
<a href="/Kiemtra/index.php?controller=sinhvien&action=delete&MaSV=<?php echo $record['MaSV']; ?>" 
   style="color:red; font-weight:bold;"
   onclick="return confirm('Bạn chắc chắn muốn xóa?');">
   Xác nhận xóa
</a> 
| 
<a href="/Kiemtra/index.php?controller=sinhvien&action=index">Hủy</a>

<?php include __DIR__ . "/../footer.php"; ?>
