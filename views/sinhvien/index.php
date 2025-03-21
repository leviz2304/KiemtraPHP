<?php include __DIR__ . "/../header.php"; ?>

<h2>Danh Sách Sinh Viên</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>MaSV</th>
        <th>HoTen</th>
        <th>GioiTinh</th>
        <th>NgaySinh</th>
        <th>Hinh</th>
        <th>MaNganh</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['MaSV']; ?></td>
        <td><?php echo $row['HoTen']; ?></td>
        <td><?php echo $row['GioiTinh']; ?></td>
        <td><?php echo $row['NgaySinh']; ?></td>
        <td>
    <img src="<?php echo $row['Hinh']; ?>" alt="Hình Sinh Viên" width="100">
</td>
        <td><?php echo $row['MaNganh']; ?></td>
        <td>
        <td>
    <a href="/Kiemtra/index.php?controller=sinhvien&action=edit&MaSV=<?php echo $row['MaSV']; ?>">Sửa</a>
    <a href="/Kiemtra/index.php?controller=sinhvien&action=confirmDelete&MaSV=<?php echo $row['MaSV']; ?>">Xóa</a>
    <a href="/Kiemtra/index.php?controller=sinhvien&action=detail&MaSV=<?php echo $row['MaSV']; ?>">Xem chi tiết</a>
    </td>


        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include __DIR__ . "/../footer.php"; ?>
