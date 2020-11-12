<?php

class Database extends PDO {

    function __construct($db_type, $db_host, $db_name, $db_user, $db_pass) {
        try {
            parent::__construct($db_type . ':host=' . $db_host . ';dbname=' . $db_name.';charset=utf8', $db_user, $db_pass);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            @$this->view = new View();
            $this->view->render('error/index');
            die();
        }
    }

    // array('table' => name, 'data' => ['user' => value, 'password' => value]);
    function insert($data) {

        $column_name = "";
        $value_string = "";

        foreach ($data['data'] as $key => $value) {

            $column_name .= $key . ", ";
            $value_string .= ":" . $key . ", ";
        }

        $column_name = rtrim($column_name, ", ");
        $value_string = rtrim($value_string, ", ");

        $query = "INSERT INTO " . $data['table'] . "(" . $column_name . ") VALUES (" . $value_string . ");";

        $stmt = $this->prepare($query);
        $stmt->execute($data['data']);

        $result = $this->select(array('table' => $data['table'], 'column' => '*', 'where' => 'id = :id;', 'data' => array('id' => $this->lastInsertId())));

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    // array('table' => name, 'column' => col , 'where' => where, 'data' => ['key'=>'value'])
    function select($data) {

        $where = "";

        if (isset($data['where'])) {
            $where = " WHERE " . $data['where'];
        } elseif (isset($data['group_by'])) {
            $where .= " GROUP BY " . $data['group_by'];
        } elseif (isset($data['order_by'])) {
            $where .= " ORDER BY " . $data['order_by'];
        } else {
            $where = "";
        }
        $where .= ";";

        $query = "SELECT " . $data['column'] . " FROM " . $data['table'] . $where;


        $stmt = $this->prepare($query);

        if (isset($data['data'])) {
            $stmt->execute($data['data']);
        } else {
            $stmt->execute();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // array('table' => name, 'data' => ['column_name' => value], 'where' => 'where', 'values' => ['id' => id])
    function update($data) {

        $where = "";
        foreach ($data['data'] as $key => $value) {
            $where .= $key . " = :" . $key . ", ";
        }
        $where = rtrim($where, ', ');

        $array = [];

        foreach ($data['data'] as $key => $value) {
            $array[$key] = $value;
        }

        foreach ($data['values'] as $key => $value) {
            $array[$key] = $value;
        }

        $query = "UPDATE " . $data['table'] . " SET " . $where . " WHERE " . $data['where'] . ';';

        $stmt = $this->prepare($query);
        $stmt->execute($array);

        $result = $this->select(array('table' => $data['table'], 'column' => '*', 'where' => 'id = :id', 'data' => array('id' => $data['values']['id'])));
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    // array('table'=> name, 'where' => where, 'data' => [] )
    function delete($data) {
        $query = "DELETE FROM " . $data['table'] . " WHERE " . $data['where'] . ";";
        $stmt = $this->prepare($query);
        $stmt->execute($data['data']);

        //$result = $this->select(array('table' => $data['table'], 'column' => '*', 'where' => 'id = :id', 'data' => array('id' => $data['data']['id'])));

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
