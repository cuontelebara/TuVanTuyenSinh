<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center text-primary mb-4">ĐĂNG NHẬP</h3>
    
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=auth&action=login">
        <div class="mb-3">
            <label class="form-label">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
    </form>
    <div class="text-center mt-3">
        <a href="index.php?page=auth&action=register">Chưa có tài khoản? Đăng ký ngay</a>
    </div>
    <div class="text-center mt-2">
        <a href="index.php" class="text-secondary small">← Về trang chủ</a>
    </div>
</div>

</body>
</html>