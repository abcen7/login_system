<?php

/**
 * @author Kirill Sermyagin <abcen7>
 * @Database uses database
 */

namespace Application\Core;

use mysql_xdevapi\Exception;
use PDO;

class Database
{
    /**
     * @var object|PDO
     */
    protected object $db;
    /**
     * @var array|mixed is a data about connection to your local or public server.
     */
    protected array $dataConnection;
    /**
     * @var array|mixed is a settings about your tables in database.
     */
    protected array $settings;

    /**
     * Database constructor.
     * Creates connection for database
     * @throws Exception
     */
    public function __construct()
    {
        $this->dataConnection = require 'configs/connection.php';
        $this->settings = require 'configs/api.php';
        try {
            $this->db = new PDO('mysql:host=' . $this->dataConnection['host'] . ';dbname=' . $this->dataConnection['dbname'],
                $this->dataConnection['username'], $this->dataConnection['password']);
        } catch (\PDOException $exception) {
            die('Error: cant connect to db');
        }

    }
}