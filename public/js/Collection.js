////////////////////////////////////////////////////////////////////////////////////////////////////
	
$('#dataTDC').DataTable({
	aLengthMenu: [5, 10, 15, 20],
    select: { style: 'single' },
    pageLength: 5
});

$('#dataCB').DataTable({
	aLengthMenu: [5, 10, 15, 20],
    select: { style: 'single' },
    pageLength: 5
});

$('#accountbank').DataTable({
    aLengthMenu: [5, 10, 15, 20, 50, 100],
    pageLength: 20
});


$(document).on('change', '#typeSelect', function(event) {
    var id = $("#typeSelect option:selected").val();

    if((id == "")){ 
        $('#dateLogReports').prop("hidden",true); 
        $('#dataLogReports').prop("hidden",true);
        $('#cardLogReports').prop("hidden",true);
    }
    if((id == 1) || (id == 2) || (id == 3)){ 
        $('#dateLogReports').prop("hidden",false);
        $('#dataLogReports').prop("hidden",true);
        $('#cardLogReports').prop("hidden",true);
    }
    if((id == 4)){ 
        $('#dateLogReports').prop("hidden",true);
        $('#dataLogReports').prop("hidden",false);
        $('#cardLogReports').prop("hidden",true);
    }
    if((id == 5)){ 
        $('#dateLogReports').prop("hidden",true);
        $('#dataLogReports').prop("hidden",true);
        $('#cardLogReports').prop("hidden",false);
    }

});

////////////////////////////////////////////////////////////////////////////////////////////////////

$("#csv").change(function() {

    var fd = new FormData();
    fd.append('csv', this.files[0]);

    $.ajax({
        url: "index.php?url=collection/Upload",
        type: "post",
        dataType: 'json',
        processData: false,
        contentType: false,
        data: fd,
        beforeSend: function(objeto){
            $('#alarmUpload').html('<img src="img/loading.gif"> Processing Data...');
        },
        success: function(datos){

           if(datos.status == true)
           {
                $("#alarmUpload").html('');
				$("#alarmUpload").html(datos.html);
                window.location.href = 'index.php?url=collection/ReportCB';
            }else{

				$('#alarmUpload').html('');
            $('#alarmUpload').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4><strong>Error.!</strong>, The file type dont corresspond to the necessary format <strong>Trye Again</stron></div>');
            }
        },
        error: function() {
            $('#alarmUpload').html('');
            $('#alarmUpload').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4><strong>Error.!</strong>, The file type dont corresspond to the necessary format <strong>Trye Again</stron></div>');
        }
    });
});

////////////////////////////////////////////////////////////////////////////////////////////////////

