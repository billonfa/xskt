<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill-xskt-app";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$date = getdate();
// $date = $date['year'] . "-" . $date['mon'] . "-" .$date['mday'];
// Lấy dữ liệu từ bảng users
$sql = "SELECT * FROM data_xskt_mt";
$result = $conn->query($sql);

// Tạo mảng chứa dữ liệu
$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($data, $row);
  }
}

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);

// Đóng kết nối
$conn->close();
?>
