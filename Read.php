<?php
$conn = mysqli_connect("localhost", "root", "geographypsu", "gisweb69");
mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM trang_place ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// เก็บข้อมูลไว้ใช้สร้าง marker
$data = [];
mysqli_data_seek($result,0);
while($r = mysqli_fetch_assoc($result)){
    $data[] = $r;
}
mysqli_data_seek($result,0);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แสดงรายการข้อมูล</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
#map{
height:450px;
width:100%;
border-radius:12px;
margin-bottom:25px;
box-shadow:0 6px 15px rgba(0,0,0,0.15);
}
.table-hover tbody tr:hover{
cursor:pointer;
background:#f5f9ff;
}
</style>

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>ตารางรายการสถานที่ท่องเที่ยวเชิงวัฒนธรรม</h4>
<a href="Create.php" class="btn btn-primary">ย้อนไปเพิ่มข้อมูลอีกครั้ง</a>
</div>

<div id="map"></div>

<div class="table-responsive bg-white p-3 shadow-sm rounded">
<table class="table table-hover align-middle">

<thead class="table-dark">
<tr>
<th>ลำดับ</th>
<th>ชื่อสถานที่ท่องเที่ยว</th>
<th>สาระสังเขป</th>
<th>พิกัดภูมิศาสาตร์ (Lat, Lng)</th>
<th>ประเภทสถานที่ท่องเที่ยว<br>ผู้รับผิดชอบสถานที่</th>
<th>ไฟล์เอกสาร</th>
<th>ปรับปรุงข้อมูล</th>
<th>การจัดการ</th>
</tr>
</thead>

<tbody>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr onclick="zoomMap(<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>)">
<td>
<?php if($row['photo']) { ?>
<img src="images/<?php echo $row['photo']; ?>" width="80" class="rounded">
<?php } ?>
</td>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['descript']; ?></td>
<td><small><?php echo $row['latitude']; ?>,<br><?php echo $row['longitude']; ?></small></td>

<td>
<span class="badge bg-info text-dark"><?php echo $row['typeplace']; ?></span><br>
<small class="text-muted"><?php echo $row['ownplace']; ?></small>
</td>

<td>
<?php if($row['filepdf2']) { ?>
<a href="images/<?php echo $row['filepdf2']; ?>" target="_blank" class="btn btn-sm btn-outline-secondary">เปิดแฟ้ม</a>
<?php } else { echo "-"; } ?>
</td>

<td>
<a href="Update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">แก้ไข/ปรับปรุงข้อมูล</a>
</td>

<td>
<a href="delete.php?id=<?php echo $row['id']; ?>" 
class="btn btn-danger btn-sm" 
onclick="return confirm('ลบข้อมูล');">ลบข้อมูล</a>
</td>

</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>

<script>

let map;

function initMap(){

map = new google.maps.Map(document.getElementById("map"),{
zoom:7,
center:{lat:7.5,lng:100},
mapTypeControl:true
});

let locations = <?php echo json_encode($data); ?>;

locations.forEach(loc=>{

let marker = new google.maps.Marker({
position:{
lat:parseFloat(loc.latitude),
lng:parseFloat(loc.longitude)
},
map:map,
title:loc.name
});

let info = new google.maps.InfoWindow({
content:`
<div style="width:200px">
<h6>${loc.name}</h6>
<img src="images/${loc.photo}" width="100%">
<p>${loc.descript}</p>
</div>
`
});

marker.addListener("click",()=>{
info.open(map,marker);
});

});

}

function zoomMap(lat,lng){
map.setCenter({lat:parseFloat(lat),lng:parseFloat(lng)});
map.setZoom(14);
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5l0aPyGFqiqY5DpqOYf-8YhN_eYHHobU&callback=initMap" async defer></script>

</body>
</html>