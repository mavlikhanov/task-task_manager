<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Actions\HomeControllerIndexAction;
use App\ViewModels\TaskViewModel;
use bootstrap\Request;
use system\App\AbstractController;

class HomeController extends AbstractController
{
    protected string $layout = 'main_layout';

    public function index(Request $request): string
    {
        $action = new HomeControllerIndexAction();
        $items = $action->run($request->getPage(), $request->get());
        return $this->view('home/index', [
            'tasks' => $items,
            'viewModel' => new TaskViewModel(),
            'currentPage' => $request->getPage(),
            'getData' => $request->get()
        ]);
    }
}
