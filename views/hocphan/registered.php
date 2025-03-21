<?php include __DIR__ . "/../header.php"; ?>

<h2>Đăng Kí Học Phần</h2>
<p>Số học phần: <?php echo $soHP; ?> <br>
Tổng số tín: <?php echo $tongTin; ?></p>

<?php if ($soHP > 0): ?>
<table border="1" cellpadding="10">
    <tr>
        <th>MaDK</th>
        <th>MaHP</th>
        <th>Tên Học Phần</th>
        <th>Số Tín Chỉ</th>
        <th>Ngày ĐK</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($data as $row): ?>
    <tr>
        <td><?php echo $row['MaDK']; ?></td>
        <td><?php echo $row['MaHP']; ?></td>
        <td><?php echo $row['TenHP']; ?></td>
        <td><?php echo $row['SoTinChi']; ?></td>
        <td><?php echo $row['NgayDK']; ?></td>
        <td>
            <a href="/Kiemtra/index.php?controller=hocphan&action=removeOne&MaDK=<?php echo $row['MaDK']; ?>&MaHP=<?php echo $row['MaHP']; ?>"
               onclick="return confirm('Xóa học phần này?');">
               Xóa
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Nút Lưu đăng ký -->
<p>
    <a href="/Kiemtra/index.php?controller=hocphan&action=saveRegistration"
       style="color:green; font-weight:bold;"
       onclick="return confirm('Bạn có chắc muốn lưu đăng ký?');">
       Lưu đăng ký
    </a>
</p>

<p>
    <a href="/Kiemtra/index.php?controller=hocphan&action=removeAll"
       style="color:red; font-weight:bold;"
       onclick="return confirm('Bạn có chắc xóa tất cả?');">
       Xóa tất cả
    </a>
</p>
<?php else: ?>
<p>Chưa đăng ký học phần nào.</p>
<?php endif; ?>

<p><a href="/Kiemtra/index.php?controller=hocphan&action=index">[ Back to Học Phần ]</a></p>
<?php include __DIR__ . "/../footer.php"; ?>
