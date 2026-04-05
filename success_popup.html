<?php
$conn = mysqli_connect("localhost", "root", "geographypsu", "gisweb69");
mysqli_set_charset($conn,"utf8");
if (!$conn) { die("เน€เธเธทเนเธญเธกเธ•เนเธญเธเธฒเธเธเนเธญเธกเธนเธฅเธฅเนเธกเน€เธซเธฅเธง: " . mysqli_connect_error()); }

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $typeplace = $_POST['typeplace'];
    $ownplace = $_POST['ownplace'];

    if (!is_dir('images/')) { mkdir('images/', 0777, true); }

    // เธเธฑเธเธเนเธเธฑเธเธเธฑเธ”เธเธฒเธฃเธญเธฑเธเนเธซเธฅเธ” (เน€เธเนเธเธเธทเนเธญเน€เธ”เธดเธก + เน€เธฅเธเธชเธธเนเธกเธเนเธญเธเธเธฑเธเธเนเธณ)
    function uploadFileWithOriginalName($fileInput) {
        if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== 0) return null;

        $originalName = $_FILES[$fileInput]['name'];
        $fileTmp = $_FILES[$fileInput]['tmp_name'];
        
        // เนเธขเธเธเธทเนเธญเนเธเธฅเนเนเธฅเธฐเธเธฒเธกเธชเธเธธเธฅ
        $pathInfo = pathinfo($originalName);
        $filenameOnly = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        // เธเธฃเธญเธเธญเธฑเธเธเธฃเธฐเธเธดเน€เธจเธฉเธญเธญเธเธเธฒเธเธเธทเนเธญเนเธเธฅเนเน€เธ”เธดเธก (เน€เธเธทเนเธญเธเธงเธฒเธกเธเธฅเธญเธ”เธ เธฑเธขเธเธญเธเธฃเธฐเธเธเนเธเธฅเน)
        $cleanName = preg_replace("/[^a-zA-Z0-9เธ-เน_-]/u", "_", $filenameOnly);

        // เธ•เธฑเนเธเธเธทเนเธญเนเธซเธกเน: เธเธทเนเธญเน€เธ”เธดเธก_เน€เธงเธฅเธฒเธชเธฑเนเธเน.เธเธฒเธกเธชเธเธธเธฅ
        $newName = $cleanName . "_" . time() . "_" . rand(10, 99) . "." . $extension;
        $dest = "images/" . $newName;

        if (move_uploaded_file($fileTmp, $dest)) {
            return $newName;
        }
        return null;
    }

    $photoName = uploadFileWithOriginalName('photo');
    $docName = uploadFileWithOriginalName('filepdf2');

    // เธเธฑเธเธ—เธถเธเธฅเธเธเธฒเธเธเนเธญเธกเธนเธฅ
    $sql = "INSERT INTO trang_place (name, latitude, longitude, photo, descript, ownplace,  typeplace,  filepdf2) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $latitude, $longitude, $photoName, $description, $ownplace, $typeplace,  $docName);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จแล้ว!'); window.location='Read.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึก: " . mysqli_error($conn);
    }
}
?>