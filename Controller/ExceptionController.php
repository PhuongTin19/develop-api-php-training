<?php
require_once "Model/Dto/ErrorModel.php";
require_once "Common/CommonPath.php";

class ExceptionController {

    /**
     * Hàm tìm function để handle error code.
     * 
     * @param Exception $exception Lỗi được tung ra từ hệ thống
     * @return array trả về mảng chứa dữ liệu của error code
     */
    public function handleGlobalException(Exception $exception) {
        $response = array();
        $messages = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);
        $message = $messages->getMessageByCodeName($exception->getMessage());
        $response["status_code"] = $message["HTTP_CODE"];
        $body = new ErrorModel($message["ERROR_CODE"],
                $message["ERROR_MESSAGE"]);
        $response["body"] = json_encode($body->toJson());
        header($response["status_code"]);
        if ($response["body"]) {
            echo $response["body"];
        }
    }
}
?>