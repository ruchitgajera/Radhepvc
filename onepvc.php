<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload PDF</h1>
        </div>
        <form action="rotate.php" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow" >
            <div class="form-group">
                <label for="pdf_file">Select PDF</label>
                <input type="file" name="pdf_file" class="form-control-file" id="pdf_file" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Download</button>
        </form>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>