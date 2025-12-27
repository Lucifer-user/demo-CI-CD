<?php
class Cart extends Db
{
    private $_cart;

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $this->_cart = $_SESSION['cart'];
    }

    // Thêm sản phẩm vào giỏ
    public function add($id, $qty = 1)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $qty;
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
        $this->_cart = $_SESSION['cart']; // Cập nhật lại thuộc tính
    }

    // Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        $this->_cart = $_SESSION['cart'];
    }

    // Cập nhật số lượng
    public function update_cart($id, $qty)
    {
        if ($qty <= 0) {
            $this->remove($id);
        } else {
            $_SESSION['cart'][$id] = $qty;
            $this->_cart = $_SESSION['cart'];
        }
    }

    // Lấy danh sách sản phẩm trong giỏ (kèm chi tiết từ DB)
    public function list_cart()
    {
        $list = array();
        if (!empty($this->_cart)) {
            foreach ($this->_cart as $id => $qty) {
                // Giả sử bảng sách là 'book' và có cột 'book_id'
                // Lấy thông tin sách
                $sql = "SELECT DISTINCT book_id, book_name, img, price FROM book WHERE book_id = :id";
                $book = $this->select($sql, array('id' => $id));
                
                if (!empty($book)) {
                    $item = $book[0];
                    $item['qty'] = $qty;
                    $list[] = $item;
                }
            }
        }
        return $list;
    }

    public function get_total_price() {
        $total = 0;
         $items = $this->list_cart();
         foreach($items as $item) {
             if (isset($item['price'])) {
                $total += $item['price'] * $item['qty'];
             }
         }
         return $total;
    }
}
?>
