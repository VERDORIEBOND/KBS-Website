<?php


namespace MyApp;
//include_once 'vendor/quickshiftin/php-pdf-invoice/src/Spec/OrderItem.php';
include 'vendor/autoload.php';
use Quickshiftin\Pdf\Invoice\Spec\OrderItem;

class MyOrderItem implements OrderItem
{
    private $lineID;
    function __construct($lineID)
    {
        $this->lineID = $lineID;
        $conn = NULL;
        include "connection.php";
        $this->conn = $conn;
    }

    /**
     * The name or description of the product
     * @return string
     */
    public function getName()
    {
        $sql = "SELECT Description FROM wideworldimporters.orderlines where	OrderID = $this->lineID;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['Description'];
        }
    }
    /**
     * The 'SKU' or unique identifier for your product
     * @return string
     */
    public function getSku()
    {
        $sql = "SELECT StockItemID FROM wideworldimporters.orderlines where	OrderID = $this->lineID;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['StockItemID'];
        }
    }


    /**
     * The quantity sold
     * @return int
     */
    public function getQuantity()
    {
        return 1;
    }

    /**
     * The price per unit
     * @return float
     */
    public function getPricePerUnit()
    {
        $sql = "SELECT UnitPrice, TaxRate FROM wideworldimporters.orderlines where	OrderID = $this->lineID;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return ($row['UnitPrice'] / 100 * (100 - $row['TaxRate']));
        }
    }

    /**
     * The price including tax
     * @return float
     */
    public function getPrice()
    {
        $totalprice = 0;
        $sql = "SELECT UnitPrice FROM wideworldimporters.orderlines where	OrderID = $this->lineID;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['UnitPrice'];
        }
    }

    /**
     * The sales tax amount in dollars
     * @return float
     */
    public function getSalesTaxAmount()
    {
        $sql = "SELECT UnitPrice, TaxRate FROM wideworldimporters.orderlines where	OrderID = $this->lineID;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return ($row['UnitPrice'] / 100 * $row['TaxRate']);
        }
    }

}