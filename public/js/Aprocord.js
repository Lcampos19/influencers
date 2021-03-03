$(document).ready(function() {
    Load();
    // AproTable(1);
} );

// setInterval(function(){ AproTable(); }, 60000);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function Load()
{
    $.ajax({ type: "POST", url:  "index.php?url=aprocord/AproLoad",
    success: function(datos)
    { data = JSON.parse(datos); if(data.status == true){ $("#aproTableInt").html(data.html); $('#dateApro').inputmask("99/99/9999"); AproTable(1);} }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function AproSearch()
{
    var str = $("#ServiceApprovals").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=aprocord/AproLoad", data: {str:str, status:'search'},
    success: function(datos)
    { data = JSON.parse(datos); if(data.status == true){   $("#aproTableInt").html(data.html); $('#dateApro').inputmask("99/99/9999"); AproTable(1);} }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function AproTable(page)
{
    $.ajax({ type: "POST", url:  "index.php?url=aprocord/AproTable", data: {page: page},
    success: function(datos)
    { data = JSON.parse(datos); if(data.status == true){   $("#apro").html(data.html); 
        
    } }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function AproView(ticket)
{
    $.ajax({ type: "POST", url:  "index.php?url=aprocord/AproView", data: {ticket: ticket},
        success: function(datos)
        { data = JSON.parse(datos); 
            if(data.status == true){   
                $("#BodyAproCord").html(data.html);
                $('#modalAprocord').modal('show');
                $('#score').change(function()
                {
                    var select = $("#score option:selected").text();
                    if(select == "ERROR")
                    {
                        $.ajax({ type: "POST", url:  "index.php?url=aprocord/ErrorTelevision",
                            success: function(datos){
                                data = JSON.parse(datos);
                                if(data.status == true){ 
                                   $("#errorTV").html(data.html);
                                }
                            }
                        });
                    }else{
                        $("#errorTV").html('');
                    }
                });

            }else{

            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function SaveScoreTv()
{
    var str = $("#ScoreTV").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=aprocord/SaveScoreTv", data: {score: str},
        success: function(datos)
        { data = JSON.parse(datos);
            if (data.status == "NewScore") {
                AproView(data.ticket);
            } 
            if(data.status == true){   
                $("#alarmAproView").html(data.html); 
                $("#store").addClass('hidden');
                $("#button").addClass('hidden');
                Load();
            }else{
                $("#alarmAproView").html(data.html); 
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function SaveScoreInt()
{
    var str = $("#ScoreTV").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=aprocord/SaveScoreInt", data: {score: str},
        success: function(datos)
        { data = JSON.parse(datos); 
            if (data.status == "NewScore") {
                AproView(data.ticket);
            } 
            if(data.status == true){   
                $("#alarmAproView").html(data.html); 
                $("#store").addClass('hidden');
                $("#button").addClass('hidden');
                Load();
            }else{
                $("#alarmAproView").html(data.html); 
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function SaveScoreSec()
{
    var str = $("#ScoreTV").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=aprocord/SaveScoreSec", data: {score: str},
        success: function(datos)
        { data = JSON.parse(datos); 
            if (data.status == "NewScore") {
                AproView(data.ticket);
            } 
            if(data.status == true){   
                $("#alarmAproView").html(data.html); 
                $("#store").addClass('hidden');
                $("#button").addClass('hidden');
                Load();
            }else{
                $("#alarmAproView").html(data.html); 
            }
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function NewRegister()
{
	$.ajax({ type: "POST", url:  "index.php?url=aprocord/NewRegister",
        success: function(datos){
        data = JSON.parse(datos);
        if(data.status == true){ 
        	$("#BodyAproCord").html(data.html); $('#modalAprocord').modal('show'); 
        	$('#phoneprin').inputmask("(999)999-99-99"); 
        	$('#phonealter').inputmask("(999)999-99-99"); 
        	$('#socialsecurity').inputmask("999999999");
        	$('#reception').inputmask("99/99/9999");
        	$('#birthday').inputmask("99/99/9999");
			$('#service').change(function(){
				var select = $('#service').val();
				if(select == ""){ $('#Internet').html(''); $('#Security').html(''); $('#Television').html(''); $('#Referred').html('');}
				if(select == "Internet"){ var link = "index.php?url=aprocord/ServInternet"; var html = "Internet"; }
				if(select == "Security"){ var link = "index.php?url=aprocord/ServSecurity"; var html = "Security"; }
                if(select == "TV"){ var link = "index.php?url=aprocord/ServTelevision"; var html = "Television"; }
				if(select == "Referred"){ var link = "index.php?url=aprocord/ServReferred"; var html = "Referred"; }
				$.ajax({ type: "POST", url:  link,
			    success: function(datos){
    			    data = JSON.parse(datos);
    			    if(data.status == true){ 
    					$('#Internet').html('');
    					$('#Security').html('');
    					$('#Television').html('');
    			    	$('#'+html+'').html(data.html); 
    			    	$('#ccExpTv').inputmask("99/9999");
    			    	$('#ccExpSec').inputmask("99/9999");
    			    	$('#ccExpInt').inputmask("99/9999");
    			    	}	
			    	}
				});
			});

			$('#city').change(function(){
				var id = $('#city').val();
			    $.ajax({ type: "POST", url:  "index.php?url=aprocord/zipCode", data: {id: id},
			    
			    success: function(datos){
			        data = JSON.parse(datos);
			        if(data.status == true){ $("#zipcode").html(data.html); } }
			    });
			});

        } 
    	}
	});
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function SaveService()
{
	var str = $("#FormService").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=aprocord/SaveService", data: {value: str},
        beforeSend: function(objeto){
            $('#alarmTDC').html('<img src="img/loading.gif"> Processing Data...');
        },
        success: function(datos)
        {
        	$('#alartmTDC').html('');
            
            data = JSON.parse(datos);
            
            if(data.status == true)
            {   Load(); $("#alarmTDC").html(data.html); }
            else
            {   Load(); $("#alarmTDC").html(data.html); }
            
        }
    });
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function Date(e)
{
    Key     = (document.all) ? e.keyCode : e.keyCode;
    if (Key==8){ return true; }
    patron  =/[0-9/]/;
    Key_End = String.fromCharCode(Key);
    return  patron.test(Key_End);
}

////////////////////////////////////////////////////////////////////////////////////////////////////

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
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////



