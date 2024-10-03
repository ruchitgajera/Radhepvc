<?php

use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php'; // Ensure this path is correct for Composer autoload

// Define output file for the combined PDF
$pdfOutputCombined = 'combined.pdf'; // Temporary file name

// A4 page dimensions in mm
$a4Width = 210;
$a4Height = 297;

// Padding values for each part
$paddingLeftTest1 = 10.4;   // Left padding for cropped_part1
$paddingTopTest1 = 38;      // Top padding for cropped_part1

$paddingLeftTest2 = 85.2;     // Left padding for cropped_part2
$paddingTopTest2 = 38;      // Top padding for cropped_part2

// Initialize FPDI for the combined PDF
$pdfCombined = new Fpdi();

// Array of cropped PDFs to combine
$firstPageFiles = [
    'twopvctest/cropped_part1.pdf',  // Cropped part 1
    'twopvctest2/cropped_part3.pdf'  // Cropped part 3
];

$secondPageFiles = [
    'twopvctest/cropped_part2.pdf',  // Cropped part 2
    'twopvctest2/cropped_part4.pdf'  // Cropped part 4
];

// Create the first page of the combined PDF
$pdfCombined->AddPage('P', [$a4Width, $a4Height]);

// Import each PDF file for the first page
foreach ($firstPageFiles as $index => $filePath) {
    if (!file_exists($filePath)) {
        echo "Error: File $filePath not found.";
        exit;
    }

    // Set the source file
    $pageCount = $pdfCombined->setSourceFile($filePath);

    // Calculate position with padding based on index
    $xPosition = $index % 2 === 0 ? $paddingLeftTest1 : $paddingLeftTest2;
    $yPosition = $index % 2 === 0 ? $paddingTopTest1 : $paddingTopTest2;

    // Import and use the template for the first page's cropped parts
    for ($i = 1; $i <= $pageCount; $i++) {
        $templateId = $pdfCombined->importPage($i);
        $pdfCombined->useTemplate($templateId, $xPosition, $yPosition);
    }
}

// Create the second page of the combined PDF
$pdfCombined->AddPage('P', [$a4Width, $a4Height]);

// Import each PDF file for the second page
foreach ($secondPageFiles as $index => $filePath) {
    if (!file_exists($filePath)) {
        echo "Error: File $filePath not found.";
        exit;
    }

    // Set the source file
    $pageCount = $pdfCombined->setSourceFile($filePath);

    // Calculate position with padding based on index
    $xPosition = $index % 2 === 0 ? $paddingLeftTest1 : $paddingLeftTest2;
    $yPosition = $index % 2 === 0 ? $paddingTopTest1 : $paddingTopTest2;

    // Import and use the template for the second page's cropped parts
    for ($i = 1; $i <= $pageCount; $i++) {
        $templateId = $pdfCombined->importPage($i);
        $pdfCombined->useTemplate($templateId, $xPosition, $yPosition);
    }
}

// Update download count
$countFile = 'download_count_twopvc.txt';

// Read the current count from file
if (file_exists($countFile)) {
    $currentCount = (int)file_get_contents($countFile);
} else {
    $currentCount = 0; // Initialize if the file doesn't exist
}

// Increment the count
$currentCount++;

// Write the updated count back to the file
file_put_contents($countFile, $currentCount);

// Set headers to download the PDF file directly
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($pdfOutputCombined) . '"');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

// Output the combined PDF to the browser
$pdfCombined->Output('D', $pdfOutputCombined);
exit; // Terminate the script after download
?>
