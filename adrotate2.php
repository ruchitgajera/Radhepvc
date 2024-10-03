<?php
require_once('vendor/autoload.php');
require_once('PdfRotate.php');

use CzProject\PdfRotate\PdfRotate;

// Check if both PDF files are provided in the URL
if (isset($_GET['pdf1']) && !empty($_GET['pdf1']) && isset($_GET['pdf2']) && !empty($_GET['pdf2'])) {
    $pdfFile1 = urldecode($_GET['pdf1']); // Decode the URL-encoded file path for the first PDF
    $pdfFile2 = urldecode($_GET['pdf2']); // Decode the URL-encoded file path for the second PDF
    $outputFolder = 'rotate/';
    
    // Create the output directory if it doesn't exist
    if (!is_dir($outputFolder)) {
        mkdir($outputFolder, 0755, true);
    }

    // Set the output file paths for the rotated PDFs
    $rotatedFile1 = $outputFolder . 'rotated_' . basename($pdfFile1);
    $rotatedFile2 = $outputFolder . 'rotated_' . basename($pdfFile2);

    // Create an instance of PdfRotate
    $pdfRotator = new PdfRotate();

    // Rotate the first PDF by 90 degrees
    $pdfRotator->rotatePdf($pdfFile1, $rotatedFile1, PdfRotate::DEGREES_90);

    // Rotate the second PDF by 90 degrees
    $pdfRotator->rotatePdf($pdfFile2, $rotatedFile2, PdfRotate::DEGREES_90);

    // After rotation, redirect to adcrop.php with both rotated PDF files
    header("Location: adcrop1.php?pdf1=" . urlencode($rotatedFile1) . "&pdf2=" . urlencode($rotatedFile2));
    exit;
} else {
    echo "No PDF files specified.";
}
?>
