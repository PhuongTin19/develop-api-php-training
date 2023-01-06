<?php
require_once "Model/Req/HistoryOfOrderReq.php";
require_once "Repository/UserRepository.php";

class Validation {

    const FORMAT_DATE = "Y-m-d";
    const REGEX_NUMBER = "/^[0-9]+$/";

    protected function validateDate($date) {
        $dateFormat = DateTime::createFromFormat(self::FORMAT_DATE, $date);
        return ($dateFormat && $dateFormat->format(self::FORMAT_DATE) === $date);
    }

    protected function validateId($id) {
        if (strlen($id) == 4 && preg_match(self::REGEX_NUMBER, $id))
            return true;
        else
            return false;
    }
}
?>