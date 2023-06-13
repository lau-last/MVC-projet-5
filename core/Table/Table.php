<?php

namespace Core\Table;

use Core\Database\MysqlDatabase;

abstract class Table
{
    protected string $table;
    protected ?MysqlDatabase $db = null;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function update($id, $fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        return $this->query("UPDATE {$this->table} SET {$sql_part}  WHERE id = ?", $attributes, true);
    }
    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function creat($fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $sql_part = implode(', ', $sql_parts);
        return $this->query("INSERT INTO {$this->table} SET {$sql_part}", $attributes, true);
    }

    public function extract($key, $value): array
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $k => $v){
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function all()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }

    public function query(string $statement, array $attributes = null, bool $one = false)
    {
        if ($attributes) {
            return $this->db->prepare(
                $statement,
                $attributes,
                \str_replace('Table', 'Entity', \get_class($this)),
                $one);
        } else {
            return $this->db->query(
                $statement,
                \str_replace('Table', 'Entity', \get_class($this)),
                $one);
        }
    }

}