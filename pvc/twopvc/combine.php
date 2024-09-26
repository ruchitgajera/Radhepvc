<?php


use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php'; // Correct path for Composer autoload

$outputDir = 'twopvscombind/'; // Output directory for the combined PDFs

// Check if the output directory exists, if not, create it
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true); // Create the directory with appropriate permissions
}

// Define output files for each combined page
$pdfOutputPage1 = $outputDir . 'combined_page1.pdf';
$pdfOutputPage2 = $outputDir . 'combined_page2.pdf';

// A4 page dimensions in mm
$a4Width = 210;
$a4Height = 297;

// Padding values for each part
$paddingLeftTest1 = 10.5;   // Left padding for test/cropped_part1
$paddingTopTest1 = 38;    // Top padding for test/cropped_part1

$paddingLeftTest2 = 85;   // Left padding for test2/cropped_part1
$paddingTopTest2 = 38;     // Top padding for test2/cropped_part1

// Initialize FPDI for page 1
$pdfPage1 = new Fpdi();
$cropWidth = 55.5;  // Width of the cropped PDF
$cropHeight = 86; // Height of the cropped PDF

// First page: Combine parts from test and test2 for cropped_part1
$pdfPage1->AddPage('P', [$a4Width, $a4Height]);

// Array of cropped PDFs for the first page
$firstPageFiles = [
    'twopvctest/cropped_part1.pdf', 
    'twopvctest2/cropped_part3.pdf'
];

// Import the first part with different padding
foreach ($firstPageFiles as $index => $filePath) {
    if (!file_exists($filePath)) {
        echo "Error: File $filePath not found.";
        exit;
    }

    // Set the source file
    $pageCount = $pdfPage1->setSourceFile($filePath);
    
    // Calculate position with padding based on index
    $xPosition = $index === 0 ? $paddingLeftTest1 : $paddingLeftTest2;
    $yPosition = $index === 0 ? $paddingTopTest1 : $paddingTopTest2;

    // Import the cropped PDF
    for ($i = 1; $i <= $pageCount; $i++) {
        $templateId = $pdfPage1->importPage($i);
        $pdfPage1->useTemplate($templateId, $xPosition, $yPosition, $cropWidth, $cropHeight);
        
        // Update the padding for the next part
        if ($index === 0) {
            $paddingTopTest1 += $cropHeight + 10;
        } else {
            $paddingTopTest2 += $cropHeight + 10;
        }
    }
}

// Output the combined Page 1
$pdfPage1->Output($pdfOutputPage1, 'F');

// Initialize FPDI for page 2
$pdfPage2 = new Fpdi();
$pdfPage2->AddPage('P', [$a4Width, $a4Height]);

// Reset paddings for the second page
$paddingTopTest1 = 38;
$paddingTopTest2 = 38;

// Array of cropped PDFs for the second page
$secondPageFiles = [
    'twopvctest/cropped_part2.pdf', 
    'twopvctest2/cropped_part4.pdf'
];

// Import the second part with different padding
foreach ($secondPageFiles as $index => $filePath) {
    if (!file_exists($filePath)) {
        echo "Error: File $filePath not found.";
        exit;
    }

    // Set the source file
    $pageCount = $pdfPage2->setSourceFile($filePath);
    
    // Calculate position with padding based on index
    $xPosition = $index === 0 ? $paddingLeftTest1 : $paddingLeftTest2;
    $yPosition = $index === 0 ? $paddingTopTest1 : $paddingTopTest2;

    // Import the cropped PDF
    for ($i = 1; $i <= $pageCount; $i++) {
        $templateId = $pdfPage2->importPage($i);
        $pdfPage2->useTemplate($templateId, $xPosition, $yPosition, $cropWidth, $cropHeight);
        
        // Update the padding for the next part
        if ($index === 0) {
            $paddingTopTest1 += $cropHeight + 10;
        } else {
            $paddingTopTest2 += $cropHeight + 10;
        }
    }
}

// Output the combined Page 2
$pdfPage2->Output($pdfOutputPage2, 'F');

// HTML and JavaScript for print buttons
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Combined Pages</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function printPDF(page) {
            const printWindow = window.open(page);
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Combined PDFs are Ready</h1>
        
        <div class="text-center">
            <button class="btn btn-primary btn-lg mr-1" onclick="printPDF('<?php echo $pdfOutputPage1; ?>')">Print Combined Page 1</button>
            <button class="btn btn-success btn-lg" onclick="printPDF('<?php echo $pdfOutputPage2; ?>')">Print Combined Page 2</button>
        </div>
        <div class="text-center mt-3 mb-4">
            <!-- Adjusted redirect path -->
            <button class="btn btn-info btn-lg" onclick="window.location.href='../admindes/'">Home</button>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



