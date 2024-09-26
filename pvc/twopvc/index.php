



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Upload PDF</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="rotate.php" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow">
                    <div class="mb-3">
                        <label for="pdf_file1" class="form-label">Upload the first PDF</label>
                        <input type="file" name="pdf_file1" id="pdf_file1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdf_file2" class="form-label">Upload the second PDF</label>
                        <input type="file" name="pdf_file2" id="pdf_file2" class="form-control">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Upload and Process</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
