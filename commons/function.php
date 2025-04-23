<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Kết nối CSDL qua PDO
function connectDB()
{
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderUpload)
{
    $pathStorage = $folderUpload . time() . $file['name'];

    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }

    return null;
}

function deleteFile($file)
{
    $pathDelete = PATH_ROOT . $file;

    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

function deleteSessionError()
{
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        unset($_SESSION['errors']);
    }
}
// format date
function formatDate($date)
{
    return date("d-m-Y", strtotime($date));
}

function formatDateDB($date)
{
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return null;
    }
    return date("Y-m-d", $timestamp);
}


function generateOrderCode($prefix = 'STYLMART')
{
    $uid = substr(uniqid(), -5);
    $rand = mt_rand(100, 999);
    return $prefix . '-' . strtoupper($uid) . $rand;
}

function routeAdmin($callback)
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        echo "Bạn không có quyền truy cập chức năng này.";
        exit;
    }

    return $callback();
}


function viewData($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
