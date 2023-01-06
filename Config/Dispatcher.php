<?php
foreach (glob("Controller/*.php") as $filePath) {
    require_once $filePath;
}
class Dispatcher {

    const BASE_URL_FOR_CHECK = "::BASE_URL";
    const PATH_TO_CONTROLLER = "Controller/*Controller.php";
    
    /**
     * Hàm để chuyển hướng request đến controller thích hợp.
     * 
     */
    public function dispatch() {
        $response = null;
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        if (substr($uri, -1) == '/') {
            $uri = substr($uri, 0, -1);
        }
        if ($uri != null) {
            $uris = explode("/", $uri);
            if (count($uris) >= 4) {
                $baseUrl = "/" . $uris[1] . "/" . $uris[2];
                $controllerNames = $this->getAllControllerName();
                foreach ($controllerNames as $controllerName) {
                    if ($controllerName::BASE_URL == $baseUrl) {
                        $controllerName = new $controllerName();
                        $lastUri = array_pop($uris);
                        $response = $controllerName->processRequest($lastUri);
                        break;
                    }
                }
            }
        }
        if ($response == null) {
            $response = Controller::handlePageNotFound();
        }
        header($response["status_code"]);
        if ($response["body"]) {
            echo $response["body"];
        }
    }

    /**
     * Hàm lấy danh sách tên các Controller.
     * 
     * @return array mảng tên các Controller
     */
    private function getAllControllerName() {
        $controllerNames = array();
        foreach (glob(self::PATH_TO_CONTROLLER) as $filePath) {
            $uris = explode("/", $filePath);
            if (count($uris) > 0) {
                $fileName = array_pop($uris);
                $controllerName = substr($fileName, 0, -4);
                if (defined($controllerName.self::BASE_URL_FOR_CHECK))
                    array_push($controllerNames, $controllerName);
            }
        }
        return $controllerNames;
    }
}
?>