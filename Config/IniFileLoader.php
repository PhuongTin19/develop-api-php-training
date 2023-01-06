<?php
class IniFileLoader {
    protected $filePath;
    protected $data;

    /**
     * コンストラクタ.
     * 
     * @param string $filePath đường dẫn đến file cần đọc
     * @param boolean $parseWithSections giá trị cho biết có đọc file chia theo section không
     */
    function __construct($filePath, $parseWithSections = false) {
        $this->filePath = $filePath;
        $this->data = parse_ini_file($this->filePath, $parseWithSections);
    }

    /**
     * Hàm lấy data đọc được từ file.
     * 
     * @return array Mảng chứa các giá trị trong file
     */
    function getData() {
        return $this->data;
    }
}
?>