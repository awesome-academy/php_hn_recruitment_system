$('#application-action form').on('submit', async (event) => {
    event.preventDefault();

    const isConfirmed = await confirm();
    if (isConfirmed) {
        event.target.submit();
    }
});

function confirm() {
    //Trigger the modal
    $('#modal-confirm').modal({
        backdrop: 'static',
        keyboard: false,
    });

    return new Promise((resolve) => {
        $('#btn-confirm').on('click', () => {
            $('#modal-confirm').modal('hide');
            resolve(true);
        });

        $('#btn-cancel').on('click', () => {
            $('#modal-confirm').modal('hide');
            resolve(false);
        });
    });
}

//Remove all event listeners once the modal is closed.
$('#modal-confirm').on('hidden.bs.modal', () => {
    $('#btn-confirm').off();
    $('#btn-cancel').off();
});
