<?php
class EDB extends DB {

    public function insert($table, $data) {
        $names = "";
        $values = "";

        foreach ($data as $key=>$value) {
            if ($names == "") {
                $names .= $key;
                $values .= "'$value'";
            } else {
                $names .= ", $key";
                $values .= ", '$value'";
            }
        }

        if ($this->query("INSERT INTO $table ($names) VALUES ($values)")) return $this->getLastId();

        return 0;
    }

    public function update($table, $data, $where) {
        $set = "";

        foreach ($data as $key=>$value) {
            if ($set == "") {
                $set .= "$key='$value'";
            } else {
                $set .= ", $key='$value'";
            }
        }

        if ($this->query("UPDATE $table SET $set WHERE $where")) return $this->countAffected();

        return 0;
    }

    public function updateById($table, $data, $id, $nameOfId = 'id') {
        $set = "";

        foreach ($data as $key=>$value) {
            if ($set == "") {
                $set .= "$key='$value'";
            } else {
                $set .= ", $key='$value'";
            }
        }

        if ($this->query("UPDATE $table SET $set WHERE $nameOfId='$id'")) return $this->countAffected();

        return 0;
    }

    public function delete($table, $where) {
        if ($this->query("DELETE FROM $table WHERE $where")) return $this->countAffected();

        return 0;
    }

    public function deleteById($table, $id, $nameOfId = 'id') {
        if ($this->query("DELETE FROM $table WHERE $nameOfId='$id'")) return $this->countAffected();

        return 0;
    }

    public function select($table, $select, $schema = '') {
        return $this->query("SELECT $select FROM $table $schema");
    }

    public function countTotal($table) {
        $ret = $this->query("SELECT COUNT(*) FROM $table");

        return (int)$ret->row["COUNT(*)"];
    }
}