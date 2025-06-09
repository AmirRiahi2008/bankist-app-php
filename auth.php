<?php
include "./bootstrap/init.php";
use App\Validation\Authorization;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"] ?? null;

    switch ($action) {
        case 'login':
            $username = trim($_POST["username"] ?? '');
            $password = trim($_POST["password"] ?? '');
            if (empty($username) || empty($password)) {
                $_SESSION['alert'] = 'Username And Password Are Required !!';
                redirect();
                return;
            }
            $result = Authorization::login($username, $password);
            if ($result === true) {
                redirect();
            } else {
                $_SESSION['alert'] = $result;
                redirect();
            }
            break;
        default:
            $_SESSION['alert'] = 'Invalid action';
            redirect();
            // redirect();
            // echo "<script>alert('Invalid action');</script>";
            break;
    }
}
