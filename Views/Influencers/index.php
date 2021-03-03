<?php include LAYOUTS .'head.php'; ?>

<?php include LAYOUTS .'header.php'; ?>

<?php include LAYOUTS .'sidebar.php'; ?>
<div class="content-wrapper">
  <?php
  include LAYOUTS . 'direction.php';
  echo Direct("Index", "Influencers", "Index", "Influencers");
  ?>
  <section class="content">

    <div class="row" id="info1">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-body">
            <form role="form" id="influencerForm">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="i_name" id="i_name" placeholder="Nombre Completo">
                    <div id="eName"></div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="i_email" id="i_email" class="form-control" placeholder="Email" >
                    <div id="eEmail"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Descripcion de la Web</label>
                    <textarea class="form-control" name="i_description" id="i_description" rows="3" placeholder="Descripion de la Web" required></textarea>
                    <div id="eDescription"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="i_url" id="i_url" class="form-control" placeholder="URL" required>
                    <div id="eUrl"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Pais con mayoria de udiencia</label>
                    <select class="form-control" name="i_pais" id="i_pais">
                      <option value="1">Colombia</option>
                      <option value="2">Venezuela</option>
                      <option value="3">Chile</option>
                      <option value="4">Peru</option>
                      <option value="5">Ecuador</option>
                      <option value="6">Argentina</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Idioma</label>
                    <select class="form-control" name="i_idioma" id="i_idioma">
                      <option value="1">Espanol</option>
                      <option value="2">Ingles</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label>Aviso de Publicidad</label>
                  <div class="form-group">
                    <div class="form-check">
                      <div class="radio">
                        <label>
                          <input type="radio" name="i_adv" id="i_adv" value="0" checked>
                          Siempre indicar&eacute; en mis publicaciones patrocinadas que ese texto es publicidad
                        </label>
                      </div>
                    </div>
                    <div class="form-check">
                      <div class="radio">
                        <label>
                          <input type="radio" name="i_adv" id="i_adv" value="1  ">
                          Depender&aacute; de cada caso, de la marca y del producto que hable
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label>Categoria a la que pertenece tu red social (maximo 3)</label>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" name="i_red1" id="i_red1" type="checkbox" checked="">
                        <label class="form-check-label">Animales</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="i_red2" id="i_red2" type="checkbox">
                        <label class="form-check-label">Deportes</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" name="i_red3" id="i_red3" type="checkbox">
                        <label class="form-check-label">Fotograf&iacute;a y Diseno</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" name="i_red4" id="i_red4" type="checkbox">
                        <label class="form-check-label">Diarios</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" name="i_red5" id="i_red5" type="checkbox">
                        <label class="form-check-label">Belleza</label>
                      </div>
                    </div>
                  </div>
                  <div id="eCat"></div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <label>Modo Vacaciones</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Fecha de Inicio de Vacaciones:</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="i_ini" id="i_ini" class="form-control pull-right" id="Inicio de Vacaciones">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Fecha de Fin de Vacaciones:</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="i_end" id="i_end" class="form-control pull-right" id="Fin de Vacaciones">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="eVac"></div>
                  <a href="#"> Desactivar Vacaciones</a>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>wwww.wearecontent.com</label><br>
                        <label>Valor: 200 Cr&eacute;ditos</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <a class="btn btn-primary" onclick="btnNext();" id="btnNext"> Siguiente</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    

    <div class="row" id="info2">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-body">
            <form role="form" id="influencerForm2">
              <input type="text" class="hide" name="db_id" id="db_id">
              <div class="row"> 
                <div class="col-lg-12">
                  <div id="AlertInfluencer"></div>
                  <div class="form-group">
                    <div class="col-sm-12" style="border-style: solid;">
                      <div class="form-check">
                        <input class="form-check-input" name="if_check" id="if_check" type="checkbox">
                        <label class="form-check-label">Foto en Instagram</label>
                      </div>
                      <label>El servicio consiste en Publicar una foto en Instagram con un texto asociado y uno o varios hashtags a elegir por el anunciante</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Valor del descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="if_package" id="if_package" placeholder="Valor del paquete" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Promocion de descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">%</span>
                                <input type="number" class="form-control" name="if_promo" id="if_promo" placeholder="Promocion de descuento" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-sm-12" style="border-style: solid;">
                      <div class="form-check">
                        <input class="form-check-input" name="iv_check" id="iv_check" type="checkbox"> 
                        <label class="form-check-label">Video en Instagram</label>
                      </div>
                      <label>El servicio consiste en publicar un video en Instagram con un texto asociado y uno o varios hashtags a elegir por el anunciante</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Valor del descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="iv_package" id="iv_package" placeholder="Valor del paquete" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Promocion de descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">%</span>
                                <input type="number" class="form-control" name="iv_promo" id="iv_promo" placeholder="Promocion de descuento" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-sm-12" style="border-style: solid;">
                      <div class="form-check">
                        <input class="form-check-input" name="is_check" id="is_check" type="checkbox">
                        <label class="form-check-label">Instagram Story</label>
                      </div>
                      <label>El servicio consiste en publicar un Instagram Story siguiendo el briefing definido por la marca.</label>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Valor del descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="is_package" id="is_package" placeholder="Valor del paquete" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="col-sm-4" style="margin-top: 10px;">
                              <label>Promocion de descuento</label>
                            </div>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-addon">%</span>
                                <input type="number" class="form-control" name="is_promo" id="is_promo" placeholder="Promocion de descuento" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <a href="#" class="btn btn-primary" onclick="btnFinish();" id="btnFinish"> Siguiente</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </section>
