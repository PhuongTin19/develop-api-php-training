<?php

class ErrorModel{
    private $code;
    private $message;

    /**
     * コンストラクタ.
     * 
     * @param string $code mã lỗi
     * @param string $message nội dung lỗi
     */
    function __construct($code, $message) {
        $this->code = $code;
        $this->message = $message;
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