<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
abstract class BaseController extends Controller
{
 public function initController(
 RequestInterface $request,
 ResponseInterface $response,
 LoggerInterface $logger
 ) {
 parent::initController($request, $response, $logger);
 }
 /*** Mengirim response JSON (berguna untuk AJAX/API)
 */
 protected function jsonResponse(array $data, int $statusCode = 200)
 {
 return $this->response
 ->setStatusCode($statusCode)
 ->setJSON($data);
 }
 /**
 * Cek apakah request adalah AJAX
 */
 protected function isAjax(): bool
 {
 return $this->request->isAJAX();
 }
}