<?php
require_once "Service/Impl/OrderServiceImpl.php";
require_once "Model/Dto/OrderModel.php";
require_once "Model/Dto/ErrorModel.php";
require_once "Model/Req/HistoryOfOrderReq.php";
require_once "Validate/OrderValidation.php";
require_once "Controller.php";

class OrderController extends Controller {
    const BASE_URL = "/api/order";
    private $orderService;

    /**
     * Hàm trả về lịch sử mua hàng của một thành viên.
     *
     * @return array mảng chứa các dữ liệu bao gồm data và http code
     */
    public function getHistoryOfOrder() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod != 'GET')
            return $this->handlePageNotFound();
        $requestObject = array(
            $_GET["memberId"], 
            $_GET["type"], 
            $_GET["from"],
            $_GET["to"]
        );
        $historyOfOrderReq = new HistoryOfOrderReq($requestObject);
        $orderValidation = new OrderValidation();
        $orderValidation->validateHistoryOfOrderReq($historyOfOrderReq);
        $this->orderService = new OrderServiceImpl();
        $response = $this->orderService->getHistoryOfOrder($historyOfOrderReq);
        return $response;
    }

    /**
     * Hàm trả về lịch sử mua hàng của một thành viên theo cách khác.
     *
     * @return array mảng chứa các dữ liệu bao gồm data và http code
     */
    public function getHistoryOfOrderOtherWay() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod != 'GET')
            return $this->handlePageNotFound();
        $requestObject = array(
            $_GET["memberId"], 
            $_GET["type"], 
            $_GET["from"],
            $_GET["to"]
        );
        $historyOfOrderReq = new HistoryOfOrderReq($requestObject);
        $orderValidation = new OrderValidation();
        $orderValidation->validateHistoryOfOrderReq($historyOfOrderReq);
        $this->orderService = new OrderServiceImpl();
        $response = $this->orderService
                ->getHistoryOfOrderOtherWay($historyOfOrderReq);
        return $response;
    }
}
?>