</div>
<?php include 'modal.php';?>

<?php include LAYOUTS . 'footer.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#info1').show();
    $('#info2').hide();

    $('#i_ini').datepicker({
      autoclose: true
    });
    $('#i_end').datepicker({
      autoclose: true
    });
  });


function btnNext()
{
    var str = $("#influencerForm").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=influencers/CheckOut", data: {str:str},
    success: function(datos)
    { 
      data = JSON.parse(datos); 

      if(data.status == false)
      {   
        $("#eName").html(data.eName);
        $("#eEmail").html(data.eMail);
        $("#eDescription").html(data.eDescription);
        $("#eUrl").html(data.eUrl);
        $("#eAdv").html(data.eAdv);
        $("#eCat").html(data.eCat);
        $("#eVac").html(data.eVac);
      }else{
        $("#eName").html(''); $("#eEmail").html(''); $("#eDescription").html(''); $("#eUrl").html(''); $("#eAdv").html(''); $("#eCat").html(''); $("#eVac").html('');
          var str = $("#influencerForm").serialize();
          $.ajax({ type: "POST", url:  "index.php?url=influencers/InsertFirst", data: {str:str},
          success: function(datos)
          { 
            data = JSON.parse(datos); 

            if(data.status == true)
            {   
              $('#influencerForm')[0].reset();
              $('#db_id').val(data.id);
              $('#info1').hide();
              $('#info2').show();
            }else{
              $('#ErrorInsert').modal('show');
            }
          }
          });
      }
    }
    });

}

function btnFinish()
{
    var str = $("#influencerForm2").serialize();

    $.ajax({ type: "POST", url:  "index.php?url=influencers/CheckOut2", data: {str:str},
    success: function(datos)
    { 
      data = JSON.parse(datos); 

      if(data.status == true)
      {   
        $('#influencerForm2').html('');
        $('#influencerForm')[0].reset();
        $('#AcceptInsert').modal('show');
        $('#info1').show();
        $('#info2').hide();
      }else{
        $('#AlertInfluencer').html('<div class="alert alert-info fade in">'+data.message+'</div>')
      }
    }
    });

}
</script>

</body>
</html>