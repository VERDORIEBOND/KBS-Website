<?php


namespace MyApp;
include_once 'vendor/quickshiftin/php-pdf-invoice/src/Spec/OrderItem.php';
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
        $sql = "SELECT StockItemID FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
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
        $sql = "SELECT UnitPrice FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['UnitPrice'];
        }
    }

    /**
     * The price including tax
     * @return float
     */
    public function getPrice()
    {
        $totalprice = 0;
        $sql = "SELECT RecommendedRetailPrice FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['RecommendedRetailPrice'];
        }
        $totalprice = $totalprice * 1.15;
        return $totalprice;
    }

    /**
     * The sales tax amount in dollars
     * @return float
     */
    public function getSalesTaxAmount()
    {
        $totaltax = 0;
        $sql = "SELECT RecommendedRetailPrice FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['RecommendedRetailPrice'];
        }
        $totaltax = $totaltax * 0.15;
        return $totaltax;
    }

}