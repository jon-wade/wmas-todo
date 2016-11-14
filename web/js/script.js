function create() {
    var newTask = $('#new-task').val();
    $.get('/create/' + newTask).done(location.reload());
}

$(document).ready(function() {
    var editing = false;
    $(document).on('click', 'button', function() {
        var id = $(this).prop('id');
        var action = id.split('-')[0];
        var taskId = id.split('-')[1];
        if(action === 'delete' && taskId !== 'all') {
            $.get('/delete/' + taskId).done(location.reload());
        }
        if(action === 'delete' && taskId === 'all') {
            $.get('/delete-all').done(location.reload());
        }
        else if(action === 'edit' && editing === false) {
            editing = true;
            $(this).replaceWith('<button id="save-' + taskId + '" class="btn btn-success">save</button>');
            var selector =  $('li#' + taskId);
            var editData = selector.text();
            selector.replaceWith('<li id="' + taskId + '"><input type="text" id="input-' + taskId + '" value="' + editData + '" class="form-control edit-copy"/></li>');
        }
        else if(action === 'save') {
            editing = false;
            $(this).replaceWith('<button id="edit-' + taskId + '" class="btn btn-secondary">edit</button>');
            var newData = $('input#input-' + taskId).val();
            $.get('/update/' + taskId + '/' + newData).done(location.reload());
        }
        else if(action === 'create' && $('#new-task').val() !== '') {
            create();
        }
    });
    $(document).on('keypress', function(e) {
        if(e.which === 13 && $('#new-task').val() !== '') {
            create();
        }
    })

});