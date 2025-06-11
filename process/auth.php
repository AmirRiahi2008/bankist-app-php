<?php
include "../bootstrap/init.php";
use App\Utilities\CloseAccount;
use App\Validation\Authorization;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"] ?? null;

    switch ($action) {
        case 'login':
            if (isset($_POST["loginSubmit"])) {
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
            } else
                return;
            break;
        case "closeAcc":
            if (isset($_POST["closeSubmit"])) {
                $pin = (int) $_POST["pin"];
                $name = $_POST["name"];
                CloseAccount::deleteAcc($name, $pin);
            } else
                return;
            break;
        default:
            $_SESSION['alert'] = 'Invalid action';
            redirect();
            // redirect();
            // echo "<script>alert('Invalid action');</script>";
            break;
    }
}
