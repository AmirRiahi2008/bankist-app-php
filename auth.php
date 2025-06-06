<?php
use App\Validation\Authorization;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? '';

    switch ($action) {
        case 'login':
            $username = trim($_POST["username"] ?? '');
            $password = trim($_POST["password"] ?? '');
            if (empty($username) || empty($password)) {
                echo "<script>alert('Username and password are required.');</script>";
                return;
            }
            $result = Authorization::login($username, $password);
            if ($result === true) {
                redirect();
            } else {
                echo "<script>alert('$result');</script>";
            }
            break;
        default:
            echo "<script>alert('Invalid action');</script>";
            break;
    }
}
