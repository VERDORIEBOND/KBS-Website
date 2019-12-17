<?php
use Quickshiftin\Pdf\Invoice\Invoice as PdfInvoice;
use Quickshiftin\Pdf\Invoice\Factory as InvoiceFactory;
include 'MyOrder.php';
//include 'C:/xampp/htdocs/vendor/quickshiftin/php-pdf-invoice/src/Factory.php';
//include 'C:/xampp/htdocs/vendor/quickshiftin/php-pdf-invoice/src/Invoice.php';
include 'vendor/autoload.php';

$orderEmail = function()
{

    $myOrder = new \myapp\MyOrder();

    $oInvoiceFactory = new InvoiceFactory();
    $oInvoicePdf     = new PdfInvoice();
    // Configure fonts - just put ttf font files somewhere your project can access them

    $oInvoicePdf->setRegularFontPath(__DIR__ . '/vendor/quickshiftin/php-pdf-invoice/assets/Arial.ttf');
    $oInvoicePdf->setBoldFontPath(__DIR__ . '/vendor/quickshiftin/php-pdf-invoice/assets/Arial Bold.ttf');
    $oInvoicePdf->setItalicFontPath(__DIR__ . '/vendor/quickshiftin/php-pdf-invoice/assets-/Arial Italic.ttf');

    // Set Colors
    $red    = '#00bcf2';
    $yellow = '#dbd6d3';

    // Title section of invoice
    // Background color for title section of invoice, the default is white
    $oInvoicePdf->setTitleBgFillColor($oInvoiceFactory->createColorHtml($yellow));
    $oInvoicePdf->setTitleFontColor($oInvoiceFactory->createColorHtml('black'));

    // Header sections of invoice
    $oInvoicePdf->setHeaderBgFillColor($oInvoiceFactory->createColorHtml($red));
    $oInvoicePdf->setBodyHeaderFontColor($oInvoiceFactory->createColorHtml('white'));

    // Body section of invoice
    $oInvoicePdf->setBodyFontColor($oInvoiceFactory->createColorHtml('black'));

    // Line color of invoice
    $oInvoicePdf->setLineColor($oInvoiceFactory->createColorGrayscale(0));

    // Configure logo
    $oInvoicePdf->setLogoPath(__DIR__ . 'images/WWIJPG.jpg');
    // Build the PDF
    // $oPdf is an instance of Zend_Pdf
    $oPdf = $oInvoicePdf->getPdf($myOrder);             //testen hoe ver het programma komt
    // A string rendition, you could echo this to the browser with headers to implement a download
    $pdf = $oPdf->render();

    // You can also simply save it to a file
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/temp/test.pdf', $pdf);
};