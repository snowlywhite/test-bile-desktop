function solveBallProblem() {
    $.ajax({
        url: "ajax/ajax.php",
        type: "GET",
        data: { 'number': jQuery('#numberOfBalls').val()},
        cache: false,
        success: function (response) {
            jQuery('#result-container').html(response);
        }
    });
}