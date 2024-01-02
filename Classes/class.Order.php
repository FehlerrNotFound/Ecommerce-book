<?php
class Order
{
    private $db; // PDO instance
    private $conn;
    private $order_id;
    private $book_id;
    private $customer_name;
    private $customer_email;
    private $order_date;
    private $quantity;
    private $total_price;
    private $shipping_address;
    private $order_status;

    // Constructor
    public function __construct()
    {
        $this->conn = Utility::getDBConnection();
        /*
        $this->book_id = $book_id;
        $this->customer_name = $customer_name;
        $this->customer_email = $customer_email;
        $this->order_date = $order_date;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->shipping_address = $shipping_address;
        $this->order_status = 'Pending'; // default status
    */
    }

    // Getters
    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function getCustomerName()
    {
        return $this->customer_name;
    }

    public function getCustomerEmail()
    {
        return $this->customer_email;
    }

    public function getOrderDate()
    {
        return $this->order_date;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function getOrderStatus()
    {
        return $this->order_status;
    }

    // Setters
    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
    }

    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;
    }

    public function setCustomerEmail($customer_email)
    {
        $this->customer_email = $customer_email;
    }

    public function setOrderDate($order_date)
    {
        $this->order_date = $order_date;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    public function setShippingAddress($shipping_address)
    {
        $this->shipping_address = $shipping_address;
    }

    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
    }

    // CRUD Operations
    public function create($OrderInfo)
    {

        $book_id = $OrderInfo['book_id'];
        $userid = $OrderInfo['userid']; // Visit later
        //$order_date=$OrderInfo['order_date'];
        $quantity = $OrderInfo['quantity'];;
        $total_price = $OrderInfo['total_price'];
        $shipping_address = $OrderInfo['shipping_address'];
        $order_status = $OrderInfo['order_status']; // default status

        $Query = "INSERT INTO orders (
            book_id,
             userid,
               quantity, 
               total_price, 
               shipping_address,
                order_status) 
                VALUES 
                ( '$book_id',
             '$userid',
               '$quantity', 
               '$total_price', 
               '$shipping_address',
                '$order_status'
                )";

        $result = $this->conn->query($Query);
        if ($result) {
            return true;
        } else {
            return false;
        }

        // var_dump($result);
        //$this->order_id = $this->db->lastInsertId();
    }

    public function read($order_id)
    {
        $query = "SELECT * FROM orders WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$order_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->order_id = $order['order_id'];
        $this->book_id = $order['book_id'];
        $this->customer_name = $order['customer_name'];
        $this->customer_email = $order['customer_email'];
        $this->order_date = $order['order_date'];
        $this->quantity = $order['quantity'];
        $this->total_price = $order['total_price'];
        $this->shipping_address = $order['shipping_address'];
        $this->order_status = $order['order_status'];
    }



    public function getOrders($howMany = -1, $start = 0)
    {
        $howMany = (int)$howMany;
        if ($howMany == -1) {
            $Query = "SELECT * FROM `orders`";
        } else {
            $Query = "SELECT * FROM `orders` LIMIT $start, $howMany";
        }

        $result = $this->conn->query($Query);
        if ($result) {
            $Orders = array();
            while ($row = $result->fetch_assoc()) {
                $Orders[] = $row;
            }
            return $Orders;
        } else {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE orders SET book_id = ?, customer_name = ?, customer_email = ?, order_date = ?, quantity = ?, total_price = ?, shipping_address = ?, order_status = ? WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->book_id, $this->customer_name, $this->customer_email, $this->order_date, $this->quantity, $this->total_price, $this->shipping_address, $this->order_status, $this->order_id]);
    }

    public function delete()
    {
        $query = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->order_id]);
    }

    public function cancelOrder()
    {
        $this->order_status = 'Cancelled';
        $this->update();
    }
}
