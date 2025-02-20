PHP Database Class

Bu proje, PHP ile güvenli ve esnek bir veritabanı bağlantısı sağlayan bir Database Class içerir. Sınıf, CRUD (Create, Read, Update, Delete) işlemlerini güvenli bir şekilde gerçekleştirir ve SQL Injection saldırılarına karşı koruma sağlar.

🚀 Özellikler

Güvenli PDO bağlantısı (Prepared Statements ile SQL Injection koruması)

Veri ekleme (INSERT)

Veri okuma (SELECT)

Veri güncelleme (UPDATE)

Veri silme (DELETE)

UTF-8 desteği (Türkçe karakterler için utf8mb4 kullanılmıştır)

📌 Kullanım

1️⃣ Veritabanına Bağlanma

Öncelikle db.php dosyanızı projeye dahil edin ve Database sınıfını başlatın:

require_once "db.php";
$db = new Database();

2️⃣ Yeni Veri Ekleme (INSERT)

$data = [
    'name' => 'Ahmet',
    'email' => 'ahmet@example.com',
    'age' => 30
];
$db->insert("users", $data);

3️⃣ Veri Okuma (SELECT)

Tüm kullanıcıları getir:

$users = $db->select("users");
print_r($users);

Belirli bir kullanıcıyı getir:

$user = $db->select("users", ['id' => 1]);
print_r($user);

4️⃣ Veri Güncelleme (UPDATE)

$updateData = ['name' => 'Mehmet', 'age' => 32];
$conditions = ['id' => 1];
$db->update("users", $updateData, $conditions);

5️⃣ Veri Silme (DELETE)

$db->delete("users", ['id' => 1]);

🛡️ Güvenlik Önlemleri

✅ SQL Injection Koruması: Prepared Statements kullanarak girişler güvenli hale getirilmiştir.✅ Bağlantı Hata Yönetimi: PDOException ile hatalar yönetilmektedir.✅ UTF-8 Desteği: Türkçe karakter sorunlarını önlemek için utf8mb4 kullanılmıştır.

📜 Lisans

Bu proje MIT lisansı altında sunulmaktadır. Kullanabilir, değiştirebilir ve dağıtabilirsiniz.

