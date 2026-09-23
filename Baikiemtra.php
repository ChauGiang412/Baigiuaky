<?php
// Câu 1:
echo "Câu 1:<br>";
echo "Kết quả in ra màn hình là:<br>";
echo "Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 9 )";

// Câu 2:  
echo "<br><br>Câu 2:<br>";
echo "Chọn A: True";

// Câu 3:
echo "<br><br>Câu 3:<br>";
echo "Chọn a: array()";

// Câu 4:
echo "<br><br>Câu 4:<br>";
echo "Chọn a: readfile()";

// Câu 5:
echo "<br><br>Câu 5:<br>";
echo "Chọn b: Chuyển đổi một đối tượng thành một chuỗi";

// Bài thực hành 1:
echo "<br><br>Bài thực hành 1:<br>";
function generateFibonacci($n) {
    $fibonacci = [];
    if ($n <= 0) {
        return $fibonacci;
    }
    // Phần tử đầu tiên
    $fibonacci[] = 0;
    if ($n == 1) {
        return $fibonacci;
    }
    // Phần tử thứ hai
    $fibonacci[] = 1;
    // Tính các phần tử tiếp theo từ vị trí thứ 3 trở đi
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    return $fibonacci;
}
$n = 10;
$result = generateFibonacci($n);
echo "Dãy $n số Fibonacci đầu tiên là: " . implode(", ", $result);


// Bài thực hành 2:
echo "<br><br>Bài thực hành 2:<br>";
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "quanly_hocsinh";

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");

    $sql = "CREATE TABLE IF NOT EXISTS hoc_sinh (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        grade FLOAT NOT NULL
    )";
    $pdo->exec($sql);

    $stmt = $pdo->query("SELECT COUNT(*) FROM hoc_sinh");
    if ($stmt->fetchColumn() == 0) {
        $insertSql = "INSERT INTO hoc_sinh (name, age, grade) VALUES
            ('Nguyễn Văn A', 18, 8.5),
            ('Trần Thị B', 18, 9.2),
            ('Lê Văn C', 19, 7.8),
            ('Phạm Thị D', 18, 9.5)";
        $pdo->exec($insertSql);
    }

    echo "<h3>Danh sách học sinh (lấy từ Database):</h3>";
    $stmt = $pdo->query("SELECT * FROM hoc_sinh");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($students as $student) {
        echo "ID: " . $student['id'] . " - Tên: " . $student['name'] . " - Tuổi: " . $student['age'] . " - Điểm: " . $student['grade'] . "<br>";
    }

    $topStmt = $pdo->query("SELECT * FROM hoc_sinh ORDER BY grade DESC LIMIT 1");
    $topStudent = $topStmt->fetch(PDO::FETCH_ASSOC);

    echo "<h3>Học sinh có điểm cao nhất:</h3>";
    if ($topStudent) {
        echo "Tên: " . $topStudent['name'] . " - Điểm: " . $topStudent['grade'];
    }

} catch (PDOException $e) {
    echo "Lỗi CSDL: " . $e->getMessage();
}
?>