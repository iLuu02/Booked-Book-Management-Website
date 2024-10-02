<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class HTTPSFilter implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        if (!\is_cli() && !request->isSecure()){
            $uri = $request->uri;
            $uri->setScheme('https');
            return \redirect()->to((string)$uri);
        }
    }

    public function after (RequestInterface $request, ResponseInterface $response,
    $arguments = null){}
}
?>
