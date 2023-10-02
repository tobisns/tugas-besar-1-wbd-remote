<?php
require_once __DIR__ . '/../interfaces/ControllerInterface.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Database.php';
class NotFoundController extends Controller  implements ControllerInterface
{

    public function index()
    {
        $db = new Database();
        var_dump($db);
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }
}