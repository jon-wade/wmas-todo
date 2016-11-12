$(document).ready(function() {
    $(document).on('click', 'button', function() {
        var id = $(this).prop('id');
        var action = id.split('-')[0];
        var taskId = id.split('-')[1];
        if(action === 'delete') {
            $.get('/delete/' + taskId).done(location.reload());
        }
        else if(action === 'edit') {
            $(this).replaceWith('<button id="save-' + taskId + '">save</button>');
            var selector =  $('li#' + taskId);
            var editData = selector.text();
            selector.replaceWith('<li id="' + taskId + '"><input type="text" id="input-' + taskId + '" value="' + editData + '"/></li>');
        }
        else if(action === 'save') {
            $(this).replaceWith('<button id="edit-' + taskId + '">edit</button>');
            var newData = $('input#input-' + taskId).val();
            $.get('/update/' + taskId + '/' + newData).done(location.reload());
        }
        else if(action === 'create') {
            var newTask = $('#new-task').val();
            $.get('/create/' + newTask).done(location.reload());
        }
    });

});