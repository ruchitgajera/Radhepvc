<?php
use setasign\Fpdi\Fpdi;

require 'vendor/autoload.php'; // Correct path for Composer autoload

$outputDir = 'test/';
$pdfOutputPart1 = $outputDir . 'part1.pdf';
$pdfOutputPart2 = $outputDir . 'part2.pdf';

// A4 page dimensions in mm
$a4Width = 210;
$a4Height = 297;

// Padding values
$paddingLeft = 10.5;  // Left padding
$paddingTop = 38;   // Top padding

// Fixed size for cropped PDFs
$cropWidth = 55.5;  // Width of the cropped PDF
$cropHeight = 86; // Height of the cropped PDF

// Create separate PDFs for each cropped part
foreach (['cropped_part1.pdf' => $pdfOutputPart1, 'cropped_part2.pdf' => $pdfOutputPart2] as $inputFile => $outputFile) {
    // Initialize FPDI for each PDF
    $pdf = new Fpdi();
    
    $filePath = $outputDir . $inputFile;
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

    // Output the individual PDF
    $pdf->Output($outputFile, 'F');
}

// HTML and JavaScript for print buttons
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDFs</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function printPDF(pdfFile) {
            const printWindow = window.open(pdfFile);
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Print Your PDFs</h1>
        <div class="text-center">
            <button class="btn btn-primary btn-lg mr-2" onclick="printPDF('<?php echo $pdfOutputPart1; ?>')">Print Part 1</button>
            <button class="btn btn-success btn-lg" onclick="printPDF('<?php echo $pdfOutputPart2; ?>')">Print Part 2</button>
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
