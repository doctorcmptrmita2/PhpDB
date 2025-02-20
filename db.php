<?php

class Database {
    private $host = "localhost"; // Sunucu
    private $dbname = "test_db"; // Veritabanı adı
    private $username = "root"; // Kullanıcı adı
    private $password = ""; // Şifre
    private $pdo;
    private $stmt;
    
    // Constructor: Veritabanına bağlan
    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Bağlantı hatası: " . $e->getMessage());
        }
    }

    // Veritabanına veri ekleme (CREATE)
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->stmt = $this->pdo->prepare($sql);
        return $this->stmt->execute($data);
    }

    // Tüm verileri veya belirli bir kaydı çekme (READ)
    public function select($table, $conditions = []) {
        $sql = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        }
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($conditions);
        return $this->stmt->fetchAll();
    }

    // Belirli bir veriyi güncelleme (UPDATE)
    public function update($table, $data, $conditions) {
        $updateFields = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $conditionFields = implode(" AND ", array_map(fn($key) => "$key = :cond_$key", array_keys($conditions)));

        $sql = "UPDATE $table SET $updateFields WHERE $conditionFields";
        $this->stmt = $this->pdo->prepare($sql);

        foreach ($conditions as $key => $value) {
            $data["cond_" . $key] = $value;
        }
        return $this->stmt->execute($data);
    }

    // Belirli bir veriyi silme (DELETE)
    public function delete($table, $conditions) {
        $conditionFields = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $sql = "DELETE FROM $table WHERE $conditionFields";
        $this->stmt = $this->pdo->prepare($sql);
        return $this->stmt->execute($conditions);
    }
}

?>
