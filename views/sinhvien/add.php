<?php include __DIR__ . "/../header.php"; ?>

<h2>Thêm Sinh Viên</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="/Kiemtra/index.php?controller=sinhvien&action=add" method="POST" enctype="multipart/form-data">
    MaSV: <input type="text" name="MaSV" required><br>
    HoTen: <input type="text" name="HoTen" required><br>
    GioiTinh: 
      <select name="GioiTinh">
          <option value="Nam">Nam</option>
          <option value="Nu">Nữ</option>
      </select><br>
    NgaySinh: <input type="date" name="NgaySinh" required><br>
    
    Chọn ảnh (nếu có): <input type="file" name="Hinh_new"><br>
    
    MaNganh: <input type="text" name="MaNganh" required><br>
    <input type="submit" value="Thêm">
</form>

<?php include __DIR__ . "/../footer.php"; ?>
