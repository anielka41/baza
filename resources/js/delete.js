$(function () {
    $('.delete').click(function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-2 px-4 py-2',
                cancelButton: 'btn btn-danger ms-2 px-4 py-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Czy na pewno chcesz usunąć użytkownika?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id"),

                     // data: { id: $(this).data("id") }
                })
                    .done(function (data) {
                        Swal.fire(
                            'Dobra robota!',
                            'Pozycja została usunięta!',
                            'success'
                        ).then(function() {
                            window.location.reload();
                        });
                        // alert( "SUCCESS ");
                    })
                    .fail(function (data) {
                        console.log(data.responseJSON.message);
                        Swal.fire('Oops...', data.responseJSON.message, 'error');
                    });
            }
        })


    });
});