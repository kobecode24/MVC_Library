<?php
require_once '../Config/DbConnection.php';

class User {
    private $db;

    public function __construct() {
        $this->db = DbConnection::getInstance()->getConnection();
    }

    /**
     * Check if an email already exists in the database.
     *
     * @param string $email Email to check.
     * @return bool True if email exists, false otherwise.
     */
    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM User WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Create a new user and assign a default role.
     *
     * @param string $fullname User's full name.
     * @param string $last_name User's last name.
     * @param string $email User's email.
     * @param string $password User's password.
     * @param string $phone User's phone number.
     * @return int The ID of the newly created user.
     * @throws Exception If there's a database error.
     */
    public function createUserWithDefaultRole(string $fullname, string $last_name, string $email, string $password, string $phone): int {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO User (fullname, last_name, email, password, phone) VALUES (:fullname, :last_name, :email, :password, :phone)");
            $stmt->execute([
                'fullname' => $fullname,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $hashed_password,
                'phone' => $phone
            ]);

            $userId = $this->db->lastInsertId();
            $this->assignDefaultRole($userId);

            $this->db->commit();
            return $userId;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    /**
     * Assign a default role to the newly created user.
     *
     * @param int $userId The ID of the user.
     * @throws Exception If there's a database error.
     */
    private function assignDefaultRole(int $userId) {
        $defaultRoleId = 2; // Assuming 2 is the ID for the 'Member' role
        $stmt = $this->db->prepare("INSERT INTO UserRole (user_id, role_id) VALUES (?, ?)");
        $stmt->execute([$userId, $defaultRoleId]);
    }

    /**
     * Verify user's credentials and get their role.
     *
     * @param string $email User's email.
     * @param string $password User's password.
     * @return mixed Returns user's data if credentials are valid, otherwise false.
     */
    public function verifyLogin(string $email, string $password) {
        $stmt = $this->db->prepare("
            SELECT User.*, UserRole.role_id 
            FROM User
            INNER JOIN UserRole ON User.id = UserRole.user_id
            WHERE User.email = :email
        ");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
