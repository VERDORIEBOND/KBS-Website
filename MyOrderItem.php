<?php


namespace MyApp;
use Quickshiftin\Pdf\Invoice\Spec\OrderItem;
include "getOrderData.php";
include "connection.php";
class MyOrderItem implements OrderItem
{
    /**
     * The name or description of the product
     * @return string
     */
    public function getName();

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