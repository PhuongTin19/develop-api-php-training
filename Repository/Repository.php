<?php
require_once 'Connector/DataBase.php';

class Repository {

    protected $dataBase;

    /**
     * コンストラクタ.
     *
     */
    public function __construct() {
        $this->dataBase = new DataBase();
    }
    
    /**
     * Hàm set giá trị cho các param trong SQL.
     *
     * @param string $sql Câu SQL ban đầu
     * @param string $key Từ khóa cần thay
     * @param any $value Giá trị cần thay
     * @param string $type Loại dữ liệu
     * @return string Trả về câu SQL sau khi set param
     */
    public function setParam($sql, $key, $value, $type) {
        $result = $sql;
        switch ($type) {
            case 's':
                $result = str_replace(":" . $key, "'" . $value . "'", $sql);
                break;
            case 'i':
            case 'd':
                $result = str_replace(":" . $key, $value, $sql);
                break;
            default:
                break;
        }
        return $result;
    }
    
    /**
     * Hàm lấy kết quả từ câu truy vấn SQL.
     *
     * @param string $sql Câu truy vấn SQL
     * @return array Kết quả trả về từ database
     */
    public function select($sql){
        $connection = $this->dataBase->getConnection();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $this->dataBase->closeConnection();
        return $result;
    }
    
    /**
     * Hàm lấy kết quả trả về là 1 giá trị từ câu truy vấn SQL.
     *
     * @param string $sql Câu truy vấn SQL
     * @param string $key Thuộc tính cần lấy
     * @return any Giá trị trả về có thể là bất kỳ kiểu dữ liệu nào
     */
    public function selectSingleValue($sql, $key){
        $connection = $this->dataBase->getConnection();
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_object();
        $this->dataBase->closeConnection();
        return $row->$key;
    }
}
?>