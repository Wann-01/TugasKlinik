<?php
function initializeUsers() {
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [
            'admin' => ['id' => '1', 'username' => 'admin', 'password' => 'admin123', 'role' => 'admin'],
            'doctor' => ['id' => '2', 'username' => 'doctor', 'password' => 'doctor123', 'role' => 'doctor'],
            'nurse' => ['id' => '3', 'username' => 'nurse', 'password' => 'nurse123', 'role' => 'nurse'],
            'staff' => ['id' => '4', 'username' => 'staff', 'password' => 'staff123', 'role' => 'staff']
        ];
    }
}

function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}
?>
