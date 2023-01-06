<?php
require_once "Repository.php";

class UserRepository extends Repository {

    /**
     * Hàm kiểm tra sự tồn tại của user trong hệ thống.
     * 
     * @param int $userId Object của request sau khi đã validate
     * @return true: Khi có tồn tại, false: Khi không tồn tại
     */
    function checkExist($userId) {
        $sql = file_get_contents(
                $_SERVER['DOCUMENT_ROOT']
                        . "/Resource/Sql/crm_user_check_exist.sql");     
        $sql = $this->setParam($sql, "USER_ID", $userId, 'i');        
        $check = $this->selectSingleValue($sql, "USER_ID");        
        if ($check != null)
            return true;
        return false;
    }
}

?>