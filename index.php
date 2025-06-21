<?php
// Initialize session and include necessary files
session_start();

// Mock functions to replace the React utils
require_once 'utils/auth.php';
require_once 'utils/doctors.php';
require_once 'types.php';

// Initialize users and get current user
initializeUsers();
$user = getCurrentUser();

// Get today's doctors
$todaysDoctors = getTodaysDoctors();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        // Handle logout
        session_destroy();
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['login'])) {
        // Handle login (simplified for example)
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        // In a real app, you would validate credentials here
        $_SESSION['user'] = ['username' => $username, 'role' => 'patient']; // Simplified
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['book_appointment'])) {
        // Handle appointment booking
        $patientData = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'address' => $_POST['address'],
            'id' => time()
        ];
        
        // Save to session (in real app, save to database)
        if (!isset($_SESSION['patients'])) {
            $_SESSION['patients'] = [];
        }
        $_SESSION['patients'][] = $patientData;
        
        // Redirect to avoid form resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// Check if we should show login modal
$showLoginModal = isset($_GET['show_login']);

// Check if we should show appointment modal
$showAppointmentModal = isset($_GET['show_appointment']);
$selectedDoctorId = $_GET['doctor_id'] ?? null;
$selectedDoctor = null;

if ($selectedDoctorId) {
    foreach ($todaysDoctors as $doctor) {
        if ($doctor['id'] == $selectedDoctorId) {
            $selectedDoctor = $doctor;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Sehat</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .bg-gradient-custom {
            background: linear-gradient(to bottom right, #f0f9ff, #ffffff, #f0fdf4);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-custom">
    <?php if ($user && in_array($user['role'], ['admin', 'doctor', 'nurse', 'staff'])): ?>
        <!-- Staff Dashboard -->
        <div class="min-h-screen bg-gray-50">
            <?php include 'components/header.php'; ?>
            
            <?php 
            switch ($user['role']) {
                case 'admin':
                    include 'components/dashboards/admin.php';
                    break;
                case 'doctor':
                    include 'components/dashboards/doctor.php';
                    break;
                case 'nurse':
                    include 'components/dashboards/nurse.php';
                    break;
                case 'staff':
                    include 'components/dashboards/staff.php';
                    break;
                default:
                    echo '<div>Invalid role</div>';
            }
            ?>
        </div>
    <?php else: ?>
        <!-- Public Homepage -->
        
        <!-- Modern Header -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-r from-blue-600 to-green-600 p-2 rounded-xl">
                            <i data-lucide="stethoscope" class="h-6 w-6 md:h-8 md:w-8 text-white"></i>
                        </div>
                        <h1 class="text-xl md:text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                            Klinik Sehat
                        </h1>
                    </div>
                    
                    <a href="?show_login=true" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 md:px-6 md:py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 inline-flex items-center">
                        <i data-lucide="users" class="h-4 w-4 mr-2"></i>
                        Login Staff
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Hero Section -->
        <section class="py-12 md:py-20 lg:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-100 to-green-100 px-4 py-2 rounded-full mb-6">
                        <i data-lucide="heart" class="h-5 w-5 text-blue-600"></i>
                        <span class="text-sm font-medium text-blue-800">Pelayanan Kesehatan Terpercaya</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Selamat Datang di
                        <span class="block bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                            Klinik Sehat
                        </span>
                    </h1>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Memberikan pelayanan kesehatan terbaik dengan dokter berpengalaman 
                        dan fasilitas modern untuk keluarga Anda
                    </p>
                </div>

                <!-- Today's Doctors Section -->
                <div class="mb-16 md:mb-20">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center space-x-2 mb-4">
                            <i data-lucide="calendar" class="h-6 w-6 text-blue-600"></i>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                                Dokter Bertugas Hari Ini
                            </h2>
                        </div>
                        <p class="text-gray-600 text-base md:text-lg">
                            Tim dokter profesional siap melayani Anda
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                        <?php foreach ($todaysDoctors as $doctor): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="bg-gradient-to-r from-blue-100 to-green-100 p-3 rounded-full">
                                            <i data-lucide="user" class="h-6 w-6 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($doctor['name']) ?></h3>
                                            <p class="text-blue-600"><?= htmlspecialchars($doctor['specialization']) ?></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2 mb-6">
                                        <div class="flex items-center text-gray-600">
                                            <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                            <span><?= htmlspecialchars($doctor['schedule']) ?></span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i data-lucide="map-pin" class="h-4 w-4 mr-2"></i>
                                            <span>Ruang <?= htmlspecialchars($doctor['room']) ?></span>
                                        </div>
                                    </div>
                                    <a href="?show_appointment=true&doctor_id=<?= $doctor['id'] ?>" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-2 px-4 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200">
                                        <i data-lucide="calendar-plus" class="h-4 w-4"></i>
                                        <span>Buat Janji</span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Calendar and News Sections -->
        <div class="bg-white/50 backdrop-blur-sm">
            <?php include 'components/calendar.php'; ?>
            <?php include 'components/news.php'; ?>
        </div>
    <?php endif; ?>

    <!-- Login Modal -->
    <?php if ($showLoginModal): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Login Staff</h2>
                    <a href="?" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </a>
                </div>
                <form method="POST" action="">
                    <div class="space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" id="username" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" name="login" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-2 px-4 rounded-lg transition-all duration-200">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Appointment Modal -->
    <?php if ($showAppointmentModal && $selectedDoctor): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Buat Janji dengan <?= htmlspecialchars($selectedDoctor['name']) ?></h2>
                    <a href="?" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </a>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="book_appointment" value="1">
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" id="dob" name="dob" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="gender" value="male" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="gender" value="female" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea id="address" name="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 text-white py-2 px-4 rounded-lg transition-all duration-200">
                            Buat Janji
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
