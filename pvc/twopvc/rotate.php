<?php


require_once('vendor/autoload.php');
require_once('PdfRotate.php');

use CzProject\PdfRotate\PdfRotate;

$outputFolder = 'twopvcrotate/'; // Assuming 'rotate' folder for saving rotated files

// Create the output directory if it doesn't exist
if (!is_dir($outputFolder)) {
    mkdir($outputFolder, 0755, true);
}

$pdfRotator = new PdfRotate();

// Check if the first PDF was uploaded
if (isset($_FILES['pdf_file1']) && $_FILES['pdf_file1']['error'] == 0) {
    $pdfFile1 = $_FILES['pdf_file1']['tmp_name'];
    $outputFile1 = $outputFolder . 'rotated_' . basename($_FILES['pdf_file1']['name']);

    // Rotate and save the first PDF
    $pdfRotator->rotatePdf($pdfFile1, $outputFile1, PdfRotate::DEGREES_90);

    // Check if a second PDF was uploaded
    if (isset($_FILES['pdf_file2']) && $_FILES['pdf_file2']['error'] == 0) {
        $pdfFile2 = $_FILES['pdf_file2']['tmp_name'];
        $outputFile2 = $outputFolder . 'rotated_' . basename($_FILES['pdf_file2']['name']);

        // Rotate and save the second PDF
        $pdfRotator->rotatePdf($pdfFile2, $outputFile2, PdfRotate::DEGREES_90);

        // Redirect to cropping with both rotated PDFs
        header("Location: crop1.php?pdf1=" . urlencode($outputFile1) . "&pdf2=" . urlencode($outputFile2));
        exit;
    } else {
        // Redirect to cropping with only the first rotated PDF
        header("Location: crop.php?pdf=" . urlencode($outputFile1));
        exit;
    }
} else {
    echo "Error: No file uploaded.";
}
?>
