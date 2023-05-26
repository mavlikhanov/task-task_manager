document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.querySelectorAll('.js-done-task');

    checkbox.forEach(function (checkbox) {
        checkbox.addEventListener('change', function() {
            const taskId = checkbox.getAttribute('data-task-id');
            const isDone = checkbox.checked;

            const formData = new FormData();
            formData.append('id', taskId);
            formData.append('is_done', isDone);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/task/status/update', true);

            xhr.send(formData);

            xhr.addEventListener('load', function() {
                if (xhr.status === 202) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.result === true) {
                        const taskId = checkbox.getAttribute('data-task-id');
                        const taskElement = document.getElementById('task-' + taskId);
                        taskElement.classList.toggle('text-bg-secondary');
                        taskElement.classList.toggle('text-bg-success');
                    }
                }
            });
        });
    });
});