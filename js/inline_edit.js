$(function(){
    
    $.fn.editable.defaults.mode = 'popup';
    $('.editable').editable({
        url: './ajax_request.php',
        title: 'Save Comment',
        rows: 10,
        placement: 'right',
        emptytext: 'Add Comment',
        validate: function(value) {
                if($.trim(value) == '') {
                    return 'This field is required';
                }
        }   
        
    });
});