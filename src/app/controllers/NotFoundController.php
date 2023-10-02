<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
class NotFoundController extends Controller  implements ControllerInterface
{

    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }
}