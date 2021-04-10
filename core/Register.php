<?php

/**
 * @author Kirill Sermyagin <abcen7>
 * @Login registers user in system
 */

namespace Application\Core;

use Exception;

class Register extends Database
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
     * @var string is a error;
     */
    private string $error;

    /**
     * Register constructor.
     * @param $dataUser
     */
    public function __construct($dataUser)
    {
        parent::__construct();
        $this->dataUser = $dataUser;
        $this->table = $this->settings['name_table_users'];
    }

    /**
     * @throws Exception
     * Checks for password matches and user exists on database.
     */
    public function validate(): bool
    {
        if ($this->dataUser['password'] != $this->dataUser['repeatPassword']) {
            $this->error = 'Error: Password mismatch!';
            return false;
        } else if (strpos($this->dataUser['avatarURL'], '.') === false) {
            $this->error = 'Error: Incorrect avatar URL!';
            return false;
        } else {
            $dataUser = [
                'username' => $this->dataUser['username'],
                'password' => $this->dataUser['password'],
            ];
            $Login = new Login($dataUser);
            if (!$Login->validate()) {
                return true;
            } else {
                $this->error = 'Error: This user already exists!';
                return false;
            }
        }
    }

    /**
     * Creates new user on database, after all checks
     */
    public function register()
    {
        $this->error = '';
        try {
            if (!$this->validate()) {
                return false;
            } else {
                $password = password_hash($this->dataUser['password'], PASSWORD_DEFAULT);
                $vars = [
                    ':id' => NULL,
                    ':username' => $this->dataUser['username'],
                    ':password' => $password,
                    ':name' => $this->dataUser['name'],
                    ':surname' => $this->dataUser['surname'],
                    ':date' => $this->dataUser['date'],
                    ':avatarURL' => $this->dataUser['avatarURL']
                ];
                $stmt = $this->db->prepare("INSERT INTO `$this->table` (`id`, `username`, `password`, 
                         `name`, `surname`, `date`, `avatarURL`) VALUES (:id, :username, :password, :name, :surname, :date, :avatarURL)");
                if ($stmt->execute($vars)) {
                    return true;
                } else {
                    $this->error = 'Error: Error request, please contact with developers!';
                    return false;
                }
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return false;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

}