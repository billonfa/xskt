
<?php
function laydataxsmb() {
    include 'simple_html_dom.php';
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
        $html = file_get_html('https://www.minhngoc.net.vn/xo-so-mien-bac.html');
        $kqxs = $html->find('#bangkqxsmien .bkqmiennam', 0);
        $data['name_dai'] = "Bac";
        $data['gdb'] = trim($kqxs->find('.giaidb', 0)->plaintext);
        $data['g1'] = trim($kqxs->find('.giai1', 0)->plaintext);

        $giai2 = trim($kqxs->find('.giai2', 0)->plaintext);
        $data['g2'][0] = substr($giai2, 0, 5);
        $data['g2'][1] = substr($giai2, 5);
        $data['g2'] = json_encode($data['g2']);

        $giai3 = trim($kqxs->find('.giai3', 0)->plaintext);
        $data['g3'][0] = substr($giai3, 0, 5);
        $data['g3'][1] = substr($giai3, 5, 5);
        $data['g3'][2] = substr($giai3, 10, 5);
        $data['g3'][3] = substr($giai3, 15, 5);
        $data['g3'][4] = substr($giai3, 20, 5);
        $data['g3'][5] = substr($giai3, 25);
        $data['g3'] = json_encode($data['g3']);

        $giai4 = trim($kqxs->find('.giai4', 0)->plaintext);
        $data['g4'][0] = substr($giai4, 0, 4);
        $data['g4'][1] = substr($giai4, 4, 4);
        $data['g4'][2] = substr($giai4, 8, 4);
        $data['g4'][3] = substr($giai4, 12);
        $data['g4'] = json_encode($data['g4']);

        $giai5 = trim($kqxs->find('.giai5', 0)->plaintext);
        $data['g5'][0] = substr($giai5, 0, 4);
        $data['g5'][1] = substr($giai5, 4, 4);
        $data['g5'][2] = substr($giai5, 8, 4);
        $data['g5'][3] = substr($giai5, 12, 4);
        $data['g5'][4] = substr($giai5, 16, 4);
        $data['g5'][5] = substr($giai5, 20);
        $data['g5'] = json_encode($data['g5']);

        $giai6 = trim($kqxs->find('.giai6', 0)->plaintext);
        $data['g6'][0] = substr($giai6, 0, 3);
        $data['g6'][1] = substr($giai6, 3, 3);
        $data['g6'][2] = substr($giai6, 6);
        $data['g6'] = json_encode($data['g6']);

        $giai7 = trim($kqxs->find('.giai7', 0)->plaintext);
        $data['g7'][0] = substr($giai7, 0, 2);
        $data['g7'][1] = substr($giai7, 2, 2);
        $data['g7'][2] = substr($giai7, 4, 2);
        $data['g7'][3] = substr($giai7, 6);
        $data['g7'] = json_encode($data['g7']);
        $data['mien'] = 1;
        
        $name_dai = $data['name_dai'];
        $gdb = $data['gdb'];
        $g1 = $data['g1'];
        $g2 = $data['g2'];
        $g3 = $data['g3'];
        $g4 = $data['g4'];
        $g5 = $data['g5'];
        $g6 = $data['g6'];
        $g7 = $data['g7'];
        $mien = $data['mien'];
        $created_at = date("Y-m-d");
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // đặt chế độ lỗi PDO thành ngoại lệ
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // bắt đầu giao dịch
            $conn->beginTransaction();
            // câu lệnh SQL của chúng tôi
            $conn->exec("INSERT INTO data_xskt_mb (name_dai, g7, g6, g5, g4, g3, g2, g1, gdb, mien, created_at) VALUES ('$name_dai', '$g7', '$g6', '$g5', '$g4', '$g3', '$g2', '$g1', '$gdb' , '$mien', '$created_at')");
            // cam kết giao dịch
            $conn->commit();
            echo " Lấy kết quả xổ số miền bắc thành công";
        } catch(PDOException $e) {
            // quay trở lại giao dịch nếu điều gì đó không thành công
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
}
?>