$(function () {
    $('#emailForm').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
    }).on('form:submit', function() {
        var str = $("form").serialize();
        $.ajax({ type: "POST", url:  "index.php?url=login/sendEmail", data: {value: str},
            success: function(datos){
                data = JSON.parse(datos);
                $("#alert").html(data.html);
            }
        });
        return false;
    });
});