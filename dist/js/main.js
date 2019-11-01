function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image-placeholder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".image").change(function() {
    readImage(this);
});


$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
});

$(document).ready(function(){
    $("#title-field").bind('input', function () {
       $('#slug-field').val($('#title-field').val().toLowerCase().replace(/\s/g, "-"))

   })
});
$(function () {

    $('#data-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
    })
});

$('#datepicker').datepicker({
    autoclose: true
})

$('.timepicker').timepicker({
    showInputs: false
})
