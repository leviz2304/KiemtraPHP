<?php include __DIR__ . "/../header.php"; ?>

<h2>Sửa Sinh Viên</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="/Kiemtra/index.php?controller=sinhvien&action=edit&MaSV=<?php echo $record['MaSV']; ?>" method="POST" enctype="multipart/form-data">
    HoTen: <input type="text" name="HoTen" value="<?php echo $record['HoTen']; ?>" required><br>
    GioiTinh: 
      <select name="GioiTinh">
          <option value="Nam" <?php if($record['GioiTinh'] == "Nam") echo "selected"; ?>>Nam</option>
          <option value="Nu" <?php if($record['GioiTinh'] == "Nữ" || $record['GioiTinh'] == "Nu") echo "selected"; ?>>Nữ</option>
      </select><br>
    NgaySinh: <input type="date" name="NgaySinh" value="<?php echo $record['NgaySinh']; ?>" required><br>
    
    Hình hiện tại:<br>
    <?php if(!empty($record['Hinh'])): ?>
      <img src="<?php echo $record['Hinh']; ?>" alt="Hình Sinh Viên" width="100"><br>
    <?php else: ?>
      <p>Không có hình</p>
    <?php endif; ?>
    <br>
    Chọn ảnh mới (nếu muốn cập nhật): <input type="file" name="Hinh_new"><br>
    
    MaNganh: <input type="text" name="MaNganh" value="<?php echo $record['MaNganh']; ?>" required><br>
    <input type="submit" value="Cập nhật">
</form>

<?php include __DIR__ . "/../footer.php"; ?>
