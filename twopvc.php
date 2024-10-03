<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Bootstrap CDN -->

<head>
    <!-- Required meta tags -->

    <title>Upload PDF</title>
</head>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload PDF</h1>
        </div>
        <form action="tworotate.php" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow">
            <div class="form-group">
                <label for="pdf_file1" class="form-label">Upload the first PDF</label>
                <input type="file" name="pdf_file1" id="pdf_file1" class="form-control-file" required>
            </div>
            <div class="divider my-4" style="border-top: 1px solid #6e707e47;"></div>
            <div class="form-group">
                <label for="pdf_file2" class="form-label">Upload the second PDF</label>
                <input type="file" name="pdf_file2" id="pdf_file2" class="form-control-file">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Download</button>
            </div>
        </form>
    </div>

</body>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>