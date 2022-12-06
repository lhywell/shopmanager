<?php


class DB
{
    static $mysqli = NULL;
    public $conn;
    private $tableName;
    private $options;

    function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->conn = self::create();
    }

    static function create()
    {
        if (is_null(self::$mysqli)) {
            self::$mysqli = new mysqli("localhost", "root", "", "productdb");

            if (self::$mysqli->connect_error) {
                die("数据库连接失败");
            }

            $code = "set names utf8";
            self::$mysqli->query($code);
        }
        return self::$mysqli;
    }
    public function getConn()
    {
        return $this->conn;
    }
    public function fields($field)
    {
        if (empty($field)) {
            $this->options['field'] = '*';
        } elseif (is_string($field)) {
            $this->options['field'] = $field;
        } elseif (is_array($field)) {
            $this->options['field'] = implode(",", $field);
        }
    }
    public function order($field = '')
    {
        $this->options['order'] = $field;
        return $this;
    }
    public function query($field)
    {

        $this->fields($field);

        $sql = "SELECT {$this->options['field']} FROM {$this->tableName}";
        // echo ($sql);
        $result = self::$mysqli->query($sql);

        return $result;
    }
    public function search($field, $id)
    {
        $this->fields($field);
        // SELECT * FROM `product` WHERE `id` = 4

        $sql = "SELECT {$this->options['field']} FROM {$this->tableName} WHERE `id` = {$id}";
        // echo ($sql);
        $result = self::$mysqli->query($sql);

        return $result;
    }
    public function delete($id)
    {
        // “DELETE FROM `product` WHERE `product`.`id` = 3”

        $sql = "DELETE FROM {$this->tableName} WHERE {$this->tableName}.`id`={$id}";
        // echo $sql;

        self::$mysqli->query($sql);
    }
    public function insert($pname, $price, $pcount, $remark)
    {
        $sql = "INSERT INTO {$this->tableName} (`id`, `pname`, `price`, `pcount`, `remark`) VALUES (NULL, '{$pname}', '{$price}', '{$pcount}', '{$remark}');";
        // var_dump(self::$mysqli);

        self::$mysqli->query($sql);
    }
    public function update($pname, $price, $pcount, $remark, $id)
    {
        $sql = "UPDATE {$this->tableName} SET `pname` = '{$pname}',`price` = '{$price}',`pcount` = '{$pcount}', `remark` = '{$remark}' WHERE {$this->tableName}.`id` = {$id};";
        // var_dump(self::$mysqli);

        self::$mysqli->query($sql);
    }
    // private function closeDB()
    // {
    //     self::$mysqli->close();
    // }
    // function __destruct()
    // {
    //     $this->closeDB();
    //     echo "释放对象";
    // }
}

// $db = new db("user");
// $result = $db->fields("uname")->query();


?>