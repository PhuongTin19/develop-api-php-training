<?php
class HistoryOfOrderReq {
    private $memberId;
    private $type;
    private $from;
    private $to;

    /**
     * コンストラクタ.
     * 
     * @param array $requestObject mảng chứa các dữ liệu để khởi tạo class
     */
    function __construct($requestObject) {
        $this->memberId = $requestObject[0];
        $this->type = $requestObject[1];
        $this->from = $requestObject[2];
        $this->to = $requestObject[3];
    }

    function getMemberId() {
        return $this->memberId;
    }

    public function getType() {
        return $this->type;
    }

    public function getFrom() {
        return $this->from;
    }
    public function getTo() {
        return $this->to;
    }

    public function toJson() {
        return get_object_vars($this);
    }

}
?>