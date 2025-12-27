<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lab8_2 - PDO - MySQL - select - insert - parameter</title><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
        .container {
            width: 600px;
            margin: 0 auto; /* căn giữa trang */
        }
</style>
<body>
<div class="container">
        <h1>TÌM KIẾM THÔNG TIN SÁCH</h1>
            <form action="lab8_2.php" method="GET">
                <label for="search"> Tìm kiếm</label>
                <input type="text" name="search" placeholder="Nhập thông tin cần tìm" >
                <button type="submit" class="btn btn-outline-info">Xác nhận</button>
            </form>
    </div>
    <?php
    // ------------------- KẾT NỐI CSDL -------------------
    try {
        // Tạo đối tượng PDO kết nối đến database 'bookstore' với user 'root'
        $pdh = new PDO("mysql:host=localhost; dbname=lab_thuchanh", "root", "");
        // Thiết lập bộ mã UTF-8 để hiển thị tiếng Việt đúng
        $pdh->query("set names 'utf8'");
    } catch (Exception $e) {
        // Nếu kết nối thất bại thì báo lỗi và dừng chương trình
        echo $e->getMessage();
        exit;
    }
    
    if (isset($_GET['search'])) {
        
        $searchTerm = htmlspecialchars($_GET['search']);
    
        
        $stmt = $pdh->prepare("SELECT * FROM book WHERE book_name LIKE :searchTerm OR pub_id  LIKE :searchTerm");
        
       
        $stmt->execute(['searchTerm' => "%$searchTerm%"]);
    
        // Kiểm tra nếu có kết quả trả về
        if ($stmt->rowCount() > 0) {
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sách</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Mã nhà sản xuất</th>
                            <th>Mã loại</th>
                        </tr>
                    </thead>
                    <tbody>";
    
            // Lặp qua các dòng kết quả và hiển thị
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row['book_id'] . "</td>
                        <td>" . $row['book_name'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['price'] . "</td>
                        <td> ". $row['img'] . "</td>
                        <td>" . $row['pub_id'] . "</td>
                        <td>" . $row['cat_id'] . "</td>
                      </tr>";
            }
    
            echo "</tbody></table>";
        } else {
            echo "<p>Không tìm thấy kết quả nào cho từ khóa '$searchTerm'.</p>";
        }
    }
    
    

    // // ------------------- TRUY VẤN SELECT -------------------
    // $search = "a"; // từ khóa tìm kiếm
    // $sql = "select * from publisher where pub_name like :ten"; // câu lệnh SQL có tham số
    // $stm = $pdh->prepare($sql); // chuẩn bị câu lệnh
    // $stm->bindValue(":ten", "%$search%"); // gán giá trị cho tham số :ten
    // $stm->execute(); // thực thi câu lệnh
    // $rows = $stm->fetchAll(PDO::FETCH_ASSOC); // lấy tất cả kết quả dưới dạng mảng kết hợp

    // // In kết quả ra màn hình
    // echo "<pre>";
    // print_r($rows); // hiển thị mảng kết quả
    // echo "</pre>";
    // echo "<hr>";

    // // ------------------- TRUY VẤN INSERT -------------------
    // $ma = "LS1";       // mã loại sách
    // $ten = "Lịch sử"; // tên loại sách
    // $sql = "insert into category(cat_id, cat_name) values(:maloai, :tenloai)"; // câu lệnh SQL có tham số
    // $arr = array(":maloai" => $ma, ":tenloai" => $ten); // mảng ánh xạ tham số với giá trị

    // $stm = $pdh->prepare($sql); // chuẩn bị câu lệnh
    // $stm->execute($arr);        // thực thi với mảng tham số
    // $n = $stm->rowCount();      // số dòng bị ảnh hưởng (số bản ghi thêm được)

    // // In thông báo kết quả
    // echo "Đã thêm $n loại sách";
    ?>


    <?php
        
    ?>


    

</body>

</html>
