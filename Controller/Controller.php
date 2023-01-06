<?php
require_once "Model/Dto/ErrorModel.php";
require_once "Config/MessageLoader.php";
require_once "Common/CommonPath.php";

class Controller {

    /**
     * Hàm tìm function để handle request.
     *
     * @param string $uri Đường dẫn request
     */
    public function processRequest($uri) {
        try {
            if (method_exists($this, $uri)) {
                $response = call_user_func(array($this, $uri));
                return $response;
            }
            return null;
        } catch (Exception $exception) {
            $response = $this->handleError($exception);
            return $response;
        }
    }

    /**
     * Hàm trả về response mặc định khi không có controller handle được request.
     * 
     * @return array trả về mảng chứa id và message code
     */
    public static function handlePageNotFound() {
        $messages = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);
        $errorCode = $messages->getMessageByCodeName("PAGE_NOT_FOUND");
        $response["status_code"] = $errorCode["HTTP_CODE"];
        $body = new ErrorModel($errorCode["ERROR_CODE"],
                $errorCode["ERROR_MESSAGE"]);
        $response["body"] = json_encode($body->toJson());
        return $response;
    }

    protected function handleError(Exception $exception) {
        $messageLoader = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);
        $message = $messageLoader
                ->getMessageByCodeName($exception->getMessage());
        $response["status_code"] = $message["HTTP_CODE"];
        $body = new ErrorModel($message["ERROR_CODE"],
                $message["ERROR_MESSAGE"]);
        $response["body"] = json_encode($body->toJson());
        return $response;
    }
}
?>