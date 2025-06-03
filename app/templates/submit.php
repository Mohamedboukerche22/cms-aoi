<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lang = $_POST['language'];
    $file = $_FILES['solution_file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "❌ File upload error!";
        exit;
    }
    $uploadDir = "submissions/";
    $filename = uniqid() . "_" . basename($file["name"]);
    $filepath = $uploadDir . $filename;

    if (!move_uploaded_file($file["tmp_name"], $filepath)) {
        echo "❌ Failed to save file!";
        exit;
    }
    if ($lang === "cpp") {
        $exec = "g++ $filepath -o $filepath.out && echo '5 7' | $filepath.out";
    } else if ($lang === "py") {
        $exec = "echo '5 7' | python3 $filepath";
    } else {
        echo "❌ Unsupported language!";
        exit;
    }
    $output = shell_exec($exec);
    $expected = "12";

    if (trim($output) === $expected) {
        echo "✅ Correct Answer!";
    } else {
        echo "❌ Wrong Answer. Output was: " . htmlspecialchars($output);
    }
}
?>
