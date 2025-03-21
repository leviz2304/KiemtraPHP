<?php include __DIR__ . "/../header.php"; ?>

<h2>DANH SÁCH HỌC PHẦN</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>MaHP</th>
        <th>TenHP</th>
        <th>SoTinChi</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['MaHP']; ?></td>
        <td><?php echo $row['TenHP']; ?></td>
        <td><?php echo $row['SoTinChi']; ?></td>
        <td>
            <a href="/Kiemtra/index.php?controller=hocphan&action=dangKy&MaHP=<?php echo $row['MaHP']; ?>"
               onclick="return confirm('Xác nhận đăng ký?');">
               Đăng Ký
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include __DIR__ . "/../footer.php"; ?>
