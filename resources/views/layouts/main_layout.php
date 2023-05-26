<base href="/">
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <div class="">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#js-create-task__modal">New task</button>
                <?php if (!isAuthorized()): ?>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#js-login">Login</button>
                <?php else: ?>
                    <a class="btn btn-danger" href="/logout">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<?php echo $content ?>


<div class="container mt-">

    <div class="modal fade" id="js-create-task__modal" tabindex="-1" aria-labelledby="js-create-task__modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-task">New Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/task/create" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" required
                                   placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your name</label>
                            <input name="name" type="text" class="form-control" id="name" required
                                   placeholder="Your name">
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Text</label>
                            <textarea name="text" class="form-control" id="text" required rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Done</label>
                            <input class="form-check-input js-done-task" name="is_done" type="checkbox">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary create-task__button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="js-login" tabindex="-1" aria-labelledby="js-login" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="auth">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/authorization" method="POST">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input name="login" type="text" class="form-control" id="login" required
                                   placeholder="Login">
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required
                                   placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary create-task__button">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="/js/task-manager.js"></script>
</body>
</html>