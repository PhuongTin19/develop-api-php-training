<?php
require_once 'Model/Dto/BookModel.php';

class OrderModel {
    private $setId;
    private $setName;
    private $setGenreName;
    private $setAuthorName;
    private $setIssueDate;
    private $setPrice;
    private $books;

    /**
     * コンストラクタ.
     * 
     * @param int $setId Id của set
     * @param string $setName Tên của set
     * @param string $setGenreName Tên thể loại
     * @param string $setAuthorName Tên tác giả
     * @param string $setIssueDate Ngày phát hành set
     * @param double $setPrice Giá set
     * @param array $books Mảng sách trong set
     */
    function __construct($setId, $setName, $setGenreName, $setAuthorName,
            $setIssueDate, $setPrice, $books) {
        $this->setId = $setId;
        $this->setName = $setName;
        $this->setGenreName = $setGenreName;
        $this->setAuthorName = $setAuthorName;
        $this->setIssueDate = $setIssueDate;
        $this->setPrice = $setPrice;
        $this->books = json_decode($books, true);
    }

    function toString() {
        return get_object_vars($this);
    }

    function getSetId() {
        return $this->setId;
    }

    function getSetName() {
        return $this->setName;
    }

    function getSetAuthorName() {
        return $this->setAuthorName;
    }

    function getSetGenreName() {
        return $this->setGenreName;
    }

    function getIssueDate() {
        return $this->setIssueDate;
    }

    function getPrice() {
        return $this->setPrice;
    }

    function getBooks() {
        return $this->books;
    }

    /**
     * Hàm trả về dạng json cho các class có thuộc tính private.
     * 
     * @return array mảng json
     */
    public function toJson() {
        return get_object_vars($this);
    }

    /**
     * Hàm để thêm sách vào mảng sách.
     * 
     * @param BookModel $bookModel đối tượng sách cần thêm vào
     */
    function addBook($bookModel) {
        if ($this->books == null) {
            $this->books = array();
        }
        array_push($this->books, $bookModel->toJson());
    }

    /**
     * Hàm convert dữ liệu trả về từ sql sang OrderModel.
     *
     * @param array $array Dữ liệu trả về từ SQL
     * @return array Mảng dữ liệu sau khi convert
     */
    public static function convertResultSqlToOrderModel($array) {
        $result = array();
        $orderModel = null;
        $bookModel = null;
        $currentOrderId = 0;
        if (count($array) > 0) {
            foreach ($array as $row) {
                if ($index == 0 || $row["ORDER_ID"] != $currentOrderId
                        || $row["SET_ID"] != $orderModel->getSetId()) {
                    if ($index > 0) {
                        array_push($result, $orderModel->toJson());
                    }
                    $currentOrderId = $row["ORDER_ID"];
                    $orderModel = new OrderModel($row["SET_ID"],
                            $row["SET_NAME"], $row["GENRE_NAME"],
                            $row["AUTHOR_NAME"], $row["ISSUE_DATE"],
                            $row["SET_PRICE"], array());
                }
                $bookModel = new BookModel($row["BOOK_ID"], $row["BOOK_NAME"],
                        $row["ISSUE_DATE"], $row["BOOK_PRICE"]);
                $orderModel->addBook($bookModel);
                $index++;
            }
            array_push($result, $orderModel->toJson());
        }
        return $result;
    }
}
?>