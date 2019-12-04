<?php
use Quickshiftin\Pdf\Invoice\Invoice as PdfInvoice;
use Quickshiftin\Pdf\Invoice\Factory as InvoiceFactory;
use Quickshiftin\Pdf\Invoice\Spec\Order as Order;

$orderEmail = function()
{
    $className = "Order";
    $myOrder = new $className;
    $oInvoiceFactory = new InvoiceFactory();
    $oInvoicePdf     = new PdfInvoice();

    // Configure fonts - just put ttf font files somewhere your project can access them
    $oInvoicePdf->setRegularFontPath(__DIR__ . '/../assets/Arial.ttf');
    $oInvoicePdf->setBoldFontPath(__DIR__ . '/../assets/Arial Bold.ttf');
    $oInvoicePdf->setItalicFontPath(__DIR__ . '/../assets/Arial Italic.ttf');

    // Set Colors
    $red    = '#d53f27';
    $yellow = '#e8e653';

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
    $oInvoicePdf->setLogoPath(__DIR__ . 'images/WWI.png');

    // Build the PDF
    // $oPdf is an instance of Zend_Pdf
    $oPdf = $oInvoicePdf->getPdf($myOrder);

    // A string rendition, you could echo this to the browser with headers to implement a download
    echo $pdf = $oPdf->render();

    // You can also simply save it to a file
    file_put_contents('/tmp/test.pdf', $pdf);
};