<?php



use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pdf1'])) {
    $pdfFile = $_GET['pdf1'];
    $outputDir = 'twopvctest/';
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

    // Redirect to crop the second PDF
    header("Location: crop2.php?pdf2=" . urlencode($_GET['pdf2']));
    exit;
} else {
    echo "No file specified.";
}
?>
