<?php
require_once "config/config.php";

$controllerParam = isset($_GET['controller']) ? $_GET['controller'] : 'sinhvien';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controllerParam) {
    case 'sinhvien':
        require_once "controllers/SinhVienController.php";
        $controller = new SinhVienController();
        break;
    
    case 'hocphan':
        require_once "controllers/HocPhanController.php";
        $controller = new HocPhanController();
        break;
    
        case 'auth':
            require_once "controllers/AuthController.php";
            $controller = new AuthController();
            break;
    default:
        echo "Controller not found.";
        exit;
}

// Gọi action
switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'confirmDelete':
        $controller->confirmDelete();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'detail':
        $controller->detail();
        break;
    case 'dangKy':
        $controller->dangKy();
            break;
    case 'showRegistered':
                $controller->showRegistered();
                break;
    case 'removeOne':
                $controller->removeOne();
                break;
    case 'removeAll':
                $controller->removeAll();
                break;
    case 'login':
        $controller->login();
            break;
    case 'showLogin':
        $controller->showLogin();
                break;
    case 'logout':
        $controller->logout();
                break;
                case 'saveRegistration':
                    $controller->saveRegistration();
                    break;
    default:
        echo "Action not found.";
        break;
}
?>
