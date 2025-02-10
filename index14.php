<?php
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    $folders = [
        'images' => ['jpg', 'jpeg', 'png', 'gif'],
        'videos' => ['mp4', 'avi', 'mov'],
        'documents' => ['pdf', 'docx', 'xls'],
        'audio' => ['mp3', 'wav'],
        'fonts' => ['ttf', 'otf']
    ];
    
    $target_folder = 'others';
    foreach ($folders as $folder => $extensions) {
        if (in_array($ext, $extensions)) {
            $target_folder = $folder;
            break;
        }
    }
    
    $filename = date('Y_m_d_H_i') . '.' . $ext;
    $target_path = "uploads/$target_folder/$filename";
    
    if (!is_dir("uploads/$target_folder")) {
        mkdir("uploads/$target_folder", 0777, true);
    }
    
    move_uploaded_file($file['tmp_name'], $target_path);
    echo "Файл загружен в $target_path";
} else {
    echo "Ошибка загрузки файла!";
}
?>
