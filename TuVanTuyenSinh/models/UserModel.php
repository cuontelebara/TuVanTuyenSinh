<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Đăng ký (Giữ nguyên vì đã chuẩn)
    public function register($fullname, $username, $password) {
        // Kiểm tra trùng tên
        $checkSql = "SELECT id FROM users WHERE username = ?";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        
        if ($checkStmt->get_result()->num_rows > 0) {
            return false;
        }

        // Thêm mới
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'student';

        $sql = "INSERT INTO users (fullname, username, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $username, $hashed_password, $role);
        return $stmt->execute();
    }

    // 2. Đăng nhập (Có chế độ Debug)
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // --- ĐOẠN DEBUG (Xóa đi sau khi sửa xong lỗi) ---
            // echo "<div style='background: yellow; padding: 10px; border: 2px solid red;'>";
            // echo "<h3>🔍 Đang kiểm tra mật khẩu:</h3>";
            // echo "User nhập: <b>" . htmlspecialchars($password) . "</b><br>";
            // echo "Hash trong DB: <b>" . htmlspecialchars($user['password']) . "</b><br>";
            // echo "Độ dài Hash trong DB: <b>" . strlen($user['password']) . "</b> (Chuẩn phải là 60 ký tự)<br>";
            
            // if (password_verify($password, $user['password'])) {
            //     echo "<h3 style='color:green'>✅ Kết quả: Khớp!</h3>";
            // } else {
            //     echo "<h3 style='color:red'>❌ Kết quả: Không khớp!</h3>";
            //     echo "<i>Gợi ý: Nếu độ dài hash < 60, hãy vào DB sửa cột password thành VARCHAR(255) và reset lại pass.</i>";
            // }
            // echo "</div>";
            // die(); // Dừng trang web lại để xem thông báo
            // -----------------------------------------------

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return false;
    }
}
?>