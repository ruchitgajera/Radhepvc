<?php
use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php'; // Correct path for Composer autoload

$outputDir = 'test/';
$pdfOutputCombined = $outputDir . 'combined.pdf';

// A4 page dimensions in mm
$a4Width = 210;
$a4Height = 297;

// Padding values
$paddingLeft = 10.5;  // Left padding
$paddingTop = 39;   // Top padding

// Initialize FPDI
$pdf = new Fpdi();

// Fixed size for cropped PDFs
$cropWidth = 55;  // Width of the cropped PDF
$cropHeight = 86; // Height of the cropped PDF

// Check if the required parts are provided
if (isset($_GET['part1']) && isset($_GET['part2'])) {
    foreach ([urldecode($_GET['part1']), urldecode($_GET['part2'])] as $filePath) {
        if (file_exists($filePath)) {
            $pageCount = $pdf->setSourceFile($filePath);
            
            // Create an A4 page
            $pdf->AddPage('P', [$a4Width, $a4Height]);

            // Import the cropped PDF
            for ($i = 1; $i <= $pageCount; $i++) {
                $templateId = $pdf->importPage($i);
                
                // Calculate position with padding
                $xPosition = $paddingLeft;
                $yPosition = $paddingTop;

                // Use the template with fixed size
                $pdf->useTemplate($templateId, $xPosition, $yPosition, $cropWidth, $cropHeight);
            }
        }
    }

    // Output the combined PDF
    $pdf->Output($pdfOutputCombined, 'F');

    // Optional: Force download of the combined PDF
    header("Content-Disposition: attachment; filename=\"" . basename($pdfOutputCombined) . "\"");
    header("Content-Type: application/pdf");
    readfile($pdfOutputCombined);
    exit;
} else {
    echo "Required PDF parts not provided.";
}
?>
