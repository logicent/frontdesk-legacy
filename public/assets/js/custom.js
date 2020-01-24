$(function() {
    // hide all elements with the alert class
    if($('.alert').length)
        $('.alert').delay(5000).fadeOut();

    $('.confirm').on('click', function(){
        bootbox.confirm("Are you sure?", function(result) {
            Example.show("Confirm result: "+result);
        });
    });

    // bootbox.confirm(
    // {
    //       message: message,
    //       buttons: {
    //           confirm: {
    //               label: "OK"
    //           },
    //           cancel: {
    //               label: "Cancel"
    //           }
    //       },
    //       callback: function (confirmed) {
    //           if (confirmed) {
    //               !ok || ok();
    //           } else {
    //               !cancel || cancel();
    //           }
    //       }
    // });

    $('.datatable').dataTable({
        // "ordering": true,
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ -1 ] },
            // { "bSortable": true, "aTargets": [ [0, 'desc'] ] }
        ],
        "order": [[0, 'desc']]
    });

    $('.datepicker').datepicker({
        "format": "yyyy-mm-dd"
    }).on('changeDate', function(ev) {
        $(this).datepicker('hide');
        // set focus back to datepicker control
    });

    $('.slug').slugify('#form_name');

    current_link = window.location.href;

    $('.nav li a').each(function () {
        if ($(this).attr('href') == current_link) 
        {
            $(this).parent('li').parent('ul').addClass('collapse in');

            $(this).addClass('active');
            // console.log($(this).attr('href'));
        }
    });

});
