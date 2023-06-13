<?php

namespace App;

use Core\Config;
use Core\Database\Database;
use Core\Database\MysqlDatabase;
use Core\Table\Table;

class App
{
    private static ?App $_instance = null;
    private ?Database $db_instance = null;

    public static function getInstance(): App
    {
        if (\is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getTable(string $className)
    {
        if (!\class_exists($className)) {
            throw new \InvalidArgumentException($className . ' class not found');
        }

        if (!\is_subclass_of($className, Table::class)) {
            throw new \InvalidArgumentException($className . ' is not an instance of' . Table::class);
        }

        return new $className($this->getDB());
    }

    public function getDB(): MysqlDatabase
    {
        $config = Config::init(ROOT . '/config/config.php');
        if (\is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }

}
