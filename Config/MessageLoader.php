<?php
require_once "Config/IniFileLoader.php";
class MessageLoader extends IniFileLoader {

    /**
     * コンストラクタ.
     * 
     * @param string $filePath Đường dẫn đến file cần đọc
     */
    function __construct($filePath) {
        parent::__construct($filePath, true);
    }

    /**
     * Hàm lấy mảng chứa các thông tin liên quan đến codeName trong file.
     * 
     * @param string $codeName
     * @return array Mảng chứa các thông tin liên quan đến codeName
     */
    function getMessageByCodeName($codeName) {
        $result["HTTP_CODE"] = $this->data["HTTP_CODE"][$codeName];
        $result["ERROR_CODE"] = $this->data["ERROR_CODE"][$codeName];
        $result["ERROR_MESSAGE"] = $this->data["ERROR_MESSAGE"][$codeName];
        return $result;
    }

    /**
     * Hàm lấy success code.
     * 
     * @return string giá trị của success code
     */
    function getSuccessCode() {
        return $this->data["SUCCESS_CODE"]["SUCCESS"];
    }

    /**
     * Hàm lấy giá trị Error Code dựa vào tên được định danh.
     * 
     * @param string $codeName
     * @return string Giá trị error code
     */
    function getErrorCodeByCodeName($codeName) {
        return $this->data["ERROR_CODE"]["$codeName"];
    }

    /**
     * Hàm lấy giá trị Http Code Success.
     * 
     * @param string $codeName
     * @return string Http code success
     */
    function getHttpCodeSuccess() {
        return $this->data["SUCCESS_CODE"]["HTTP_CODE"];
    }
}
?>