<?php
/*
 * How to verify Mollie API Payments in a webhook.
 *
 * See: https://docs.mollie.com/guides/webhooks
 */

try {
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/dashboard/developers/api-keys
     */
    require "../initialize.php";

    /*
     * Retrieve the payment's current state.
     */
    $payment = $mollie->payments->get($_POST["id"]);
    $orderId = $payment->metadata->order_id;
    $status = $payment->status;
    /*
     * Update the order in the database.
     */
    $sql1= "UPDATE ordersprivate SET orderstatus = ? WHERE OrderID = ?";
    if($stmt1=mysqli_prepare($conn,$sql1)){
        mysqli_stmt_bind_param($stmt1, "si", $status, $orderId);
        mysqli_stmt_execute($stmt1);
    }

    if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {                                      //Changing stock to represent the order once paid
        $result = mysqli_query($conn,"SELECT StockItemID, Quantity FROM orderlines WHERE OrderID = $orderId");
        while($row = mysqli_fetch_array($result)){
            $quantity=$row['Quantity'];
            $itemID=$row['StockItemID'];
            $sql="UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - ? WHERE StockItemID = ? ";
            if($stmt=mysqli_prepare($conn,$sql)){
                mysqli_stmt_bind_param($stmt, "ii",$quantity,$itemID);
                mysqli_stmt_execute($stmt);
            }
        }
        mysqli_free_result($result);
    } elseif ($payment->isOpen()) {
        /*
         * The payment is open.
         */
    } elseif ($payment->isPending()) {
        /*
         * The payment is pending.
         */
    } elseif ($payment->isFailed()) {
        /*
         * The payment has failed.
         */
    } elseif ($payment->isExpired()) {
        /*
         * The payment is expired.
         */
    } elseif ($payment->isCanceled()) {
        /*
         * The payment has been canceled.
         */
    } elseif ($payment->hasRefunds()) {
        /*
         * The payment has been (partially) refunded.
         * The status of the payment is still "paid"
         */
    } elseif ($payment->hasChargebacks()) {
        /*
         * The payment has been (partially) charged back.
         * The status of the payment is still "paid"
         */
    }
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}