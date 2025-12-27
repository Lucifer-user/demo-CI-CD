<?php
class User extends Db
{
    // Đăng ký thành viên
    public function register($username, $password, $email, $fullname)
    {
        $sql = "INSERT INTO users (username, password, email, fullname) VALUES (:username, :password, :email, :fullname)";
        $params = array(
            'username' => $username,
            'password' => md5($password), // Lưu ý: Nên dùng password_hash trong thực tế, nhưng demo dùng md5 cho đơn giản
            'email' => $email,
            'fullname' => $fullname
        );
        return $this->insert($sql, $params);
    }

    // Đăng nhập
    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $params = array(
            'username' => $username,
            'password' => md5($password)
        );
        $result = $this->select($sql, $params);
        return $result ? $result[0] : false;
    }

    // Cập nhật thông tin
    public function update_user($id, $fullname, $email)
    {
        $sql = "UPDATE users SET fullname = :fullname, email = :email WHERE id = :id";
        $params = array(
            'fullname' => $fullname,
            'email' => $email,
            'id' => $id
        );
        return $this->update($sql, $params);
    }
    
    // Lấy thông tin user
    public function get_user($id) {
         $sql = "SELECT * FROM users WHERE id = :id";
         $params = array('id' => $id);
         $result = $this->select($sql, $params);
         return $result ? $result[0] : null;
    }
}
?>
