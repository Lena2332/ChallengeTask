jQuery(document).ready(function () {
    $('.remove').on('click', function(e){
        e.preventDefault();

        let id = $(this).attr('data-id');
        let type = $(this).attr('data-type');

        const confirmModal = new bootstrap.Modal('#confirmModal',  {
            backdrop: true,
            focus: true,
            keyboard: true,
        });

        confirmModal.show();

        $('.confirm-remove').on('click', function() {

            confirmModal.hide();

            $.ajax({
                url: "/" + type + "/" + id,
                method: 'delete',
                success: function (result) {
                    if (result === 'deleted') {
                        location.reload();
                    }
                }
            });

        });

    });

});