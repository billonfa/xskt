<?php
function laydataxsmn () {
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

    $html = file_get_html('https://www.minhngoc.net.vn/xo-so-mien-nam.html');
    $kqxs = $html->find('#bangkqxsmien .box_kqxs .content', 0);
    $namedai = $kqxs->find('.tinh');
    foreach ($namedai as $key_a => $value_namedai) {
        $data[$key_a]['name_dai'] = trim($value_namedai->plaintext);
    }
    $giai8 = $kqxs->find('.giai8');
    foreach($giai8 as $key_giai8 => $value_giai8) {
        if ($key_giai8 == 0) continue;
        $data[$key_giai8 - 1]['g8'] = trim($value_giai8->plaintext);
    }
    $giai7 = $kqxs->find('.giai7');
    foreach($giai7 as $key_giai7 => $value_giai7) {
        if ($key_giai7 == 0) continue;
        $data[$key_giai7 - 1]['g7'] = trim($value_giai7->plaintext);
    }
    $giai6 = $kqxs->find('.giai6');
    foreach($giai6 as $key_giai6 => $value_giai6) {
        if ($key_giai6 == 0) continue;
        $dtg6 = trim($value_giai6->plaintext);
        $data[$key_giai6 - 1]['g6'][0] = substr($dtg6, 0, 4);
        $data[$key_giai6 - 1]['g6'][1] = substr($dtg6, 4, 4);
        $data[$key_giai6 - 1]['g6'][2] = substr($dtg6, 8);
    }
    $giai5 = $kqxs->find('.giai5');
    foreach($giai5 as $key_giai5 => $value_giai5) {
        if ($key_giai5 == 0) continue;
        $data[$key_giai5 - 1]['g5'] = trim($value_giai5->plaintext);
    }
    $giai4 = $kqxs->find('.giai4');
    foreach($giai4 as $key_giai4 => $value_giai4) {
        if ($key_giai4 == 0) continue;
        $dtg4 = trim($value_giai4->plaintext);
        $data[$key_giai4 - 1]['g4'][0] = substr($dtg4, 0, 5);
        $data[$key_giai4 - 1]['g4'][1] = substr($dtg4, 5, 5);
        $data[$key_giai4 - 1]['g4'][2] = substr($dtg4, 10, 5);
        $data[$key_giai4 - 1]['g4'][3] = substr($dtg4, 15, 5);
        $data[$key_giai4 - 1]['g4'][4] = substr($dtg4, 20, 5);
        $data[$key_giai4 - 1]['g4'][5] = substr($dtg4, 25, 5);
        $data[$key_giai4 - 1]['g4'][6] = substr($dtg4, 30);
    }
    $giai3 = $kqxs->find('.giai3');
    foreach($giai3 as $key_giai3 => $value_giai3) {
        if ($key_giai3 == 0) continue;
        $dtg3 = trim($value_giai3->plaintext);
        $data[$key_giai3 - 1]['g3'][0] = substr($dtg3, 0, 5);
        $data[$key_giai3 - 1]['g3'][1] = substr($dtg3, 5, 5);
    }
    $giai2 = $kqxs->find('.giai2');
    foreach($giai2 as $key_giai2 => $value_giai2) {
        if ($key_giai2 == 0) continue;
        $data[$key_giai2 - 1]['g2'] = trim($value_giai2->plaintext);
    }
    $giai1 = $kqxs->find('.giai1');
    foreach($giai1 as $key_giai1 => $value_giai1) {
        if ($key_giai1 == 0) continue;
        $data[$key_giai1 - 1]['g1'] = trim($value_giai1->plaintext);
    }
    $giaidb = $kqxs->find('.giaidb');
    foreach($giaidb as $key_giaidb => $value_giaidb) {
        if ($key_giaidb == 0) continue;
        $data[$key_giaidb - 1]['gdb'] = trim($value_giaidb->plaintext);
    }
    foreach($data as $key_data => $value_data) {
        $data[$key_data]['g6'] = json_encode($data[$key_data]['g6']);
        $data[$key_data]['g4'] = json_encode($data[$key_data]['g4']);
        $data[$key_data]['g3'] = json_encode($data[$key_data]['g3']);
        $data[$key_data]['created_at'] = date("Y-m-d");
        $data[$key_data]['mien'] = 2;
        $name_dai = $data[$key_data]['name_dai'];
        $gdb = $data[$key_data]['gdb'];
        $g1 = $data[$key_data]['g1'];
        $g2 = $data[$key_data]['g2'];
        $g3 = $data[$key_data]['g3'];
        $g4 = $data[$key_data]['g4'];
        $g5 = $data[$key_data]['g5'];
        $g6 = $data[$key_data]['g6'];
        $g7 = $data[$key_data]['g7'];
        $g8 = $data[$key_data]['g8'];
        $mien = $data[$key_data]['mien'];
        $created_at = date("Y-m-d");
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // đặt chế độ lỗi PDO thành ngoại lệ
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // bắt đầu giao dịch
            $conn->beginTransaction();
            // câu lệnh SQL của chúng tôi
            $conn->exec("INSERT INTO data_xskt_mn (name_dai, g8, g7, g6, g5, g4, g3, g2, g1, gdb, mien, created_at) VALUES ('$name_dai', '$g8', '$g7', '$g6', '$g5', '$g4', '$g3', '$g2', '$g1', '$gdb' , '$mien', '$created_at')");
            // cam kết giao dịch
            $conn->commit();
            echo " Lấy kết quả xổ số miền trung thành công";
        } catch(PDOException $e) {
            // quay trở lại giao dịch nếu điều gì đó không thành công
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
?>