<?php
class Auth {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function register($email, $password, $name) {
        // Валидация email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Некорректный email");
        }

        // Проверка на существование пользователя
        $exists = $this->db->query("SELECT 1 FROM users WHERE email = ?s", [$email])->fetch();
        if ($exists) {
            throw new Exception("Пользователь с таким email уже существует");
        }

        $pwd_peppered = hash_hmac("sha256", $password, STR);
        // Хеширование пароля
        $hashedPassword = password_hash($pwd_peppered, PASSWORD_DEFAULT);

        // Создание пользователя с минимальными данными
        $this->db->query(
            "INSERT INTO users (email, password, name) VALUES (?s, ?s, ?s)",
            [$email, $hashedPassword, $name]
        );

        return true;
    }

    public function login($email, $password) {
        // Получаем пользователя из базы
        $user = $this->db->query("SELECT * FROM users WHERE email = ?s", [$email])->fetch();

        if (!$user) {
            throw new Exception("Error Email");
        }

        // Если пароль отсутствует (NULL или пустая строка)
        if (empty($user['password'])) {
            // Хешируем и сохраняем новый пароль
            $pwd_peppered = hash_hmac("sha256", $password, STR);
            $hashed_password = password_hash($pwd_peppered, PASSWORD_DEFAULT);

            // Обновляем пароль в базе
            $this->db->query("UPDATE users SET password = ?s WHERE id = ?i",
                [$hashed_password, $user['id']]);

            // Устанавливаем обновленный пароль в объект пользователя
            $user['password'] = $hashed_password;
        }

        // Проверяем пароль
        $pwd_peppered = hash_hmac("sha256", $password, STR);

        if (!password_verify($pwd_peppered, $user['password'])) {
            throw new Exception("Error Password");
        }

        // Стартуем сессию если еще не начата
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name']
        ];

        return true;
    }


    public function logout() {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
    }

    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user']);
    }

    public function getUser() {
        return $_SESSION['user'] ?? null;
    }

    public function getUserID()
    {
        $user = $this->getUser();
        return !empty($user['id']) ? $user['id'] : false;
    }

    public function emailExists($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        try {
            return (bool)$this->db->query(
                "SELECT EXISTS(SELECT 1 FROM users WHERE email = ?s) AS exists",
                [$email]
            )->fetch()['exists'];
        } catch (Exception $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false;
        }
    }

    public function egetUser_by_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        try {
            $t =  $this->db->query(
                "SELECT `id` FROM users WHERE email = ?s",
                [$email]
            );
            return $t->fetch()['id'];
        } catch (Exception $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false;
        }
    }

    public function getUser_by_id($id) {

        try {
            $t =  $this->db->query(
                "SELECT * FROM users WHERE id = ?s",
                [$id]
            );
            return $t->fetch();
        } catch (Exception $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Получает все заказы пользователя из таблицы old_orders
     *
     * @param int $user_id ID пользователя
     * @return array|false Массив заказов или false при ошибке
     */
    public function getOldOrdersByUserId($user_id) {
        try {
            $result = $this->db->query(
                "SELECT * FROM old_orders WHERE user_ID = ?s ORDER BY created_at DESC",
                [$user_id]
            );

            $orders = [];
            while ($row = $result->fetch()) {
                // Десериализуем данные заказов
                $row['orders'] = unserialize($row['orders']);
                $orders[] = $row;
            }

            return $orders;
        } catch (Exception $e) {
            error_log("Failed to get old orders for user {$user_id}: " . $e->getMessage());
            return false;
        }
    }

/**
* Получает все заказы пользователя из таблицы new_orders
*
* @param int $user_id ID пользователя
* @return array|false Массив заказов или false при ошибке
*/
    public function getNewOrdersByUserId($user_id) {
        try {
            $result = $this->db->query(
                "SELECT * FROM new_orders WHERE user_ID = ?s ORDER BY created_at DESC",
                [$user_id]
            );

            $orders = [];
            while ($row = $result->fetch()) {
                // Десериализуем данные заказов
                $row['orders'] = unserialize($row['order_data']);
                $orders[] = $row;
            }

            return $orders;
        } catch (Exception $e) {
            error_log("Failed to get old orders for user {$user_id}: " . $e->getMessage());
            return false;
        }
    }

}