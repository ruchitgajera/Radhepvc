<?php


require_once('vendor/autoload.php');
require_once('PdfRotate.php');

use CzProject\PdfRotate\PdfRotate;

if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
    $pdfFile = $_FILES['pdf_file']['tmp_name'];
    $outputFolder = 'rotate/';
    
    // Create the output directory if it doesn't exist
    if (!is_dir($outputFolder)) {
        mkdir($outputFolder, 0755, true);
    }

    // Set the output file path for the rotated PDF
    $outputFile = $outputFolder . 'rotated_' . basename($_FILES['pdf_file']['name']);

    // Create an instance of PdfRotate and rotate the PDF by 90 degrees
    $pdfRotator = new PdfRotate();
    $pdfRotator->rotatePdf($pdfFile, $outputFile, PdfRotate::DEGREES_90);

    // Redirect to the cropping script with the rotated PDF
    header("Location: crop.php?pdf=" . urlencode($outputFile));
    exit;
} else {
    echo "No file uploaded.";
}
?>
