function create() {
    var newTask = $('#new-task').val();
    $.get('/create/' + newTask).done(window.location.reload(true));
}

$(document).ready(function() {
    var editingArr = [];
    $(document).on('click touchstart', 'li', function() {
        var id = $(this).prop('id');
        if(editingArr[id] === undefined || editingArr[id] === false) {
            editingArr[id] = true;
            $('.button-group-' + id).css('display', 'block');
        }
        else if (editingArr[id] && !$(this).children().is('input')) {
            editingArr[id] = false;
            $('.button-group-' + id).css('display', 'none');
        }
    });
    $(document).on('click touch', 'button', function() {
        var id = $(this).prop('id');
        var action = id.split('-')[0];
        var taskId = id.split('-')[1];
        if(action === 'delete' && taskId !== 'all') {
            $.get('/delete/' + taskId).done(window.location.reload(true));
        }
        if(action === 'delete' && taskId === 'all') {
            $.get('/delete-all').done(window.location.reload(true));
        }
        else if(action === 'edit') {
            $(this).replaceWith('<button id="save-' + taskId + '" class="btn btn-success left">save</button>');
            var selector =  $('li#' + taskId);
            var editData = selector.text();
            selector.replaceWith('<li id="' + taskId + '"><input type="text" id="input-' + taskId + '" value="' + editData + '" class="form-control edit-copy"/></li>');
        }
        else if(action === 'save') {
            $(this).replaceWith('<button id="edit-' + taskId + '" class="btn btn-secondary left">edit</button>');
            var newData = $('input#input-' + taskId).val();ß
            $.get('/update/' + taskId + '/' + newData).done(window.location.reload(true));
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