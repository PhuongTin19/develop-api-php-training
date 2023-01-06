<?php
require_once "Repository/OrderRepository.php";
require_once "Model/Req/HistoryOfOrderReq.php";
require_once "Service/OrderService.php";
require_once "Common/CommonPath.php";

class OrderServiceImpl implements OrderService {
    private $orderRepository;

    public function __construct() {
        $this->orderRepository = new OrderRepository();
    }

    /**
     * Hàm dùng để lấy lịch sử các đơn hàng. 
     * 
     * @param HistoryOfOrderReq $historyOfOrderReq dữ liệu đầu vào của người dùng chưa được validate
     * @return array mảng chứa data lấy từ database
     */
    public function getHistoryOfOrder(HistoryOfOrderReq $historyOfOrderReq) {
        $messages = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);        
        $result = $this->orderRepository->getHistoryOfOrder($historyOfOrderReq);        
        $response["status_code"] = $messages->getHttpCodeSuccess();
        $response["body"] = json_encode($result);
        return $response;
    }

    /**
     * Hàm dùng để lấy lịch sử các đơn hàng theo cách khác.
     *
     * @param HistoryOfOrderReq $historyOfOrderReq dữ liệu đầu vào của người dùng chưa được validate
     * @return array mảng chứa data lấy từ database
     */
    public function getHistoryOfOrderOtherWay(
            HistoryOfOrderReq $historyOfOrderReq) {
        $messages = new MessageLoader(CommonPath::PATH_TO_ERROR_SOURCE);        
        $resultSql = $this->orderRepository
                ->getHistoryOfOrderOtherWay($historyOfOrderReq);
        $result = OrderModel::convertResultSqlToOrderModel($resultSql);
        $response["status_code"] = $messages->getHttpCodeSuccess();
        $response["body"] = json_encode($result);
        return $response;
    }
}
?>