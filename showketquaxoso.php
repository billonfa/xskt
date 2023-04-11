<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill-xskt-app";
// tạo connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// kiểm tra connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_xsmb = "SELECT * FROM data_xskt_mb ORDER BY id";
$result = $conn->query($sql_xsmb);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["name_dai"]. " " . $row["gdb"]. "<br>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="asset/style.css">
</head>
<body>
  
  <button id="btn1">Get XSMB Data</button>
  <button id="btn2">Get XSMT Data</button>
  <button id="btn3">Get XSMN Data</button>

  <table id="myTable">
  </table>

</body>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
  $(document).ready(function() {
    const btn1 = document.querySelector('#btn1');
    const btn2 = document.querySelector('#btn2');
    const btn3 = document.querySelector('#btn3');
    const table = document.querySelector('#myTable');
    btn1.addEventListener('click', () => {
      table.innerHTML = '<thead></thead><tbody></tbody>';
      $.ajax({
      url: 'get_data_xsmb.php', // Đường dẫn đến file PHP xử lý lấy dữ liệu
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $.each(data, function(index, value) {
          let g2 = JSON.parse(value.g2);
          let g3 = JSON.parse(value.g3);
          let g4 = JSON.parse(value.g4);
          let g5 = JSON.parse(value.g5);
          let g6 = JSON.parse(value.g6);
          let g7 = JSON.parse(value.g7);
          const created_at = value.created_at;
          const date = new Date(created_at);
          const day = date.getDate().toString().padStart(2, '0');
          const month = (date.getMonth() + 1).toString().padStart(2, '0');
          const year = date.getFullYear().toString();
          const formatted_date = `${day}-${month}-${year}`;
          var row_header = '<th class="header_table" colspan = "4"> Kết quả xổ số miền Bắc - Ngày '+ formatted_date +'</th>'
          $('#myTable thead').append(row_header);
          var row =   '<tr>' +
                        '<td>Giải ĐB</td>' +
                        '<td colspan ="3">' + value.gdb + '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải nhất</td>' +
                        '<td colspan ="3">' + value.g1 + '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải nhì</td>' +
                          '<td colspan="3">'+ 
                            '<div class="giai2_mb">'+ g2[0] +'</div>' +
                            '<div class="giai2_mb">'+ g2[1] +'</div>' +
                          '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải ba</td>' +
                        '<td colspan="3">'+ 
                            '<div class="giai3_mb">'+ g3[0] +'</div>' +
                            '<div class="giai3_mb">'+ g3[1] +'</div>' +
                            '<div class="giai3_mb">'+ g3[2] +'</div>' +
                            '<div class="giai3_mb">'+ g3[3] +'</div>' +
                            '<div class="giai3_mb">'+ g3[4] +'</div>' +
                            '<div class="giai3_mb">'+ g3[5] +'</div>' +
                        '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải tư</td>' +
                        '<td colspan="3">'+ 
                          '<div class="giai2_mb">'+ g4[0] +'</div>' +
                          '<div class="giai2_mb">'+ g4[1] +'</div>' +
                          '<div class="giai2_mb">'+ g4[2] +'</div>' +
                          '<div class="giai2_mb">'+ g4[3] +'</div>' +
                        '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải Năm</td>' +
                        '<td colspan="3">'+ 
                            '<div class="giai3_mb">'+ g5[0] +'</div>' +
                            '<div class="giai3_mb">'+ g5[1] +'</div>' +
                            '<div class="giai3_mb">'+ g5[2] +'</div>' +
                            '<div class="giai3_mb">'+ g5[3] +'</div>' +
                            '<div class="giai3_mb">'+ g5[4] +'</div>' +
                            '<div class="giai3_mb">'+ g5[5] +'</div>' +
                        '</td>' +
                      '</tr>' +
                      '<tr>' +
                        '<td>Giải Sáu</td>' +
                        '<td>'+ g6[0] +'</td>' +
                        '<td>'+ g6[1] +'</td>' +
                        '<td>'+ g6[2] +'</td>' +
                      '</tr>' +
                      '</tr>' +
                        '<td>Giải Bảy</td>' +
                        '<td colspan="3">'+ 
                          '<div class="giai7_mb">'+ g7[0] +'</div>' +
                          '<div class="giai7_mb">'+ g7[1] +'</div>' +
                          '<div class="giai7_mb">'+ g7[2] +'</div>' +
                          '<div class="giai7_mb">'+ g7[3] +'</div>' +
                        '</td>' +
                      '</tr>' ;
          $('#myTable tbody').append(row);
          });
        }
      });
    });

    btn2.addEventListener('click', () => {
      table.innerHTML = 
        '<thead>' +
        '</thead>'+
        '<tbody>' +
        '</tbody>';
      $.ajax({
      url: 'get_data_xsmt.php', // Đường dẫn đến file PHP xử lý lấy dữ liệu
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        const created_at = data[0].created_at;
        const date = new Date(created_at);
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear().toString();
        const formatted_date = `${day}-${month}-${year}`;
        var row_header = '<th class="header_table" colspan = "4"> Kết quả xổ số miền Trung - Ngày '+ formatted_date +'</th>'
        $('#myTable thead').append(row_header);

        var col2Data = ["Dữ liệu cột 2 hàng 1", "Dữ liệu cột 2 hàng 2", "Dữ liệu cột 2 hàng 3", "Dữ liệu cột 2 hàng 4", "Dữ liệu cột 2 hàng 5", "Dữ liệu cột 2 hàng 6", "Dữ liệu cột 2 hàng 7", "Dữ liệu cột 2 hàng 8"];
        var col3Data = ["Dữ liệu cột 3 hàng 1", "Dữ liệu cột 3 hàng 2", "Dữ liệu cột 3 hàng 3", "Dữ liệu cột 3 hàng 4", "Dữ liệu cột 3 hàng 5", "Dữ liệu cột 3 hàng 6", "Dữ liệu cột 3 hàng 7", "Dữ liệu cột 3 hàng 8"];
        for (var i = 0; i < 10; i++) {
          // Tạo hàng mới
          var row = document.createElement("tr");

          // Tạo cột đầu tiên chứa số thứ tự
          var cell1 = document.createElement("td");
          switch(i) {
            case 0: {
              var giai = "Giải tám"
              break
            }
            case 1: {
              var giai = "Giải bảy"
              break
            }
            case 2: {
              var giai = "Giải sáu"
              break
            }
            case 3: {
              var giai = "Giải năm"
              break
            }
            case 4: {
              var giai = "Giải bốn"
              break
            }
            case 5: {
              var giai = "Giải ba"
              break
            }
            case 6: {
              var giai = "Giải nhì"
              break
            }
            case 7: {
              var giai = "Giải nhất"
              break
            }
            case 8: {
              var giai = "Giải ĐB"
              break
            }
          }
          console.log(data)

          cell1.innerHTML = giai;
          row.appendChild(cell1);

          $.each(data, function (index, value) {

            let keyArray = Object.values(value)
            keyArray[4] = JSON.parse(keyArray[4])
            keyArray[6] = JSON.parse(keyArray[6])
            keyArray[7] = JSON.parse(keyArray[7])
            keyArray[8] = JSON.parse(keyArray[8])

            const g8 = document.createElement("td");
            g8.innerHTML = keyArray[i + 2];
            row.appendChild(g8);
          })

          // Gắn hàng vào bảng
          table.appendChild(row);

          $('#myTable tbody').append(row);
        }
        }
      });
    });

   
  });
  </script>
</html>