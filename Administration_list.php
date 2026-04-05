<?php
require_once('conpolitic.php'); // ต้องมีตัวแปร $conn

$conn->set_charset("utf8mb4");

// ดึงจังหวัด
$sql = "SELECT PROVINCE_ID, PROVINCE_NAME FROM province ORDER BY PROVINCE_NAME ASC";
$result = $conn->query($sql);

// บันทึกข้อมูลเมื่อ submit
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // 1. รับค่าและบังคับแปลงเป็นตัวเลข (Integer) ด้วย (int)
    $province = isset($_POST['txprov2']) ? (int)$_POST['txprov2'] : 0;
    $amphur   = isset($_POST['txAMP'])   ? (int)$_POST['txAMP']   : 0;
    $tambol   = isset($_POST['txtambol'])? (int)$_POST['txtambol']: 0;

    // ตรวจสอบว่ามีค่ามากกว่า 0 (แสดงว่าเลือกแล้วจริงๆ)
    if($province > 0 && $amphur > 0 && $tambol > 0){
        
        $sql_insert = "INSERT INTO address (province_id, amphur_id, tambol_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        
        // 2. เช็คว่าการ Prepare SQL สำเร็จหรือไม่ (สำคัญมาก!)
        if ($stmt === false) {
            // ถ้ามี Error จะได้รู้ว่าพิมพ์ชื่อตารางหรือคอลัมน์ผิดตรงไหน
            die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error); 
        }

        // 3. ผูกตัวแปร (ตอนนี้ข้อมูลเป็น Integer ตรงกับ "iii" แล้ว)
        $stmt->bind_param("iii", $province, $amphur, $tambol);
        
        // 4. สั่งรันและเช็คผลลัพธ์
        if ($stmt->execute()) {
            $msg = "บันทึกข้อมูลเรียบร้อยแล้ว";
        } else {
            $msg = "เกิดข้อผิดพลาดในการบันทึก: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $msg = "กรุณาเลือกจังหวัด อำเภอ และตำบลให้ครบ";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>เลือกที่อยู่</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>


@import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');

body {
    font-family: 'Sarabun', sans-serif;
    height: 100vh;
    background:
        linear-gradient(rgba(10,25,40,0.75), rgba(10,25,40,0.75)),
        url('https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1600&q=80')
        no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

/* MAP GRID OVERLAY */
body::after{
    content:'';
    position:absolute;
    width:100%;
    height:100%;
    background-image:
        linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
    background-size:40px 40px;
    pointer-events:none;
}

.card {
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(8px);
    padding: 45px;
    border-radius: 20px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.45);
    width: 650px;
    max-width: 92%;
    border-top:6px solid #2c7a7b;
}

.card h3 {
    text-align: center;
    margin-bottom: 35px;
    font-weight: 600;
    color: #123;
    letter-spacing:1px;
}

.card h3::before{
    content:"🧭 ";
}

.form-group label {
    font-weight: 600;
    color: #234;
    letter-spacing:.5px;
}

select.form-control {
    border-radius: 10px;
    height: 48px;
    font-size: 16px;
    border:1px solid #cfd8dc;
    transition:.3s;
}

select.form-control:focus{
    border-color:#2c7a7b;
    box-shadow:0 0 8px rgba(44,122,123,0.35);
}

button.btn {
    height: 52px;
    font-size: 18px;
    border-radius: 10px;
    background: linear-gradient(90deg,#2c7a7b,#285e61);
    border:none;
    letter-spacing:1px;
    transition:.3s;
}

button.btn:hover{
    transform: translateY(-2px);
    box-shadow:0 12px 20px rgba(0,0,0,.25);
}

.alert{
    border-radius:10px;
    font-size:15px;
}


</style>
<script>
$(document).ready(function(){
    // จังหวัด → อำเภอ
    $("#txprov2").change(function(){
        var provA = $(this).val();
        if(provA === ""){
            $("#txAMP").html('<option value=""><< เลือกอำเภอ >></option>').prop("disabled", true);
            $("#txtambol").html('<option value=""><< เลือกตำบล >></option>').prop("disabled", true);
            return;
        }
        $.get("province2amp.php",{provid:provA},function(data){
            $("#txAMP").html(data).prop("disabled", false);
            $("#txtambol").html('<option value=""><< เลือกตำบล >></option>').prop("disabled", true);
        });
    });

    // อำเภอ → ตำบล
    $("#txAMP").change(function(){
        var AmphurA = $(this).val();
        if(AmphurA === ""){
            $("#txtambol").html('<option value=""><< เลือกตำบล >></option>').prop("disabled", true);
            return;
        }
        $.get("amp2tanbol.php",{ampid:AmphurA},function(data){
            $("#txtambol").html(data).prop("disabled", false);
        });
    });
});
</script>
</head>
<body>
<div class="card">
    <h3>กรอกข้อมูลที่อยู่</h3>
    <?php if(isset($msg)) echo '<div class="alert alert-info">'.$msg.'</div>'; ?>
    <form method="post">
        <div class="form-group">
            <label for="txprov2">จังหวัด</label>
            <select name="txprov2" id="txprov2" class="form-control">
                <option value=""><< เลือกจังหวัด >></option>
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?= $row['PROVINCE_ID']; ?>"><?= htmlspecialchars($row['PROVINCE_NAME'], ENT_QUOTES, 'UTF-8'); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="txAMP">อำเภอ</label>
            <select name="txAMP" id="txAMP" class="form-control" disabled>
                <option value=""><< เลือกอำเภอ >></option>
            </select>
        </div>
        <div class="form-group">
            <label for="txtambol">ตำบล</label>
            <select name="txtambol" id="txtambol" class="form-control" disabled>
                <option value=""><< เลือกตำบล >></option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">บันทึกข้อมูล</button>
    </form>
</div>
</body>
</html>