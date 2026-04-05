<?php
if(isset($_GET['file'])){
    $file = basename($_GET['file']);
    $path = __DIR__ . "/" . $file;

    if(file_exists($path)){
        highlight_file($path);
    } else {
        echo "ไม่พบไฟล์";
    }
}
?>