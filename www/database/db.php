<?php
session_start();
require 'connect.php';

function valueTest($value) {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function dbCheckErrors($query) {
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit;
    }
    return true;
}
function selectAll($table, $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function selectUsers($table, $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE NOT $key = $value";
            } else {
                $sql = $sql . " AND NOT $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function selectOne($table, $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckErrors($query);
    return $query->fetch();
}

function insert($table, $params) {
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" ."$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask .", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErrors($query);

    return $pdo->lastInsertId();
}

function update($table, $id, $params) {
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . "$value" . "'";
        } else {
            $str = $str . ", " . $key . " = " .  "'" . "$value" . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id" ;
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckErrors($query);
}

function updatePost($table, $id, $params) {
    global $pdo;
    $sql = "UPDATE $table SET user_id=:user_id, caption=:caption, content=:content WHERE id=$id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':user_id', $params['user_id'], PDO::PARAM_INT);
    $query->bindParam(':caption', $params['caption']);
    $query->bindParam(':content', $params['content']);
    $query->execute();
    dbCheckErrors($query);
}

function delete($table, $id) {
    global $pdo;

    $sql = "DELETE FROM $table WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErrors($query);
}


