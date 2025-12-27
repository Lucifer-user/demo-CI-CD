<?php
// Kết nối cơ sở dữ liệu
try {
    $pdh = new PDO("mysql:host=localhost; dbname=lab_thuchanh", "root", "");
    $pdh->query("set names 'utf8'");
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// Kiểm tra nếu có tham số 'id' trong URL (mã loại sách cần xóa)
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];

    // Xóa loại sách
    $stmt = $pdh->prepare("DELETE FROM category WHERE cat_id = :cat_id");
    $stmt->execute(['cat_id' => $cat_id]);

    // Kiểm tra kết quả
    if ($stmt->rowCount() > 0) {
        echo "Đã xóa loại sách với mã loại $cat_id";
    } else {
        echo "Không thể xóa loại sách. Có thể loại sách không tồn tại.";
    }
} else {
    echo "Mã loại sách không hợp lệ!";
}
?>
