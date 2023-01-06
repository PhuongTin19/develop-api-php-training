<?php
class BookModel {
    private $bookId;
    private $bookName;
    private $bookIssueDate;
    private $bookPrice;

    /**
     * コンストラクタ.
     * 
     * @param int $bookId Mã sách
     * @param string $bookName Tên sách
     * @param string $bookIssueDate Ngày phát hành sách
     * @param double $bookPrice Giá sách
     */
    public function __construct($bookId, $bookName, $bookIssueDate, $bookPrice) {
        $this->bookId = $bookId;
        $this->bookName = $bookName;
        $this->bookIssueDate = $bookIssueDate;
        $this->bookPrice = $bookPrice;
    }
    
    /**
     * Hàm trả về dạng json cho các class có thuộc tính private.
     *
     * @return array mảng json
     */
    function toJson() {
        return get_object_vars($this);
    }
}

?>