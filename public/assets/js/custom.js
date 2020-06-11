$(function() {
    // hide all elements with the alert class
    if ($('.alert').length)
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
    // Clear zero values created by mysql
    $('.datepicker').each(function () {
        if ($(this).val() == '0000-00-00')
            $(this).val('');
    });
    $('.slug').slugify('#form_name');
    current_link = window.location.href;
    // var current_path = window.location.pathname.split('/');
    $('.nav li a').each(function () {
        if ($(this).attr('href') == current_link) 
        {
            console.log('true');
            $(this).parent('li').parent('ul').addClass('collapse in');
            $(this).addClass('active');
            // console.log($(this).attr('href'));
        }
    });
    // Select2
    $('.select-from-list').select2({
        theme: "bootstrap"
    });
    $('.cb-checked').click(
        function() {
            if ($(this).is(':checked')) // true
            {
                $('#form_' + $(this).data('input')).val(1);
            }
            else $('#form_' + $(this).data('input')).val(0);
        });
    cbEl = $('.cb-checked');
    cbEl.each(function() {
        if ($('#form_' + $(this).data('input')).val() == '1') {
            $(this).prop('checked', true);
        }
        else $('#form_' + $(this).data('input')).val(0);
    });
// File Upload - TODO: add multiple file upload and preview functionality
    $('#add_img').on('click', function(e) {
        fileUpload = document.getElementById("form_uploaded_file");
        if (fileUpload)
            fileUpload.click();
        // fileUploads = document.getElementById("form_uploads");
        // if (fileUploads)
        //     fileUploads.click();
        return false;
    });
    $('#del_img').click(function(e) {
        ph = $(this).data('ph');
        $.post($(this).attr('href'),
            function(data) {
                $('#file_path').val('')
                $('.upload-img').attr("src", ph);
            });
        e.preventDefault();
    });
    $('#form_uploaded_file').on('change', function() {
        //var filename = $(this).val().split('\\').pop();
        // remove C:\fakepath that is added for security reasons
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('#file_path').val(filename);
        var file = document.getElementById('form_uploaded_file').files[0];
        var preview = document.querySelector('.upload-img');
        
        if (file) {
            // $('#file_item').text(file.name);
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
                $('#file_path').val(file.name);
            }
            // $('#attachment_summary').html('Added 1 attachment. <small>click Save above</small>');
            $('#del_img').css('display', '');
        } else {
            preview.src = '';
        }
    });
});
