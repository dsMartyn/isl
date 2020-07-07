<?php

namespace Services\LsDb;


class LsDb
{

    public static $instance = null;

    public static function instance() {
        if ( self::$instance === null ) {
            self::$instance = new lsdb();
        }

        return self::$instance;
    }

    public static function _query($sql) {
        return self::instance()->query($sql);
    }

    public static function _insert($sql) {
        return self::instance()->insertQuery($sql);
    }

    public static function _update($sql) {
        return self::instance()->updateQuery($sql);
    }

    public static function _delete($sql) {
        return self::instance()->deleteQuery($sql);
    }

    public static function _active($id, $table) {
        return self::instance()->toggle_active($id, $table);
    }

    // standard to mysql date
    public static function standard_to_mysql($date) {
        $date = explode('/', $date);

        return "{$date[2]}-{$date[1]}-{$date[0]}";
    }

    public $link = null;

    private $num_total   = 0;
    private $num_queries = 0;
    private $num_updates = 0;
    private $num_deletes = 0;
    private $num_inserts = 0;

    public function totalQueries() { return $this->num_total; }
    public function totalUpdates() { return $this->num_updates; }
    public function totalDeletes() { return $this->num_deletes; }
    public function totalInserts() { return $this->num_inserts; }
    public function totalReads()   { return $this->num_queries; }

    private function __construct() {

        $db = array(
            "host" => getenv('DB_HOST'),
            "user" => getenv('DB_USER'),
            "pass" => getenv('DB_PASSWORD'),
            "name" => getenv('DB_NAME')
        );

        if ( $this->link === null ) {
            $this->link = mysqli_connect($db['host'], $db['user'], $db['pass']) or die("Error " . mysqli_connect_error($this->link));
            mysqli_select_db($this->link, $db['name']) or die("Unable to select database: {$db['name']}");
            mysqli_query($this->link, "SET NAMES utf8;");
        }

    }

    public function toggle_active($id, $table) {
        $this->num_updates++;
        $this->num_total++;

        return new updateQuery( $this->link, "UPDATE `$table` SET `active` = NOT `active` WHERE `id` = '$id'" );
    }

    public function escape_mysqli($value) {
        return mysqli_real_escape_string($this->link, $value);
    }

    public function query( $sql ) {
        $result = false;

        $this->num_queries++;
        $this->num_total++;

        $result = new fetchQuery($this->link, $sql);

        return $result;
    }

    public function updateQuery($sql) {
        $this->num_updates++;
        $this->num_total++;
        return new updateQuery($this->link, $sql);
    }

    public function insertQuery($sql) {
        $this->num_inserts++;
        $this->num_total++;
        return new insertQuery($this->link, $sql);
    }

    public function deleteQuery($sql) {
        $this->num_deletes++;
        $this->num_total++;
        return new deleteQuery($this->link, $sql);
    }

    // alias functions for above...
    public function update_query($sql) { return $this->updateQuery($sql); }
    public function insert_query($sql) { return $this->insertQuery($sql); }
    public function delete_query($sql) { return $this->deleteQuery($sql); }

    // aliases
    public function auto_save($data, $table, $clean = false) {
        return $this->autoSave($data, $table, $clean);
    }

    public function auto_update($data, $table, $clean = false) {
        return $this->autoUpdate($data, $table, $clean);
    }

    public function auto_insert($data, $table, $clean = false) {
        return $this->autoInsert($data, $table, $clean = false);
    }

    public function autoSave($data, $table, $clean = false) {
        $id = isset($data['id']) ? $data['id'] : false;

        $result = false;

        if ($id) {
            $this->autoUpdate($data, $table, $clean);
        } else {
            $id = $this->autoInsert($data, $table, $clean)->insertid;
        }

        return $id;
    }

    public function autoUpdate($data, $table, $clean = false) {

        // id is required, return false if not found
        if ( isset( $data['id'] ) ) {
            $id = $data['id']; unset($data['id']);
        } else {
            echo("No 'id' found in data provided.");
        }

        $sql = " UPDATE `$table` SET ";

        foreach ($data as $key => $value) {
            if ($clean) {
                $value = clean($value);
                $sql .= " `$key` = '$value' ,";
            } else {
                $sql .= " `$key` = '$value' ,";
            }
        }

        //remove extra comma
        $sql = substr($sql, 0, (strlen($sql) - 1));

        $sql .= " WHERE `id` = '$id' ";

        $this->num_updates++;
        $this->num_total++;

        return new updateQuery($this->link, $sql);
    }

    public function autoInsert($data, $table, $clean = false) {

        $_fields = array();
        $_values = array();

        foreach ($data as $field => $value) {
            $_fields[] = $field;
            $_values[] = $value;
        }

        $sql = " INSERT INTO `$table` ( ";

        foreach($_fields as $field) { $sql .= "`$field` ,"; }

        $sql = substr($sql, 0, (strlen($sql) - 1));

        $sql .= " ) VALUES ( ";

        foreach($_values as $value) {
            if ($clean) {
                $value = clean($value);
                $sql .= "'$value' ,";
            } else {
                $sql .= "'$value' ,";
            }
        }

        //remove extra comma
        $sql = substr($sql, 0, (strlen($sql) - 1));

        $sql .= " ) ";

        $this->num_inserts++;
        $this->num_total++;

        return new insertQuery($this->link, $sql);
    }

    function autoDelete($id, $table) {
        $this->num_deletes++;
        $this->num_total++;

        return new deleteQuery($this->link, " DELETE FROM `$table` WHERE `id` = $id LIMIT 1 ");
    }
}

class deleteQuery {
    public $result = false;

    function __construct($link, $sql) {
        $this->result = mysqli_query($link, $sql) ? true : false;
    }
}

class insertQuery {
    public $result = false;
    public $insertid = 0;

    function __construct($link, $sql) {
        $this->result = mysqli_query($link, $sql);// or die(mysqli_error($link) . '<br /><br />' . $sql);
        $this->insertid = mysqli_insert_id($link);
    }
}

class updateQuery {
    public $result = false;
    public $affected_rows = 0;

    function __construct($link, $sql) {
        $this->result = mysqli_query($link, $sql);// or die(mysqli_error($link) . '<br /><br />' . $sql);
        $this->affected_rows = mysqli_affected_rows($link);
    }
}

class fetchQuery {

    public $result = false;
    public $num = 0;
    public $rows = array();

    function __construct($link, $sql) {

        $this->result = mysqli_query($link, $sql);// or die(mysqli_error($link) . '<br /><br />' . $sql);

        if ( ($this->result) && (is_object($this->result)) ) {
            $this->num = mysqli_num_rows($this->result);

            if ($this->num) {
                while($row = mysqli_fetch_assoc($this->result)) {
                    $this->rows[] = $row;
                }
            }
        }
    }
}

function clean($value) {
    if ( ! is_array( $value ) ) {
        return lsdb::instance()->escape_mysqli(trim(stripslashes($value)));
    } else {
        foreach ( array_keys($value) as $k ) { $value[$k] = clean( $value[$k] ); }
        return $value;
    }
}

