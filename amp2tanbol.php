<?php
require_once('conpolitic.php');
header("Content-Type: text/html; charset=UTF-8");

if(isset($_GET['ampid']) && is_numeric($_GET['ampid'])){
    $ampID = intval($_GET['ampid']);
    $stmt = $conn->prepare("SELECT TAMBOL_CODE, TAMBOL_NAME FROM tambol WHERE AMPHUR_ID=? ORDER BY TAMBOL_NAME ASC");
    $stmt->bind_param("i",$ampID);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value=""><< เลือกตำบล >></option>';
    while($row = $result->fetch_assoc()){
        echo '<option value="'.htmlspecialchars($row['TAMBOL_CODE'], ENT_QUOTES, 'UTF-8').'">'
             . htmlspecialchars($row['TAMBOL_NAME'], ENT_QUOTES, 'UTF-8') . '</option>';
    }
    $stmt->close();
}
$conn->close();
?>