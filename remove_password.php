<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
        // Define the temporary directories
        $tempDir = 'temp';
        $uploadDir = $tempDir . '/uploads'; // Directory for uploaded files
        $outputDir = $tempDir . '/output';  // Directory for output files

        // Create directories if they don't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create uploads directory
        }
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true); // Create output directory
        }

        // Get the uploaded file and password
        $uploadedFile = $_FILES['pdf_file']['tmp_name'];
        $password = $_POST['pdf_password'];

        // Set the output file path for the unlocked PDF
        $unlockedFile = $outputDir . '/unlocked_' . basename($_FILES['pdf_file']['name']); // Correctly define unlocked file

        // Command to remove the password
        // $command = "pdftk " . escapeshellarg($uploadedFile) . " input_pw " . escapeshellarg($password) . " output " . escapeshellarg($outputFile) . " allow AllFeatures";
        $command = '"C:\Program Files (x86)\PDFtk Server\bin\pdftk.exe" ' . escapeshellarg($uploadedFile) . ' input_pw ' . escapeshellarg($password) . ' output ' . escapeshellarg($unlockedFile) . ' allow AllFeatures';

        // Execute the command
        exec($command . ' 2>&1', $output, $returnVar);

        // Check if the command was successful
        if ($returnVar == 0) {
            // Redirect to rotate.php to rotate the unlocked PDF
            header("Location: adrotate.php?pdf=" . urlencode($unlockedFile)); // Use the correct unlocked file variable
            exit;
        } else {
            echo "Error removing password: " . implode("<br>", $output);
        }
    } else {
        echo "File upload error.";
    }
}
?>
