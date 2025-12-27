<?php
// config/db.php

// 1. Cấu hình thông số kết nối
$servername = "127.0.0.1"; // Dùng IP này thay cho 'localhost' để tránh lỗi trên Windows
$username = "root";        // Tên đăng nhập mặc định của XAMPP
$password = "";            // Mật khẩu mặc định là rỗng
$dbname = "tuvan_db";      // Tên database bạn đã tạo

// QUAN TRỌNG: Hãy thử số 3306 trước (Cổng mặc định)
// Nếu vẫn lỗi thì mới đổi thành số khác bạn thấy ở cột "Port(s)" trong XAMPP
$port = 2511; 

try {
    // 2. Tạo kết nối có truyền tham số PORT (số 3306)
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // 3. Thiết lập font chữ tiếng Việt
    mysqli_set_charset($conn, 'UTF8');

} catch (mysqli_sql_exception $e) {
    // Nếu lỗi thì hiện thông báo rõ ràng
    die("❌ Lỗi kết nối Database: " . $e->getMessage() . 
        "<br>👉 Hãy kiểm tra lại XAMPP xem MySQL đã bật chưa và Port có đúng là $port không?");
}
?>