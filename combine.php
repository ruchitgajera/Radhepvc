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
$paddingTop = 39;     // Top padding

// Initialize FPDI
$pdf = new Fpdi();

// Fixed size for cropped PDFs
$cropWidth = 55;  // Width of the cropped PDF
$cropHeight = 86; // Height of the cropped PDF

// Add a new A4 page for each cropped PDF
foreach (['cropped_part1.pdf', 'cropped_part2.pdf'] as $file) {
    $filePath = $outputDir . $file;
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

// Output the combined PDF
$pdf->Output($pdfOutputCombined, 'F');

// Update download count
$countFile = 'download_count_onepvc.txt';

// Read current count
if (file_exists($countFile)) {
    $currentCount = (int)file_get_contents($countFile);
} else {
    $currentCount = 0; // Initialize if file does not exist
}

// Increment the count
$currentCount++;

// Write the updated count back to the file
file_put_contents($countFile, $currentCount);

// Open the PDF in a new tab
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"" . basename($pdfOutputCombined) . "\"");
header("Content-Length: " . filesize($pdfOutputCombined));

// Make sure to flush the output buffer before reading the file
ob_clean();
flush();
readfile($pdfOutputCombined);
?>
