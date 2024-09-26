<?php


use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pdf'])) {
    $pdfFile = $_GET['pdf'];
    $outputDir = 'test/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $pdfOutput1 = $outputDir . 'cropped_part1.pdf';
    $pdfOutput2 = $outputDir . 'cropped_part2.pdf';
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile($pdfFile);

    // Crop first part
    $pdf->AddPage('P', [86, 54]);
    $templateId1 = $pdf->importPage(1);
    $pdf->useTemplate($templateId1, -19, -31, 107, 247);
    $pdf->Output($pdfOutput1, 'F');

    // Crop second part
    $pdf = new Fpdi();
    $pdf->setSourceFile($pdfFile);
    $pdf->AddPage('P', [86, 54]);
    $templateId2 = $pdf->importPage(1);
    $pdf->useTemplate($templateId2, -19, -131, 107, 247);
    $pdf->Output($pdfOutput2, 'F');

    header("Location: combine.php");
    exit;
} else {
    echo "No file specified.";
}
// echo "<h1>PDF Processed Successfully!</h1>";
//     echo "<p><a href='$pdfOutput1'>Download Cropped Part 1</a></p>";
//     echo "<p><a href='$pdfOutput2'>Download Cropped Part 2</a></p>";
// } else {
//     echo "No PDF to process.";
// }

?>
