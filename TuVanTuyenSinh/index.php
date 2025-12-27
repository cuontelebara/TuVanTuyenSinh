<?php
// index.php
session_start(); // <--- BẮT BUỘC: Phải có ở dòng đầu tiên

// 1. Nhúng file cấu hình DB
if (file_exists('config/db.php')) {
    require_once 'config/db.php';
} else {
    die("Lỗi: Không tìm thấy file cấu hình 'config/db.php'. Hãy kiểm tra lại kết nối CSDL.");
}

// 2. Lấy tham số trên URL
$page   = isset($_GET['page']) ? $_GET['page'] : 'advice';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// ==========================================================
// 🔥 LOGIC BẮT BUỘC ĐĂNG NHẬP (Gatekeeper)
// ==========================================================
if (!isset($_SESSION['user'])) {
    // Danh sách các trang được phép truy cập mà không cần đăng nhập
    $allowed_pages = ['login', 'register', 'auth'];
    
    // Nếu trang hiện tại KHÔNG nằm trong danh sách cho phép -> Đẩy về login
    if (!in_array($page, $allowed_pages)) {
        header("Location: index.php?page=login");
        exit;
    }
} else {
    // ==========================================================
    // 🚫 CHẶN ADMIN: Admin chỉ được ở trang Admin
    // ==========================================================
    $userRole = isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : (isset($_SESSION['role']) ? $_SESSION['role'] : 'user');

    if ($userRole == 'admin') {
        // Nếu đang cố truy cập trang khác ngoài 'admin' và 'logout' -> Đá về Admin Dashboard
        if ($page !== 'admin' && $page !== 'logout') {
            header("Location: index.php?page=admin");
            exit;
        }
    }
}
// ==========================================================

// 3. Điều hướng (Router)
switch ($page) {
    
    // === TRANG CHỦ (TƯ VẤN) ===
    case 'advice':
        $controllerFile = 'controllers/AdviceController.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists('AdviceController')) {
                $controller = new AdviceController($conn);
                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    $controller->index();
                }
            }
        } else {
            echo "Lỗi: Không tìm thấy file AdviceController.php";
        }
        break;

    // === MODULE ĐÁNH GIÁ NĂNG LỰC (MỚI THÊM) ===
    case 'assessment':
        $controllerFile = 'controllers/AssessmentController.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists('AssessmentController')) {
                $assessment = new AssessmentController($conn);
                if (method_exists($assessment, $action)) {
                    $assessment->$action();
                } else {
                    $assessment->index();
                }
            }
        } else {
            echo "Lỗi: Chưa tạo file controllers/AssessmentController.php";
        }
        break;

    // === XỬ LÝ ĐĂNG NHẬP ===
    case 'login':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController($conn);
        $auth->login();
        break;

    // === XỬ LÝ ĐĂNG KÝ ===
    case 'register':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController($conn);
        $auth->register();
        break;

    // === XỬ LÝ ĐĂNG XUẤT ===
    case 'logout':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController($conn);
        $auth->logout();
        break;

    // === XỬ LÝ AUTH CHUNG ===
    case 'auth':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController($conn);
        if (method_exists($auth, $action)) {
            $auth->$action();
        } else {
            $auth->login();
        }
        break;

    // === TRANG QUẢN TRỊ (ADMIN) ===
    case 'admin':
        $controllerFile = 'controllers/AdminController.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $admin = new AdminController($conn);
            if (method_exists($admin, $action)) {
                $admin->$action();
            } else {
                $admin->index();
            }
        } else {
            echo "Lỗi: Không tìm thấy file AdminController.php";
        }
        break;
        
    // === MODULE SO SÁNH ===
    case 'compare':
        require_once 'controllers/CompareController.php';
        $compare = new CompareController($conn);
        if (method_exists($compare, $action)) {
            $compare->$action();
        } else {
            $compare->index();
        }
        break;
    // === MODULE MỞ RỘNG ===
    case 'events':
        require_once 'controllers/EventController.php';
        $events = new EventController($conn);
        $events->index();
        break;

    case 'mentors':
        require_once 'controllers/MentorController.php';
        $mentors = new MentorController($conn);
        $mentors->index();
        break;

    case 'resources':
        require_once 'controllers/ResourceController.php';
        $resources = new ResourceController($conn);
        $resources->index();
        break;

    case 'faq':
        require_once 'controllers/FaqController.php';
        $faq = new FaqController($conn);
        $faq->index();
        break;
    // === TRANG GIỚI THIỆU ===
    case 'about':
        require_once 'controllers/AboutController.php';
        $about = new AboutController();
        $about->index();
        break;

    // === TRANG DANH SÁCH NGÀNH ===
    case 'majors':
        require_once 'controllers/MajorController.php';
        $major = new MajorController($conn);
        $major->index();
        break;
    // === TRANG KHÓA HỌC ===
    case 'courses':
        require_once 'controllers/CourseController.php';
        $course = new CourseController($conn);
        $course->index();
        break;

    // === TRANG KHÔNG TỒN TẠI HOẶC MẶC ĐỊNH ===
    default:
        // Quay về trang chủ tư vấn
        header("Location: index.php?page=advice");
        exit;
        break;
}
?>