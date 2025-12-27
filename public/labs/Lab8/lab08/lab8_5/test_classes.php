<?php
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Include config và các class
include "config/config.php";
include "classes/Db.class.php";
include "classes/News.class.php";
include "classes/User.class.php";
include "classes/Cart.class.php";

echo "<h1>Kiểm tra các Class</h1>";

// 1. Kiểm tra News
echo "<h2>1. Test News Class</h2>";
$news = new News();
echo "Object News created successfully.<br>";
// $list = $news->list(); // Chưa có bảng news nên có thể lỗi nếu chạy, chỉ test khởi tạo

// 2. Kiểm tra User
echo "<h2>2. Test User Class</h2>";
$user = new User();
echo "Object User created successfully.<br>";
// $login = $user->login('admin', '123456'); // Test giả định

// 3. Kiểm tra Cart
echo "<h2>3. Test Cart Class</h2>";
$cart = new Cart();
echo "Object Cart created successfully.<br>";

// Thêm sản phẩm vào giỏ (giả định)
$cart->add(1, 2); // Thêm sách ID 1 số lượng 2
$cart->add(2, 1); // Thêm sách ID 2 số lượng 1
echo "Added items to cart.<br>";

// Hiển thị giỏ hàng
echo "<h3>Cart Content:</h3>";
echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";

// List chi tiết (sẽ query DB nên cần DB thật, ở đây chỉ test logic class chạy không lỗi cú pháp)
// $items = $cart->list_cart();
// print_r($items);

echo "<hr>Test Script Finished.";
?>
