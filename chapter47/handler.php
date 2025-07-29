<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fileName']) && $_FILES['fileName']['error'] === UPLOAD_ERR_OK) {
        $originalName = $_FILES['fileName']['name'];
        $tempFilePath = $_FILES['fileName']['tmp_name'];
        
        $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        
        $newFileName = 'test_vdita_file.' . $fileExtension;
        
        $destinationPath = __DIR__ . '/' . $newFileName;
        
        if (move_uploaded_file($tempFilePath, $destinationPath)) {
            echo "Файл успешно загружен и сохранён как: " . htmlspecialchars($newFileName);
        } else {
            echo "Ошибка при сохранении файла.";
        }
    } else {
        echo "Ошибка при загрузке файла";
    }
} else {
    echo "Неверный метод запроса";
}