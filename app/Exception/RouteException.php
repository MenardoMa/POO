<?php

namespace App\Exception;

use Exception;
use Throwable;

class RouteException extends Exception
{
    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function notFound($path)
    {
        http_response_code(404);
        
        ob_start();
        require VIEWS.'views/error/'.$path.'.php';
        $content = ob_get_clean();
        require VIEWS .'views/layout/layout.php';

    }
}