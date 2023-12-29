$(document).ready(function () {
    $('#showPseudoCheckbox').change(function () {
        var isChecked = $(this).prop('checked');
        var valueToSend = isChecked ? 1 : 0;

        $.ajax({
            type: 'POST',
            url: 'updateSettings.php',
            data: { showPseudo: valueToSend },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error('Erreur lors de la requête AJAX:', error);
            }
        });
    });
});

