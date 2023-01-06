<?php
require_once "Model/Req/HistoryOfOrderReq.php";
require_once "Repository/UserRepository.php";
require_once "Config/MessageLoader.php";
require_once "Validation.php";
require_once "Common/CommonPath.php";

class OrderValidation extends Validation{

    const FORMAT_DATE = "Y-m-d";

    /**
     * Hàm kiểm tra tính đúng đắn của dữ liệu người dùng nhập vào.
     * 
     * @param HistoryOfOrderReq $historyOfOrderReq Object của request gửi lên từ client
     * @throws Exception quăng lỗi khi không thỏa yêu cầu của các trường
     */
    public function validateHistoryOfOrderReq(
            HistoryOfOrderReq $historyOfOrderReq) {
        $memberId = $historyOfOrderReq->getMemberId();
        $type = $historyOfOrderReq->getType();
        $from = $historyOfOrderReq->getFrom();
        $to = $historyOfOrderReq->getTo();
        $messages = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);
        
        if ($memberId == null)
            throw new Exception("EMPTY_MEMBER_ID");
        
        if (!$this->validateId($memberId))
            throw new Exception("INVALID_MEMBER_ID");
                
        $userRepository = new UserRepository();
        if (!$userRepository->checkExist($memberId))
            throw new Exception("NOT_EXIST_MEMBER_ID");  
        
        if ($type != null && (gettype($type) != 'string'
            || (gettype($type) == 'string' && $type != 'D' && $type != 'G')))
            throw new Exception("INVALID_TYPE");
                                
        if ($from != null) {
            if (!$this->validateDate($from))
                throw new Exception("INVALID_FROM_DATE");
        }
        if ($to != null) {
            if (!$this->validateDate($to))
                throw new Exception("INVALID_TO_DATE");
        }
    }
}
?>