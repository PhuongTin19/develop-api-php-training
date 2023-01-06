<?php
interface OrderService {
    public function getHistoryOfOrder(HistoryOfOrderReq $historyOfOrderReq);

    public function getHistoryOfOrderOtherWay(
            HistoryOfOrderReq $historyOfOrderReq);
}
?>