$(function () {
    $('#loginForm').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
    }).on('form:submit', function() {
        var str = $("form").serialize();
        $.ajax({ type: "POST", url:  "index.php?url=login/login", data: {value: str},
            success: function(datos){

                data = JSON.parse(datos);

                if(data.status == true)
                {
                    window.location.href = data.web;
                }else{
                    $("#alert").html(data.data);
                }
            }
        });
        return false;
    });
});