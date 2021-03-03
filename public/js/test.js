$(document).ready(function(){
    var loading = $.loading();
    loading.ajax(true)

        Load(1);
    
    loading.ajax(false)
 });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function Load(page)
{    
    $.ajax({ type: "POST", url:  "index.php?url=test/Load", data: {page: page},
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true) { $("#TableTDC").html(data.html); }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function SearchTDC(page)
{
    var loading = $.loading();
    loading.ajax(true);
    var q = $("#TableSearch").val();
    $.ajax({ type: "POST", url:  "index.php?url=test/SearchTDC", data: {page: page, q:q, action:"ajax"},
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true) { $("#TableTDC").html(data.html); }
        }
    });
    loading.ajax(false);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function PaginateTDC(page)
{
    var loading = $.loading();
    loading.ajax(true);
    var q = $("#TableSearch").val();
    $.ajax({ type: "POST", url:  "index.php?url=test/SearchTDC", data: {page: page, q:q, action:"ajax"},
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true) { $("#TableTDC").html(data.html); }
        }
    });
    loading.ajax(false);
}

function load()
{
    
    var q = $("#TableSearch").val();

    $.ajax({
    type: "GET",
    url: "./ajax/clients/index.php",
        success: function(datos){
            $("#bodyclient").html(datos);
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $(".sel_serv_int").select2();
            $(".sel_int_pri").select2();

            $('#won').on('change', function() {
              var value = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "./ajax/clients/zipcode.php",
                    data: "id="+value,
                        success: function(datos){
                            $("#zipbody").html(datos);
                        }
                });
            });
        }
    });
}