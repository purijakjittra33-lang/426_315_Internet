<?php
// เน€เธเธทเนเธญเธกเธ•เนเธญเธเธฒเธเธเนเธญเธกเธนเธฅ
$conn = mysqli_connect("localhost", "root", "geographypsu", "gisweb69");
mysqli_set_charset($conn,"utf8");
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // เธเนเธญเธเธเธฑเธ SQL Injection เน€เธเธทเนเธญเธเธ•เนเธเธ”เนเธงเธขเธเธฒเธฃเนเธเธฅเธเน€เธเนเธเน€เธฅเธเธเธณเธเธงเธเน€เธ•เนเธก

    // 1. เธ”เธถเธเธเธทเนเธญเนเธเธฅเนเธเธฒเธเธเธฒเธเธเนเธญเธกเธนเธฅเน€เธเธทเนเธญเธเธณเนเธเธฅเธเนเธเธฅเนเนเธเนเธเธฅเน€เธ”เธญเธฃเน
    $query = "SELECT photo, filepdf2 FROM trang_place WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        // เธฅเธเนเธเธฅเนเธฃเธนเธเธ เธฒเธ
        if (!empty($data['photo'])) {
            $photoPath = "images/" . $data['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath); // เธเธณเธชเธฑเนเธเธฅเธเนเธเธฅเนเธเธฃเธดเธ
            }
        }

        // เธฅเธเนเธเธฅเนเน€เธญเธเธชเธฒเธฃ
        if (!empty($data['filepdf2'])) {
            $filePath = "images/" . $data['filepdf2'];
            if (file_exists($filePath)) {
                unlink($filePath); // เธเธณเธชเธฑเนเธเธฅเธเนเธเธฅเนเธเธฃเธดเธ
            }
        }

        // 2. เธฅเธเธเนเธญเธกเธนเธฅเธญเธญเธเธเธฒเธเธเธฒเธเธเนเธญเธกเธนเธฅ
        $sql_delete = "DELETE FROM trang_place WHERE id = $id";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>
                    alert('ยืนยันการลบข้อมูล');
                    window.location='Read.php';
                  </script>";
        } else {
            echo "เน€เธเธดเธ”เธเนเธญเธเธดเธ”เธเธฅเธฒเธ”เนเธเธเธฒเธฃเธฅเธเธเนเธญเธกเธนเธฅ: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('เนเธกเนเธเธเธเนเธญเธกเธนเธฅเธ—เธตเนเธ•เนเธญเธเธเธฒเธฃเธฅเธ'); window.location='Read.php';</script>";
    }
} else {
    header("Location: Read.php");
}

mysqli_close($conn);
?>
