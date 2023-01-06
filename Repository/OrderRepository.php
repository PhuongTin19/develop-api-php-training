<?php
require_once "Model/Dto/OrderModel.php";
require_once "Repository.php";

class OrderRepository extends Repository {
    /**
     * Hàm lấy lịch sử mua hàng từ database.
     * 
     * @param HistoryOfOrderReq $historyOfOrderReq Object của request sau khi đã validate
     * @return array Mảng chứa lịch sử đơn hàng
     */
    function getHistoryOfOrder(HistoryOfOrderReq $historyOfOrderReq) {
        $sql = file_get_contents("Resource/Sql/crm_order_get_history_of_order.sql");
        $sql = $this->setParam($sql, "USER_ID", $historyOfOrderReq->getMemberId(), 'i');
        $sql = $this->setParam($sql, "BOOK_TYPE", $historyOfOrderReq->getType(), 's');
        $sql = $this->setParam($sql, "FROM_DATE", $historyOfOrderReq->getFrom(), 's');
        $sql = $this->setParam($sql, "TO_DATE", $historyOfOrderReq->getTo(), 's');
        $result = $this->select($sql);
        $orders = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order = new OrderModel($row["SET_ID"], $row["SET_NAME"],
                        $row["GENRE_NAME"], $row["AUTHOR_NAME"],
                        $row["ISSUE_DATE"], $row["SET_PRICE"], $row["BOOKS"]);
                array_push($orders, $order->toJson());
            }
        }
        return $orders;
    }

    /**
     * Hàm lấy lịch sử mua hàng từ database theo cách khác.
     * 
     * @param HistoryOfOrderReq $historyOfOrderReq Object của request sau khi đã validate
     * @return array Mảng chứa tất cả các dòng do database trả về
     */
    function getHistoryOfOrderOtherWay(HistoryOfOrderReq $historyOfOrderReq) {
        $sql = file_get_contents("Resource/Sql/crm_order_get_history_of_order_other_way.sql");
        $sql = $this->setParam($sql, "USER_ID", $historyOfOrderReq->getMemberId(), 'i');
        $sql = $this->setParam($sql, "BOOK_TYPE", $historyOfOrderReq->getType(), 's');
        $sql = $this->setParam($sql, "FROM_DATE", $historyOfOrderReq->getFrom(), 's');
        $sql = $this->setParam($sql, "TO_DATE", $historyOfOrderReq->getTo(), 's');
        $result = $this->select($sql);
        $result = $this->select($sql);
        $orders = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($orders, $row);
            }
        }
        return $orders;
    }
}

?>