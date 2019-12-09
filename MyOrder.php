<?php


namespace MyApp;
include_once 'C:\xampp\htdocs\vendor\quickshiftin\php-pdf-invoice\src\Spec\Order.php';
use Quickshiftin\Pdf\Invoice\Spec\Order;
date_default_timezone_set('CET');

class MyOrder implements Order
{
    private $conn;
    function __construct()
    {
        $conn = NULL;
        include_once "connection.php";
        $this->conn = $conn;
    }
    /**
     * Get the sub-total, eclusive of shipping and tax.
     * @return float
     */
    public function getPriceBeforeShippingNoTax()
    {
        $totalprice = 0;
        $sql = "SELECT RecommendedRetailPrice FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $totalprice = $totalprice + $row['RecommendedRetailPrice'];
        }
        return $totalprice;
    }

    /**
     * Get the shipping charge if any
     * @return float
     */
    public function getCustomerShipCharge()
    {
        return 0.0;
    }

    /**
     * Get the sales tax amount, eg .08 for 8%
     * @return float
     */
    public function getSalesTaxAmount()
    {
        $totaltax = 0.0;
        $sql = "SELECT RecommendedRetailPrice FROM wideworldimporters.stockitems WHERE StockItemID = 15;";
        $result = mysqli_query($this->conn,$sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            return $row['RecommendedRetailPrice'];
        }
        $totaltax = $totaltax * 0.15;
        return $totaltax;
    }


    /**
     * Get the total cost including shipping and tax
     * @return float
     */
    public function getTotalCost()
    {
        $totalprice = 0.0;
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
     * Get the full billing address for the customer
     * @return string
     */
    public function getFullBillingAddress()
    {
        return "Nabbert 2, Leusden, Nederland, 3831PK";
    }

    /**
     * Get the payment method, EG COD, Visa, PayPal etc
     * @return string
     */
    public function getPaymentMethod()
    {
        return "iDeal";
    }

    /**
     * Get the full shipping address for the order
     * @return string
     */
    public function getFullShippingAddress()
    {
        return "Nabbert 2, Leusden, Nederland, 3831PK";
    }

    /**
     * Get the name of the shipping method, EG UPS, FedEx, etc
     * @return string
     */
    public function getShippingMethodName()
    {
        return "PostNL";
    }

    /**
     * Get an array of OrderItem objects
     * @note This should return an array of instances of a class where you implement Quickshiftin\Pdf\Invoice\Spec\OrderItem
     * @return array
     */
    public function getOrderItems()
    {
        $orderItems = MyOrderItem::class;
        return $orderItems;
    }

    /**
     * Get the id of the order
     * @return int|string
     */
    public function getOrderId()
    {
        return mt_rand(1000,10000);
    }

    /**
     * Get the date of the sale
     * @returnDateTime
     */
    public function getSaleDate($sFormat)
    {
        $date = new \DateTime('2000-01-01');
        return $date->format($sFormat);

        //$date = date('M jS Y g:i a');
        //return date_format($date,'M jS Y g:i a');
    }
    public function getOrderNote()
    {

    }
}