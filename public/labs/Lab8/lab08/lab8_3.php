<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Quản lý loại sách</title>
    <style>
        /* Khung chứa nội dung chính */
        #container {
            width: 600px;
            margin: 0 auto; /* căn giữa trang */
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>Thêm loại sách mới</h1>

        <!-- Form nhập dữ liệu loại sách -->
        <form action="lab8_3.php" method="post">
            <table class="table">
                <tr>
                    <td>Mã loại:</td>
                    <td><input type="text" name="cat_id" /></td>
                    
                </tr>
                
        
                <tr>
                    <td>Tên loại:</td>
                    <td><input type="text" name="cat_name" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="sm" value="Thêm" class="btn btn-success" />
                    </td>
                </tr>
            </table>
        </form>
        
            <table class="table">
                <thead>
                   <tr>
                    <td>Mã loại</td>
                    <td>Tên loại</td>
                    <td>Thao tác</td>
                </tr> 
                </thead>
                <tbody>

             
                
                
          
        

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

        // ------------------- XỬ LÝ THÊM LOẠI SÁCH -------------------
        if (isset($_POST["sm"])) { // kiểm tra nếu người dùng bấm nút Insert
            // Câu lệnh SQL thêm loại sách mới với tham số
            $sql = "insert into category(cat_id, cat_name) values(:cat_id, :cat_name)";
            // Mảng ánh xạ tham số với dữ liệu nhập từ form
            $arr = array(":cat_id" => $_POST["cat_id"], ":cat_name" => $_POST["cat_name"]);
            // Chuẩn bị và thực thi câu lệnh
            $stm = $pdh->prepare($sql);
            $stm->execute($arr);
            $n = $stm->rowCount(); // số dòng bị ảnh hưởng

            // Thông báo kết quả
            if ($n > 0) echo "Đã thêm $n loại ";
            else echo "Lỗi thêm ";
        }

        // ------------------- LẤY DANH SÁCH LOẠI SÁCH -------------------
        $stm = $pdh->prepare("select * from category");
        $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC); // lấy tất cả kết quả dưới dạng mảng kết hợp
        // <!-- Hiển thị danh sách loại sách -->
       foreach ($rows as $row){
        echo"<tr>
            <td>".htmlspecialchars($row['cat_id'])."</td>
            <td>".htmlspecialchars($row['cat_name'])."</td>
            <td><a class='btn btn-danger' href='edit_category.php?id=".$row['cat_id']."'>Edit</a>
                  <a class='btn btn-secondary' href='delete_category.php?id=".$row['cat_id']."'>Delete</a>
            </td>
        </tr>";
       }
       ?>

     
        </tbody>
    </table>
    </div>
            