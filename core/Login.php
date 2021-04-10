<?php

/**
 * @author Kirill Sermyagin <abcen7>
 * @Login authorizes user on the system
 */

namespace Application\Core;

use DateTime;
use DateTimeZone;
use Exception;
use PDO;

class Login extends Database
{
    /**
     * @var array $dataUser is data about user (username, password)
     */
    private array $dataUser;
    /**
     * @var mixed|string $table is a table for request to database
     */
    private string $table;

    /**
     * Login constructor.
     * @param array $dataUser
     */
    public function __construct(array $dataUser = [])
    {
        parent::__construct();
        $this->dataUser = $dataUser;
        $this->table = $this->settings['name_table_users'];
    }

    /**
     * Validates user data before login.
     * @return bool
     * @throws Exception
     */
    public function validate(): bool
    {
        $vars = [':username' => $this->dataUser['username']];
        $stmt = $this->db->prepare("SELECT * FROM `$this->table` WHERE `username` = :username");
        $stmt->execute($vars);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
            if (password_verify($this->dataUser['password'], $user->password)) {
                $timeZone = new DateTimeZone('Europe/Moscow');
                $datetime1 = new DateTime($user->date, $timeZone);
                $datetime2 = new DateTime();
                $interval = $datetime1->diff($datetime2);
                $age = $interval->format('%y');
                $_SESSION['user'] = [
                    'avatar' => $user->avatarURL,
                    'username' => $user->username,
                    'age' => $age,
                    'name' => $user->name,
                    'surname' => $user->surname,
                ];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}