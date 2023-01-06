<?php
require_once "Config/IniFileLoader.php";

class ConfigurationLoader extends IniFileLoader {

    /**
     * コンストラクタ.
     * 
     * @param string $filePath Đường dẫn đến file cần đọc
     */
    function __construct($filePath) {
        parent::__construct($filePath, true);
    }


    /**
     * Hàm lấy cấu hình của database.
     * 
     * @return array mảng chứa config để kết nối Database
     */
    function getDataBaseConfig() {
        return $this->data["CONFIG_DATABASE"];
    }
}
?>