<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<script>
    function autofillPassword() {
        // Get the file input element
        var fileInput = document.getElementById('pdf_file');
        // Get the password input element
        var passwordInput = document.getElementById('pdf_password');
        
        // Check if a file is selected
        if (fileInput.files.length > 0) {
            // Get the file name and remove the extension
            var fileNameWithExtension = fileInput.files[0].name;
            var fileNameWithoutExtension = fileNameWithExtension.substring(0, fileNameWithExtension.lastIndexOf('.'));
            // Set the password input to the file name without extension
            passwordInput.value = fileNameWithoutExtension;
        } else {
            // Clear the password input if no file is selected
            passwordInput.value = '';
        }
    }
</script>
</head>
<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload PDF</h1>
        </div>
        <form action="remove_password.php" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow">
            <div class="form-group">
                <label for="pdf_file">Select PDF</label>
                <input type="file" id="pdf_file" name="pdf_file" class="form-control-file" accept=".pdf" required onchange="autofillPassword()">
            </div>
            <div class="form-group">
                <label for="pdf_password">PDF Password</label>
                <input type="password" id="pdf_password" name="pdf_password" class="form-control" placeholder="Enter PDF Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Download</button>
        </form>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>
