<?php
use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pdf'])) {
    $pdfFile = urldecode($_GET['pdf']); // Decode the URL-encoded file path
    $outputDir = 'test/';
    
    // Create the output directory if it doesn't exist
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Set output file paths for the cropped PDFs
    $pdfOutput1 = $outputDir . 'cropped_part1.pdf';
    $pdfOutput2 = $outputDir . 'cropped_part2.pdf';

    // Initialize FPDI for cropping the first part
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile($pdfFile);

    // Crop first part
    $pdf->AddPage('P', [86, 54]);
    $templateId1 = $pdf->importPage(1);
    $pdf->useTemplate($templateId1, -35, -13, 277, 203);
    $pdf->Output($pdfOutput1, 'F');

    // Initialize FPDI for cropping the second part
    $pdf = new Fpdi(); // Create a new instance for the second cropping
    $pdf->setSourceFile($pdfFile);
    $pdf->AddPage('P', [86, 54]);
    $templateId2 = $pdf->importPage(1);
    $pdf->useTemplate($templateId2, -35, -103.5, 277, 203);
    $pdf->Output($pdfOutput2, 'F');

    // Redirect to adcombine.php with the cropped file paths
    header("Location: adcombine.php?part1=" . urlencode($pdfOutput1) . "&part2=" . urlencode($pdfOutput2));
    exit;
} else {
    echo "No PDF specified.";
}

// echo "<h1>PDF Processed Successfully!</h1>";
//     echo "<p><a href='$pdfOutput1'>Download Cropped Part 1</a></p>";
//     echo "<p><a href='$pdfOutput2'>Download Cropped Part 2</a></p>";
// } else {
//     echo "No PDF to process.";
// }

?>
