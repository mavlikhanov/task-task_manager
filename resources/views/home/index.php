<?php
/**
 * @var $tasks \App\Collections\TaskCollection
 * @var $task \App\Models\Task
 * @var $viewModel \App\ViewModels\TaskViewModel
 */
?>

<?php if ($errorMessage = errorMessage()): ?>
    <div class="alert alert-danger" role="alert">
        <p>Error validation</p>
        <ul>
            <?php foreach ($errorMessage as $message): ?>
                <li><?php echo $message ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($message = message()): ?>
    <div class="alert alert-success" role="alert">
        <ul>
            <li><?php echo $message ?></li>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-10">
            <div class="col-md-3 pt-2 pb-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Sort:
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/?sort=name&type=asc&page=<?php echo $currentPage ?>">Name Asc</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?sort=name&type=desc&page=<?php echo $currentPage ?>">Name Desc</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?sort=email&type=asc&page=<?php echo $currentPage ?>">Email Asc</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?sort=email&type=desc&page=<?php echo $currentPage ?>">Email Desc</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?sort=is_done&type=asc&page=<?php echo $currentPage ?>">Status Asc</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?sort=is_done&type=desc&page=<?php echo $currentPage ?>">Status Desc</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php foreach ($tasks as $task): ?>
                <div class="card <?php echo $viewModel->getBackgroundTask($task) ?> mb-3"
                     id="task-<?php echo $task->getId() ?>">
                    <?php if (isAuthorized()): ?>
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <input
                                        class="form-check-input js-done-task"
                                        type="checkbox"
                                        value="<?php echo $task->isDone() ?>"
                                        data-task-id="<?php echo $task->getId() ?>"
                                    <?php echo $task->isDone() ? 'checked' : '' ?>
                                >
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#js-edit-task__modal-<?php echo $task->getId() ?>">Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php echo $task->getName() ?></h5>
                        <h5 class="card-title">Email: <?php echo $task->getEmail() ?></h5>
                        <p class="fw-bold">Task text:</p>
                        <p class="card-text">
                            <?php echo $task->getText() ?>
                        </p>
                        <?php if ($task->getCreatedAt() != $task->getUpdatedAt()):?>
                            <span class="badge text-bg-warning">Updated by admin</span>
                        <?php endif;?>
                    </div>
                </div>


                <div class="modal fade" id="js-edit-task__modal-<?php echo $task->getId() ?>" tabindex="-1"
                     aria-labelledby="js-edit-task__modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="edit-task">Edit Task #<?php echo $task->getId() ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/task/update" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $task->getId() ?>">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" id="email" required
                                               placeholder="name@example.com" value="<?php echo $task->getEmail() ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Your name</label>
                                        <input name="name" type="text" class="form-control" id="name" required
                                               placeholder="Your name" value="<?php echo $task->getName() ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="text" class="form-label">Text</label>
                                        <textarea name="text" class="form-control" id="text" required
                                                  rows="3"><?php echo $task->getText() ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary create-task__button">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            <?php if ($tasks->getPagination()->getTotalPages() > 1): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php for ($pageNumber = 1; $pageNumber <= $tasks->getPagination()->getTotalPages(); $pageNumber++): ?>
                            <li class="page-item <?php echo $viewModel->getActivePaginateTab($currentPage, $pageNumber) ?>">
                                <a class="page-link"
                                   href="<?php echo $viewModel->getPaginationUrl($pageNumber, $getData) ?>"><?php echo $pageNumber ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>