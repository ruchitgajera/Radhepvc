<?php

use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php'; // Ensure this path is correct for Composer autoload

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pdf1'])) {
    $pdfFile = $_GET['pdf1'];
    $outputDir = 'twopvctest/';

    // Create the output directory if it doesn't exist
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Define output file paths
    $pdfOutput1 = $outputDir . 'cropped_part1.pdf'; 
    $pdfOutput2 = $outputDir . 'cropped_part2.pdf';

    try {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfFile);

        // Crop first part
        $pdf->AddPage('P', [86, 54]);
        $templateId1 = $pdf->importPage(1);
        $pdf->useTemplate($templateId1, -35, -13, 277, 203);
        $pdf->Output($pdfOutput1, 'F');

        // Crop second part
        $pdf = new Fpdi(); // Create a new instance for the second part
        $pdf->setSourceFile($pdfFile);
        $pdf->AddPage('P', [86, 54]);
        $templateId2 = $pdf->importPage(1);
        $pdf->useTemplate($templateId2, -35, -103.5, 277, 203);
        $pdf->Output($pdfOutput2, 'F');

        // Redirect to crop the second PDF
        header("Location: adcrop2.php?pdf2=" . urlencode($_GET['pdf2']));
        exit;
        
    } catch (Exception $e) {
        // Handle any errors that occur during PDF processing
        echo "An error occurred while processing the PDF: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "No file specified.";
}
?>
