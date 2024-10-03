<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if both files have been uploaded without errors
    if (isset($_FILES['pdf_file1']) && $_FILES['pdf_file1']['error'] == 0 &&
        isset($_FILES['pdf_file2']) && $_FILES['pdf_file2']['error'] == 0) {

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

        // Get the uploaded files and passwords
        $uploadedFile1 = $_FILES['pdf_file1']['tmp_name'];
        $password1 = $_POST['pdf_password1'];
        
        $uploadedFile2 = $_FILES['pdf_file2']['tmp_name'];
        $password2 = $_POST['pdf_password2'];

        // Set the output file paths for the unlocked PDFs
        $unlockedFile1 = $outputDir . '/unlocked_' . basename($_FILES['pdf_file1']['name']);
        $unlockedFile2 = $outputDir . '/unlocked_' . basename($_FILES['pdf_file2']['name']);

        // Command to remove the password for the first PDF
        // $command1 = "pdftk " . escapeshellarg($uploadedFile1) . " input_pw " . escapeshellarg($password1) . " output " . escapeshellarg($unlockedFile1) . " allow AllFeatures";
        $command1 = '"C:\Program Files (x86)\PDFtk Server\bin\pdftk.exe" ' . escapeshellarg($uploadedFile1) . ' input_pw ' . escapeshellarg($password1) . ' output ' . escapeshellarg($unlockedFile1) . ' allow AllFeatures';

        // Execute the command for the first PDF
        exec($command1 . ' 2>&1', $output1, $returnVar1);

        // Command to remove the password for the second PDF
        // $command2 = "pdftk " . escapeshellarg($uploadedFile2) . " input_pw " . escapeshellarg($password2) . " output " . escapeshellarg($unlockedFile2) . " allow AllFeatures";
        $command2 = '"C:\Program Files (x86)\PDFtk Server\bin\pdftk.exe" ' . escapeshellarg($uploadedFile2) . ' input_pw ' . escapeshellarg($password2) . ' output ' . escapeshellarg($unlockedFile2) . ' allow AllFeatures';

        // Execute the command for the second PDF
        exec($command2 . ' 2>&1', $output2, $returnVar2);

        // Check if both commands were successful
        if ($returnVar1 == 0 && $returnVar2 == 0) {
            // Redirect to adrotate.php to process the unlocked PDFs
            header("Location: adrotate2.php?pdf1=" . urlencode($unlockedFile1) . "&pdf2=" . urlencode($unlockedFile2));
            exit;
        } else {
            // Display errors if any command failed
            echo "Error removing password from first PDF: " . implode("<br>", $output1);
            echo "<br>";
            echo "Error removing password from second PDF: " . implode("<br>", $output2);
        }
    } else {
        echo "File upload error.";
    }
}
?>
