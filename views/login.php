<?php include __DIR__ . "/header.php"; ?>

<h2>ĐĂNG NHẬP</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="/Kiemtra/index.php?controller=auth&action=login" method="POST">
    MaSV: <input type="text" name="MaSV" required><br><br>
    <input type="submit" value="Đăng Nhập">
</form>

<p><a href="/Kiemtra/index.php?action=index">Back to List</a></p>

<?php include __DIR__ . "/footer.php"; ?>
