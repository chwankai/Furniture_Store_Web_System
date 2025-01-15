<?php

class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "shopping";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            //throw $th;
            echo "Connection error " . $th->getMessage();
        }
    }
public function fetch()
    {
        $data = [];
        // $grandTotal = 0;
        $query = "SELECT
        orders.id AS id,
        GROUP_CONCAT(CONCAT(products.productName, '@RM', products.productPrice, '-Qty:', orderdetails.quantity) SEPARATOR '; ') AS productdetails,
        orders.orderDate AS orderDate,
        orders.orderStatus AS ostatus,
        orders.subtotal AS subtotal,
        orders.shippingCharge AS charge,
        orders.grandtotal AS grand
    FROM
        orders
        JOIN users ON orders.userId = users.id
        JOIN orderdetails ON orders.id = orderdetails.orderId
        JOIN products ON products.id = orderdetails.productId
        LEFT JOIN category ON products.category = category.id
        LEFT JOIN subcategory ON products.subCategory = subcategory.id
    WHERE
        orders.orderStatus IS NOT NULL
    GROUP BY
        orders.id, orders.orderDate, orders.orderStatus, orders.subtotal, orders.shippingCharge, orders.grandtotal;";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                // $grandTotal += $row['price'];
                $data[] = $row;
            }
        }
        // $data['grandTotal'] = $grandTotal;
        return $data;
    }

    public function date_range($start_date, $end_date)
    {
        $data = [];
        // $grandTotal = 0;

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT
            orders.id AS id,
            GROUP_CONCAT(CONCAT(products.productName, '@RM', products.productPrice, '-Qty:', orderdetails.quantity) SEPARATOR '; ') AS productdetails,
            orders.orderDate AS orderDate,
            orders.orderStatus AS ostatus,
            orders.subtotal AS subtotal,
            orders.shippingCharge AS charge,
            orders.grandtotal AS grand
        FROM
            orders
            JOIN users ON orders.userId = users.id
            JOIN orderdetails ON orders.id = orderdetails.orderId
            JOIN products ON products.id = orderdetails.productId
            LEFT JOIN category ON products.category = category.id
            LEFT JOIN subcategory ON products.subCategory = subcategory.id
        WHERE
            orders.orderStatus IS NOT NULL AND `orderDate` > '$start_date' AND `orderDate` < '$end_date'
        GROUP BY
            orders.id, orders.orderDate, orders.orderStatus, orders.subtotal, orders.shippingCharge, orders.grandtotal";

            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    // $grandTotal += $row['price'];
                    $data[] = $row;
                }
            }
        }
        // $data['grandTotal'] = $grandTotal;
        return $data;
    }
}

?>