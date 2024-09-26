<?php



use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pdf2'])) {
    $pdfFile = $_GET['pdf2'];
    $outputDir = 'twopvctest2/';

    // Create the output directory if it doesn't exist
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Define output file paths
    $pdfOutput1 = $outputDir . 'cropped_part3.pdf'; 
    $pdfOutput2 = $outputDir . 'cropped_part4.pdf';

    try {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfFile);

        // Crop first part
        $pdf->AddPage('P', [86, 54]);
        $templateId1 = $pdf->importPage(1);
        $pdf->useTemplate($templateId1, -19, -31, 107, 247);
        $pdf->Output($pdfOutput1, 'F');

        // Crop second part
        $pdf = new Fpdi(); // Create a new instance for the second part
        $pdf->setSourceFile($pdfFile);
        $pdf->AddPage('P', [86, 54]);
        $templateId2 = $pdf->importPage(1);
        $pdf->useTemplate($templateId2, -19, -131, 107, 247);
        $pdf->Output($pdfOutput2, 'F');

        // Redirect to combine the PDFs after cropping
        header("Location: combine.php?part1=$pdfOutput1&part2=$pdfOutput2");
        exit;
        
    } catch (Exception $e) {
        // Handle any errors that occur during PDF processing
        echo "An error occurred while processing the PDF: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "No file specified 2.";
}
?>
