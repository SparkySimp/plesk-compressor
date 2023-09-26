<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileUrl = $_POST['fileUrl'];
    $fileName = $_POST['fileName']; // Append .gz to the filename

    // Fetch the file content
    $fileContent = file_get_contents($fileUrl);

    if ($fileContent !== false) {
        // Deompress the file content
        $decompressedContent = gzdecode($fileContent, 9); // 9 is the highest compression level

        // Set appropriate headers for decompressed content
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . strlen($decompressedContent));

        // Output the decompressed content
        echo $decompressedContent;
    } else {
        echo "Error fetching the file content.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Decompression</title>
</head>
<body>
    <h2>File Decompression</h2>
    <form action="" method="post">
        <label for="fileUrl">Enter File URL:</label><br>
        <input type="text" id="fileUrl" name="fileUrl" required><br><br>
        
        <label for="fileName">Enter Desired Filename:</label><br>
        <input type="text" id="fileName" name="fileName" required><br><br>
        
        <button type="submit">Decompress and Download</button>
    </form>
</body>
</html>
