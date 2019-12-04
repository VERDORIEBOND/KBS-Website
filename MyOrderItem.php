<?php


namespace MyApp;
use Quickshiftin\Pdf\Invoice\Spec\OrderItem;
include "getOrderData.php";
include "connection.php";
class MyOrderItem implements OrderItem
{
    function __construct()
    {
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
        $sql = "SELECT StockGroupName FROM wideworldimporters.stockgroups";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['StockGroupName'];
        }
    }
    /**
     * The 'SKU' or unique identifier for your product
     * @return string
     */
    public function getSku();

    /**
     * The quantity sold
     * @return int
     */
    public function getQuantity();

    /**
     * The price per unit
     * @return float
     */
    public function getPricePerUnit();

    /**
     * The price including tax
     * @return flaot
     */
    public function getPrice();

    /**
     * The sales tax amount in dollars
     * @return float
     */
    public function getSalesTaxAmount();
}