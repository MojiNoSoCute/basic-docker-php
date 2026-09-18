<?php
// ตรวจสอบการเชื่อมต่อฐานข้อมูล MariaDB แบบ Real-time
$db_status = false;
$db_message = "";
$total_passengers = 0;

try {
    $pdo = new PDO("mysql:host=db;dbname=titanic;charset=utf8mb4", "admin", "1234", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3
    ]);
    $db_status = true;
    $db_message = "เชื่อมต่อสำเร็จ (Database: titanic)";
    
    // นับจำนวนข้อมูลในตาราง titanic
    $stmt = $pdo->query("SELECT COUNT(*) FROM titanic");
    $total_passengers = $stmt->fetchColumn();
} catch (PDOException $e) {
    $db_status = false;
    $db_message = "ไม่สามารถเชื่อมต่อได้: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile & Project Home - LEMP Stack</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts (Prompt) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .hero-banner {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 50px 0 70px 0;
            margin-bottom: -40px;
        }
        .profile-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            background: white;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            margin: 0 auto;
        }
        .feature-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 15px;
        }
        .badge-pill {
            border-radius: 50rem;
            padding: 6px 14px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
                <i class="bi bi-box-seam"></i> Docker LEMP App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="bi bi-house-door me-1"></i> หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pdo_show_data.php"><i class="bi bi-table me-1"></i> ข้อมูล Titanic (PDO)</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <?php if ($db_status): ?>
                            <span class="badge bg-success badge-pill d-inline-flex align-items-center gap-1">
                                <i class="bi bi-check-circle-fill"></i> DB Online
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger badge-pill d-inline-flex align-items-center gap-1">
                                <i class="bi bi-x-circle-fill"></i> DB Offline
                            </span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="hero-banner text-center">
        <div class="container">
            <h1 class="fw-bold mb-2">ยินดีต้อนรับสู่ระบบเว็บแอปพลิเคชัน</h1>
            <p class="text-light opacity-75 mb-0">พัฒนาด้วย PHP 7.4 FPM, Nginx และ MariaDB บน Docker Container</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container pb-5">
        <div class="row g-4">
            
            <!-- Profile Card -->
            <div class="col-lg-4">
                <div class="profile-card p-4 text-center">
                    <div class="profile-avatar mb-3">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Watcharakorn</h3>
                    <p class="text-muted mb-2">นักศึกษาสาขาวิชาวิทยาการคอมพิวเตอร์ / IT</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">รหัสนักศึกษา: 013</span>
                        <span class="badge bg-info-subtle text-info border border-info-subtle">NPRU</span>
                    </div>

                    <hr class="my-3 opacity-25">

                    <div class="text-start mb-4">
                        <div class="d-flex align-items-center mb-2 text-secondary">
                            <i class="bi bi-envelope-fill me-3 text-primary"></i>
                            <span class="small">watcharakorn820@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center mb-2 text-secondary">
                            <i class="bi bi-geo-alt-fill me-3 text-danger"></i>
                            <span class="small">มหาวิทยาลัยราชภัฏนครปฐม</span>
                        </div>
                        <div class="d-flex align-items-center text-secondary">
                            <i class="bi bi-hdd-network-fill me-3 text-success"></i>
                            <span class="small">Server Port: 8013</span>
                        </div>
                    </div>

                    <div class="text-start">
                        <h6 class="fw-bold text-muted small text-uppercase mb-2">Tech Stack ที่ใช้งาน</h6>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge bg-light text-dark border">Docker</span>
                            <span class="badge bg-light text-dark border">PHP 7.4 FPM</span>
                            <span class="badge bg-light text-dark border">Nginx</span>
                            <span class="badge bg-light text-dark border">MariaDB</span>
                            <span class="badge bg-light text-dark border">PDO MySQL</span>
                            <span class="badge bg-light text-dark border">Bootstrap 5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="col-lg-8">
                
                <!-- System Status Banner -->
                <div class="alert <?= $db_status ? 'alert-success' : 'alert-danger'; ?> d-flex align-items-center justify-content-between p-3 rounded-4 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi <?= $db_status ? 'bi-database-check' : 'bi-database-x'; ?> fs-2"></i>
                        <div>
                            <div class="fw-bold">สถานะการเชื่อมต่อฐานข้อมูล (MariaDB)</div>
                            <div class="small opacity-85"><?= htmlspecialchars($db_message); ?></div>
                        </div>
                    </div>
                    <?php if ($db_status): ?>
                        <span class="badge bg-success rounded-pill fs-6 px-3 py-2"><?= number_format($total_passengers); ?> แถว</span>
                    <?php endif; ?>
                </div>

                <!-- Action Cards -->
                <div class="row g-3 mb-4">
                    
                    <!-- Card 1: Titanic PDO -->
                    <div class="col-md-6">
                        <div class="card feature-card p-3">
                            <div class="icon-box bg-primary-subtle text-primary">
                                <i class="bi bi-table"></i>
                            </div>
                            <h5 class="fw-bold mb-1">ข้อมูล Titanic (PDO)</h5>
                            <p class="text-muted small mb-3">
                                แสดงรายชื่อผู้โดยสารเรือ Titanic ทั้งหมด <?= number_format($total_passengers); ?> รายการ ผ่านการเชื่อมต่อด้วย PHP PDO
                            </p>
                            <a href="pdo_show_data.php" class="btn btn-primary mt-auto d-flex align-items-center justify-content-center gap-2">
                                <span>เปิดดูตารางข้อมูล</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card 2: Environment Info -->
                    <div class="col-md-6">
                        <div class="card feature-card p-3">
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="bi bi-layers-fill"></i>
                            </div>
                            <h5 class="fw-bold mb-1">โครงสร้าง LEMP Stack</h5>
                            <p class="text-muted small mb-3">
                                ควบคุมด้วย Docker Compose แบ่งออกเป็น 3 คอนเทนเนอร์หลักที่เชื่อมต่อกันผ่าน Internal Network
                            </p>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> <strong>Nginx:</strong> พอร์ต 8013 &rarr; 80</li>
                                <li class="mb-1"><i class="bi bi-check2 text-success me-1"></i> <strong>PHP:</strong> php:7.4-fpm-alpine</li>
                                <li><i class="bi bi-check2 text-success me-1"></i> <strong>DB:</strong> mariadb:latest (titanic)</li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- Server Details Card -->
                <div class="card feature-card p-4">
                    <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle text-primary"></i> ข้อมูลการตั้งค่าระบบ (System Information)
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light w-25">PHP Version</th>
                                    <td><?= phpversion(); ?> (FPM)</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Database Host</th>
                                    <td><code>db</code> (Internal Docker Network)</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Database Name</th>
                                    <td><code>titanic</code></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Database User</th>
                                    <td><code>admin</code></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Web Document Root</th>
                                    <td><code>/var/www/html</code> (&harr; <code>./public_html</code>)</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">PDO Drivers</th>
                                    <td><?= implode(', ', PDO::getAvailableDrivers()); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 text-center text-muted small mt-auto">
        <div class="container">
            <p class="mb-1">Docker LEMP Stack Web Application &bull; Nakhon Pathom Rajabhat University (NPRU)</p>
            <p class="mb-0">&copy; <?= date('Y'); ?> Watcharakorn - Computer Science / Information Technology</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>