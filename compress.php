<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileUrl = $_POST['fileUrl'];
    $fileName = $_POST['fileName'] . '.gz'; // Append .gz to the filename

    // Fetch the file content
    $fileContent = file_get_contents($fileUrl);

    if ($fileContent !== false) {
        // Compress the file content
        $compressedContent = gzencode($fileContent, 9); // 9 is the highest compression level

        // Set appropriate headers for compressed content
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . strlen($compressedContent));

        // Output the compressed content
        echo $compressedContent;
    } else {
        echo "Error fetching the file content.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Compression</title>
</head>
<body>
    <h2>File Compression</h2>
    <form action="" method="post">
        <label for="fileUrl">Enter File URL:</label><br>
        <input type="text" id="fileUrl" name="fileUrl" required><br><br>
        
        <label for="fileName">Enter Desired Filename:</label><br>
        <input type="text" id="fileName" name="fileName" required><br><br>
        
        <button type="submit">Compress and Download</button>
    </form>
</body>
</html>