function Notes(id)
{    
    $.ajax({ type: "POST", url:  "index.php?url=collection/Logs", data: {value: id},
	beforeSend: function(objeto){
        $('#alarmTDC').html('<img src="img/loading.gif"> Processing Data...');
    },
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ 
        	$('#alarmTDC').html('');
            $("#bodySuccess").html(data.html);
			$('#dataLog').DataTable({
				aLengthMenu: [5, 10, 15, 20],
			    pageLength: 5
			});
			$('#modal-Success').modal('show');
        	} 
    	}
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Logs(id)
{
 	
 	$.ajax({ type: "POST", url:  "index.php?url=collection/Logs", data: {value: id},
	beforeSend: function(objeto){
        $('#alarmTDC').html('<img src="img/loading.gif"> Processing Data...');
    },
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ 
            $('#alarmTDC').html('');
            $("#bodySuccess").html(data.html);
            $('#dataLog').DataTable({
                aLengthMenu: [5, 10, 15, 20],
                pageLength: 10
            });
            $('#modal-Success').modal('show');
            } 
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Cards(id)
{
    $.ajax({ type: "POST", url:  "index.php?url=collection/Cards", data: {value: id},
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ $("#bodyTDCModal").html(data.html); $('#modal-alert').modal('show'); } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function CB(id)
{
    $.ajax({ type: "POST", url:  "index.php?url=collection/CB", data: {value: id},
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ $("#bodyTDCModal").html(data.html); $('#modal-alert').modal('show'); } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Create()
{
    var str = $("#ViewTDC").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=collection/Create", data: {value: str},

        success: function(datos)
        {
            data = JSON.parse(datos);

            if(data.status == true)
            {   $("#bodyTDCModal").html(data.html); }
            else
            {   $("#alarmTDC").html(data.html); }
            
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Edit()
{
    var str = $("#ViewTDC").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=collection/Edit", data: {value: str},

        success: function(datos)
        {
            data = JSON.parse(datos);
            if(data.status == true)
            {   $("#bodyTDCModal").html(data.html); }
            else
            {   $("#alarmTDC").html(data.html); }
            
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Delete()
{
    var str = $("#ViewTDC").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=collection/Delete", data: {value: str},

        success: function(datos)
        {
            data = JSON.parse(datos);
            if(data.status == true)
				if(data.functions == 'Create')
                {
                    Cards(data.idClient);
                }else{
                	$("#bodyTDCModal").html(data.html);	
                }
            else
            {   $("#alarmTDC").html(data.html); }
            
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Store()
{
    var str     =   $('#StoreTDC').serialize();
        $.ajax({ type: "POST", url:  "index.php?url=collection/Store", data: {value : str},
        success: function(datos){
            data = JSON.parse(datos);
            if(data.status == true)
            {
                 if(data.functions == 'Create')
                 {
                    Cards(data.idClient);

                 }else{

                    $("#bodyTDCModal").html(data.html);
                }
            }else{
                $("#alarmType").html(data.html); 
                $("#alarmMesAll").html(data.mesAll);
                $("#alarmMesSin").html(data.mesSin);
                $("#alarmMesCon").html(data.mesCon);
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function AuthView()
{
    var str     =   $('#AuthTDC').serialize();
        $.ajax({ type: "POST", url:  "index.php?url=collection/AuthView", data: {value : str},
        success: function(datos){
            data = JSON.parse(datos);

            if(data.status == true)
            { 
                 if((data.functions == "Create") || (data.functions == "Delete") || (data.functions == "Batch"))
                 {
                    Cards(data.idClient);

                 }else{

                     $("#bodyTDCModal").html(data.html);  
                 }

            }else{

                $("#alarmAuthTDC").html(data.html); 
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function BatchAuth(status)
{

    var id = $("#idClient").val();
       
    $.ajax({ type: "POST", url:  "index.php?url=collection/BatchAuth", data: {status: status, id: id},
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true)
            { 
                $("#bodyTDCModal").html(data.html);

            }else{
                $("#alarmBatch").html(data.html); 
            } 
        }
    });

}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Duplicate(id)
{
    var cont;
    cont = $("#card").val().length;

    if(cont >= 14)
    {
        var str     =   $('#StoreTDC').serialize();
        $.ajax({ type: "POST", url:  "index.php?url=collection/Duplicate", data: {str : str},
        success: function(datos){
            data = JSON.parse(datos);
            if(data.status == false){
                $("#alarmMesAll").html(data.mesAll);
            } else { $("#alarmStore").html('') } }
        });
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Payment()
{
    var str     =   $('#ViewTDC').serialize();
        $.ajax({ type: "POST", url:  "index.php?url=collection/Payment", data: {value : str},
   		beforeSend: function(objeto){
            $('#alarmTDC').html('<img src="../../img/loading.gif"> Processing Data...');
        },
        success: function(datos){
            data = JSON.parse(datos);
            if(data.status == true)
            { 	$('#alarmTDC').html('');
            	$('#modal-alert').modal('hide')
            	$("#bodySuccess").html(data.html);
            	$('#modal-Success').modal('show')
            }else{
                $("#alarmTDC").html(data.html); 
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function PaymentCB()
{
    var str     =   $('#ViewCB').serialize();

    $.ajax({ type: "POST", url:  "index.php?url=collection/PaymentCB", data: {value : str},

        beforeSend: function(objeto){
            $('#alarmCB').html('<img src="../../img/loading.gif"> Processing Data...');
        },
        success: function(datos){
            data = JSON.parse(datos);
            if(data.status == true)
            {   $('#alarmCB').html('');
                $("#alarmCB").html(data.html);
            }else{
                $('#alarmCB').html('');
                $("#alarmCB").html(data.html); 
            }
        }
    });
}
////////////////////////////////////////////////////////////////////////////////////////////////////

function Type(id)
{
    $.ajax({ type: "POST", url:  "index.php?url=collection/Type", data: {id: id},
    success: function(datos){ data = JSON.parse(datos); $("#inputType").html('');  $("#inputType").html(data.html); }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Back(id)
{
    $('#modal-success').modal('hide');

    $.ajax({ type: "POST", url:  "index.php?url=collection/Cards", data: {value: id},
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ $("#bodyTDCModal").html(data.html); $('#modal-alert').modal('show'); } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function BackCB(id)
{
    $('#modal-success').modal('hide');

    $.ajax({ type: "POST", url:  "index.php?url=collection/Cards", data: {value: id},
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ $("#bodyTDCModal").html(data.html); $('#modal-alert').modal('show'); } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function PaymentInvoice()
{
    $.ajax({ type: "POST", url:  "index.php?url=collection/PaymentInvoice",
    
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ $("#bodyTDCModal").html(data.html); $('#modal-alert').modal('show'); } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function PaymentSingle()
{
	var str     =   $('#SinglePayment').serialize();

    $.ajax({ type: "POST", url:  "index.php?url=collection/PaymentSingle", data: {str: str},
   
	beforeSend: function(objeto){
        $('#alarmPayment').html('<img src="../../img/loading.gif"> Processing Data...');
    },
    success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true)
        { 	$('#alarmPayment').html('');
        	$('#modal-alert').modal('hide')
        	$("#bodySuccess").html(data.html);
        	$('#modal-Success').modal('show');
        }else{
            $("#alarmPayment").html(data.html); 
        }
    }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Reports()
{
    var id = $('#typeSelect').val();
    var date = $('#date').val();
    var clie = "";
    var bill = "";
    var auth = "";
    var user = "";
    date = date.replace('/','-');
    if((id == 1) || (id == 2) || (id == 3))
    {
        window.location.href = 'index.php?url=collection/Reports/'+id+'/'+date+'';        
    }
    if(id == 4){
        if($('#client').val() == '')        { clie == 'null'; }else{ clie = $('#client').val(); }
        if($('#bill').val() == '')          { bill == 'null'; }else{ bill = $('#bill').val(); }
        if($('#authorization').val() == '') { auth == 'null'; }else{ auth = $('#authorization').val(); }
        if($('#username').val() == '')      { user == 'null'; }else{ user = $('#username').val(); }
        
        window.location.href = 'index.php?url=collection/Reports/'+id+'/'+clie+'/'+bill+'/'+auth+'/'+user+'';    }
    if(id == 5){
        window.location.href = 'index.php?url=collection/Reports/'+id+'/'+$('#creditcard').val()+'';
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Date(e)
{
    Key     = (document.all) ? e.keyCode : e.which;
    if (Key==8){ return true; }
    patron  =/[0-9/]/;
    Key_End = String.fromCharCode(Key);
    return  patron.test(Key_End);
}

function Date2(e)
{
    Key     = (document.all) ? e.keyCode : e.which;
    if (Key==8){ return true; }
    patron  =/[0-9-]/;
    Key_End = String.fromCharCode(Key);
    return  patron.test(Key_End);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Amount(e)
{
    Key     = (document.all) ? e.keyCode : e.which;
    if (Key==8){ return true; }
    patron  =/[0-9.]/;
    Key_End = String.fromCharCode(Key);
    return  patron.test(Key_End);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Number(e)
{
    Key     = (document.all) ? e.keyCode : e.which;
    if (Key==8){ return true; }
    patron  =/[0-9.]/;
    Key_End = String.fromCharCode(Key);
    return  patron.test(Key_End);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function PagoCB(id) 
{
    var idClient     = $('#id_'+id+'').val();
    var invoices     = $('#i_'+id+'').val();
    var routing      = $('#r_'+id+'').val();
    var amount       = $('#m_'+id+'').val();

    if((routing == "") || (amount == ""))
    {
        swal("Alert!", "The fields can not be empty!", "info");

    }else{

        $.ajax({ type: "POST", url:  "index.php?url=collection/paymentRecordCB", 
            data: { idClient: idClient, invoices: invoices, routing: routing,  amount:amount},
       
        beforeSend: function(objeto)
        {
            $('#s_'+id+'').html('');
            $('#e_'+id+'').html('');
            $('#r_'+id+'').prop("disabled",true); 
            $('#m_'+id+'').prop("disabled",true); 
            $('#s_'+id+'').html('<img src="../../img/loading.gif">');
        },
        success: function(datos)
        {
            data = JSON.parse(datos);
            if(data.status == true)
            {   
                $('#s_'+id+'').html('');
                $('#s_'+id+'').html(data.html);
                $('#e_'+id+'').html(data.html);   
            }
        }
        });
    }


}
////////////////////////////////////////////////////////////////////////////////////////////////////

$("#csv").change(function() {

    var fd = new FormData();
    fd.append('csv', this.files[0]);

    $.ajax({
        url: "index.php?url=collection/Upload",
        type: "post",
        dataType: 'json',
        processData: false,
        contentType: false,
        data: fd,
        beforeSend: function(objeto){
            $('#alarmUpload').html('<img src="img/loading.gif"> Processing Data...');
        },
        success: function(datos){

           if(datos.status == true)
           {
                $("#alarmUpload").html('');
                $("#alarmUpload").html(datos.html);
                window.location.href = 'index.php?url=collection/ReportCB';
            }else{

                $('#alarmUpload').html('');
            $('#alarmUpload').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4><strong>Error.!</strong>, The file type dont corresspond to the necessary format <strong>Trye Again</stron></div>');
            }
        },
        error: function() {
            $('#alarmUpload').html('');
            $('#alarmUpload').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4><strong>Error.!</strong>, The file type dont corresspond to the necessary format <strong>Trye Again</stron></div>');
        }
    });
});

////////////////////////////////////////////////////////////////////////////////////////////////////