<?php
// controllers/AuthController.php

// Nhúng model
require_once 'models/UserModel.php';

class AuthController {
    private $model;

    public function __construct($conn) {
        // Khởi tạo model với kết nối CSDL
        $this->model = new UserModel($conn);
    }

    // 1. Xử lý Đăng nhập
    public function login() {
        // [TỐI ƯU] Nếu đã đăng nhập rồi thì tự chuyển hướng luôn, không hiện form nữa
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] == 'admin') {
                header("Location: index.php?page=admin");
            } else {
                header("Location: index.php");
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->login($username, $password);
            
            if ($user) {
                // Đăng nhập thành công -> Lưu session
                $_SESSION['user'] = $user;
                
                // 🔥 [SỬA ĐOẠN NÀY] PHÂN QUYỀN CHUYỂN HƯỚNG 🔥
                if ($user['role'] == 'admin') {
                    // Nếu là Admin -> Vào trang quản trị
                    header("Location: index.php?page=admin");
                } else {
                    // Nếu là Học sinh (student) -> Vào trang tư vấn
                    header("Location: index.php");
                }
                exit; // Dừng code ngay sau khi chuyển hướng
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
                require 'views/auth/login.php';
            }
        } else {
            // Nếu vào lần đầu (GET) -> Hiện form đăng nhập
            require 'views/auth/login.php';
        }
    }

    // 2. Xử lý Đăng ký
    public function register() {
        // Nếu đã đăng nhập rồi thì không cho đăng ký nữa
        if (isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Gọi hàm đăng ký trong Model
            if ($this->model->register($fullname, $username, $password)) {
                // Đăng ký xong -> Chuyển qua trang Login để đăng nhập
                header("Location: index.php?page=login"); 
                exit;
            } else {
                $error = "Đăng ký thất bại (Tên đăng nhập đã tồn tại)!";
                require 'views/auth/register.php';
            }
        } else {
            require 'views/auth/register.php';
        }
    }

    // 3. Xử lý Đăng xuất
    public function logout() {
        // Xóa toàn bộ session
        session_destroy();
        
        // Đăng xuất xong -> Quay về trang Login
        header("Location: index.php?page=login");
        exit;
    }
}
?>