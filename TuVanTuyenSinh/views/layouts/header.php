<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hệ thống tư vấn tuyển sinh UniGuide">
    <meta name="author" content="Minh Quan">
    
    <title>Edu Meeting - Hệ thống tư vấn</title>

    <link href="/TuVanTuyenSinh/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TuVanTuyenSinh/public/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/TuVanTuyenSinh/public/assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="/TuVanTuyenSinh/public/assets/css/owl.css">
    <link rel="stylesheet" href="/TuVanTuyenSinh/public/assets/css/lightbox.css">

    <style>
        /* CSS Tùy chỉnh thêm */
        .background-header {
            background-color: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #eee;
        }
        
        .header-area .main-nav .logo {
            color: #a71d2a !important;
            font-weight: 800;
            text-shadow: none; 
            font-size: 24px;
        }

        .header-area .main-nav .nav li a {
            color: #333 !important;
            font-weight: 600;
            text-transform: capitalize;
            font-size: 15px;
            padding: 0 15px;
        }
        
        .header-area .main-nav .nav li a:hover, 
        .header-area .main-nav .nav li a.active {
            color: #a71d2a !important;
        }

        /* Nút Đăng nhập/Đăng ký đẹp */
        .btn-login-custom {
            background-color: #a71d2a !important;
            color: #fff !important;
            padding: 10px 25px !important;
            border-radius: 25px;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(167, 29, 42, 0.2);
        }
        .btn-login-custom:hover {
            background-color: #80131e !important;
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 6px 15px rgba(167, 29, 42, 0.3);
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        .user-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 220px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.15);
            z-index: 9999;
            border-radius: 10px;
            overflow: hidden;
            top: 45px;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn { from { opacity: 0; margin-top: 10px; } to { opacity: 1; margin-top: 0; } }
        
        .user-dropdown:hover .user-dropdown-content {
            display: block;
        }
        .user-dropdown-content a {
            color: #333 !important;
            padding: 12px 20px !important;
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 14px !important;
            height: auto !important;
            line-height: normal !important;
            border-bottom: 1px solid #f9f9f9;
        }
        .user-dropdown-content a:hover {
            background-color: #f8f9fa;
            color: #a71d2a !important;
            padding-left: 25px !important;
            transition: all 0.2s;
        }
        .user-avatar-small {
            width: 35px; height: 35px; border-radius: 50%; 
            vertical-align: middle; margin-right: 8px; border: 2px solid #a71d2a;
            object-fit: cover;
        }
    </style>
</head>

<body>

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <p>Hệ thống tư vấn tuyển sinh trực tuyến <strong>UniGuide</strong>.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <a href="index.php" class="logo">UniGuide</a>
                      
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="index.php" class="active">Trang chủ</a></li>
                          
                          <li><a href="index.php?page=about">Giới thiệu</a></li>

                          <li><a href="index.php?page=assessment">🧩 Trắc nghiệm</a></li>
                          <li><a href="index.php?page=compare">⚖️ So sánh</a></li>

                          <li class="has-sub">
    <a href="javascript:void(0)">Khám phá</a>
    <ul class="sub-menu">
        <li><a href="index.php?page=majors">🎓 Ngành đào tạo</a></li>
        <li><a href="index.php?page=courses">💻 Các Khóa học</a></li> <li><a href="index.php?page=events">📅 Sự kiện & Hội thảo</a></li>
        <li><a href="index.php?page=mentors">🤝 Kết nối Chuyên gia</a></li>
        <li><a href="index.php?page=resources">📚 Tài nguyên học tập</a></li>
        <li><a href="index.php?page=faq">❓ Câu hỏi thường gặp</a></li>
    </ul>
</li>

                          <?php if(isset($_SESSION['user'])): ?>
                             <li><a href="index.php?page=advice&action=history">Lịch sử</a></li>
                             <li class="user-dropdown">
                                <a href="javascript:void(0)" style="display: flex; align-items: center;">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user']['fullname']) ?>&background=a71d2a&color=fff" class="user-avatar-small" alt="Avatar">
                                    Chào, <?= htmlspecialchars($_SESSION['user']['fullname']) ?> <i class="fa fa-angle-down ml-1" style="font-size: 12px;"></i>
                                </a>
                                <div class="user-dropdown-content">
                                    <a href="#"><i class="fa fa-user mr-2"></i> Hồ sơ cá nhân</a>
                                    <div style="border-top: 1px solid #eee;"></div>
                                    <a href="index.php?page=logout" style="color: #dc3545 !important; font-weight: bold;"><i class="fa fa-sign-out mr-2"></i> Đăng xuất</a>
                                </div>
                             </li>
                          <?php else: ?>
                             <li><a href="index.php?page=auth&action=login" class="btn-login-custom">Đăng nhập</a></li>
                          <?php endif; ?> 
                      </ul>        
                      <a class='menu-trigger'><span>Menu</span></a>
                  </nav>
              </div>
          </div>
      </div>
  </header>