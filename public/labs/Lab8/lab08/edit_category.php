<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try{
            $pdh=new PDO("mysql:host=localhost;dbname=lab_thuchanh","root","");
            $pdh->query("set names 'utf8'");
        }
        catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
        if(isset($_GET['id'])){
            $cat_id=$_GET['id'];

            $stmt=$pdh->prepare("SELECT * FROM category WHERE cat_id=:cat_id");
            $stmt->execute((['cat_id'=>$cat_id]));
            $category=$stmt->fetch(PDO::FETCH_ASSOC);


            if(!$category){
                echo"Không tìm thấy loại sách và mã loại $cat_id";
                exit;
            }
            if(isset($_POST['sm'])){
                $cat_namee=$_POST['cat_name'];

                $sql="UPDATE category SET cat_name=cat_name WHERE cat_id=:cat_id";
                $stmt=$pdh->prepare($sql);
                $stmt->execute(['cat_name'=>$cat_name,'cat_id'=>$cat_id]);
                echo"Loại sách đã cập nhật";
            }
        }
        else{
            echo"Mã loại không hợp lệ!";
            exit;
        }
    ?>
    <div id="container">
        <h1>Sửa loại sách</h1>
        <form action="edit_category.php?id=<?php echo $category['cat_id'];?>"methot="post">
            <tr>
                <td>Mã loại</td>
                <td><input type="text" name="cat_id" value="<?php echo $category['cat_id'];?>"disable></td>
            </tr>
            <tr>
                <td>Tên loại</td>
                <td><input type="text" name="cat_name" value="<?php echo $category['cat_name'];?>"require></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="sm" value="Cập nhật" class="btn btn-success"/>
                </td>
            </tr>
    </table>
    </form>
    </div>
</body>
</html>