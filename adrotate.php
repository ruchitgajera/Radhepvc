<?php
require_once('vendor/autoload.php');
require_once('PdfRotate.php');

use CzProject\PdfRotate\PdfRotate;

if (isset($_GET['pdf']) && !empty($_GET['pdf'])) {
    $pdfFile = urldecode($_GET['pdf']); // Decode the URL-encoded file path
    $outputFolder = 'rotate/';
    
    // Create the output directory if it doesn't exist
    if (!is_dir($outputFolder)) {
        mkdir($outputFolder, 0755, true);
    }

    // Set the output file path for the rotated PDF
    $rotatedFile = $outputFolder . 'rotated_' . basename($pdfFile);

    // Create an instance of PdfRotate and rotate the PDF by 90 degrees
    $pdfRotator = new PdfRotate();
    $pdfRotator->rotatePdf($pdfFile, $rotatedFile, PdfRotate::DEGREES_90);

    // After rotation, redirect to adcrop.php with the rotated PDF file
    header("Location: adcrop.php?pdf=" . urlencode($rotatedFile));
    exit;
} else {
    echo "No PDF file specified.";
}
?>
