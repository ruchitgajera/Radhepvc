<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<script>
    function autofillPassword(fileInputId, passwordInputId) {
        var fileInput = document.getElementById(fileInputId);
        var passwordInput = document.getElementById(passwordInputId);
        
        if (fileInput.files.length > 0) {
            var fileNameWithExtension = fileInput.files[0].name;
            var fileNameWithoutExtension = fileNameWithExtension.substring(0, fileNameWithExtension.lastIndexOf('.'));
            passwordInput.value = fileNameWithoutExtension;
        } else {
            passwordInput.value = '';
        }
    }
</script>
</head>
<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload PDFs</h1>
        </div>
        <form action="remove_password2.php" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow">
            <!-- First PDF -->
            <div class="form-group mb-3">
                <label for="pdf_file1">Upload the first PDF</label>
                <input type="file" id="pdf_file1" name="pdf_file1" class="form-control-file" accept=".pdf" required onchange="autofillPassword('pdf_file1', 'pdf_password1')">
                <input type="password" id="pdf_password1" name="pdf_password1" class="form-control mt-2" placeholder="Enter PDF Password" required>
            </div>

            <!-- Second PDF -->
            <div class="form-group mb-3">
                <label for="pdf_file2">Upload the second PDF</label>
                <input type="file" id="pdf_file2" name="pdf_file2" class="form-control-file" accept=".pdf" required onchange="autofillPassword('pdf_file2', 'pdf_password2')">
                <input type="password" id="pdf_password2" name="pdf_password2" class="form-control mt-2" placeholder="Enter PDF Password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Remove Password</button>
        </form>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>
