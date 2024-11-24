<?php 

namespace Core;

use Exception;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . "/../Views/" . $view . ".php";

        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View file not found: $viewFile");
        }
    }
}
?>