<?php
require_once('conpolitic.php');
header("Content-Type: text/html; charset=UTF-8");

if(isset($_GET['provid']) && is_numeric($_GET['provid'])){
    $provID = intval($_GET['provid']);
    $stmt = $conn->prepare("SELECT AMPHUR_ID, AMPHUR_NAME FROM amphur WHERE PROVINCE_ID=? ORDER BY AMPHUR_NAME ASC");
    $stmt->bind_param("i",$provID);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value=""><< เลือกอำเภอ >></option>';
    while($row = $result->fetch_assoc()){
        echo '<option value="'.htmlspecialchars($row['AMPHUR_ID'], ENT_QUOTES, 'UTF-8').'">'
             . htmlspecialchars($row['AMPHUR_NAME'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
    $stmt->close();
}
$conn->close();
?>