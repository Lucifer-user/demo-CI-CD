<?php
class News extends Db
{
    // Lấy danh sách tin tức
    public function list()
    {
        $sql = "SELECT * FROM news";
        return $this->select($sql);
    }

    // Lấy chi tiết tin tức theo ID
    public function detail($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id";
        $params = array('id' => $id);
        $result = $this->select($sql, $params);
        return $result ? $result[0] : null; 
    }
}
?>
