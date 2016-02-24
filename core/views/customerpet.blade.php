<?php

use App\modules\pets\core\controllers\PetController;
?>
<div class="box box-default color-palette-box animated fadeInUp">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-paw"></i> Información de mascotas</h3>
        <div class="pull-right">
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addPetModal"><i class="fa fa-plus"></i> Agregar mascota</button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            @if(count(PetController::fetchPets($customer->id))>0)
            <!--pet's table -->
            <div class="box-body table-responsive no-padding">
                <div class="col-md-12">
                    <table class="table table-hover animated fadeInDown">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Fecha nacimiento</th>
                                <th> </th>
                            </tr>
                            @foreach(PetController::fetchPets($customer->id) as $pet)
                            <tr class="animated fadeInUp">
                                <td>{{$pet->name}}</td>
                                <td>{{$pet->type}}</td>
                                <td>{{$pet->birthdate}}</td>
                                <td>
                                    <button class='btn btn-xs btn-success' href="#" data-toggle="modal" data-target="#PetModal" onclick="loadPet({{$pet->id}})"><i class='fa fa-eye'></i></button>
                                    <button class='btn btn-xs btn-danger' onclick="deletePet({{$pet->id}})"><i class='fa fa-trash'></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="col-md-12 animated fadeInUp">
                    <div class="callout callout-warning">
                        <h4>No hay mascotas registradas</h4>
                        <p>Puede registrar una mascota nueva desde el menú situado en la esquina superior izquierda de esta caja.</p>
                    </div>
                </div>
                @endif
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</div>
<script>
    window.onload = function ()
    {
        jQuery("#pet_birthdate").datepicker();
        jQuery("#pet_pic").on('change', prepareUpload);
    }

    /*
     * This function saves the pet
     */
    function savePet()
    {
        jQuery.ajax({
        url: "{{URL::to('/pet/new')}}",
                method: "POST",
                data: {name: jQuery("#pet_name").val(), description: jQuery("#pet_description").val(), type: jQuery("#pet_type").val(), birthdate: jQuery("#pet_birthdate").val(), observations: jQuery("#pet_observations").val(), "fk_client": "{{$customer->id}}"}
        }).done(function (data) {
        if (data == 'ok')
                location.reload();
        else
                alert("Error al asignar la mascota, revise los campos y si el problema persiste contacte con Inforfenix");
        }).fail(function () {
            alert("Error al asignar la mascota, revise los campos y si el problema persiste contacte con Inforfenix");
        });
    }
    /*
     * This function deletes a pet
     */
    function deletePet(fk_pet){
        if (confirm("¿Seguro que desea eliminar esta mascota?")){
        location.href = "{{URL::to('/pet/delete/')}}/" + fk_pet;
        }
    }
</script>
<!-- Modal2 - Pet details -->
<div class="modal fade" id="PetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <img src="" id="pet_image" onclick="uploadPrompt()" style="width: 100%;min-height: 150px;max-height: 300px;"/>
            <div style="margin: 15px;">
                <input type="file" id="pet_pic" style="display:none;"/> <button id="pet_upload" class="btn btn-xs btn-primary" style="display: none;margin-top: 5px;" onclick="uploadPic()"><i class="fa fa-picture-o"></i> Subir foto</button>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Datos básicos</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Revisiones</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Patologías</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Citas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label>Nombre*</label>
                                <input class="form-control" id="pet_name_v" placeholder="Escriba" type="text">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <input class="form-control" id="pet_description_v" placeholder="Escriba" type="text">
                            </div>
                            <div class="form-group">
                                <label>Tipo y raza*</label>
                                <input class="form-control" id="pet_type_v" placeholder="Escriba" type="text">
                            </div>
                            <div class="form-group">
                                <label>Observaciones, patologías, alergias</label>
                                <textarea class="form-control" rows="3" id="pet_observations_v" placeholder="Escriba"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Fecha de nacimiento*</label>
                                <input class="form-control" id="pet_birthdate_v" placeholder="Escriba" type="date">
                            </div>
                        </div>
                        <!-- Revisiones -->
                        <div class="tab-pane" id="tab_2">
                            <button class="btn btn-xs pull-right btn-success"><i class="fa fa-plus"></i> Agregar cita</button>
                            <table class="table table-hover animated fadeInDown">
                                <thead>
                                    <tr>
                                        <td><b>Motivo</b></td>
                                        <td><b>Fecha</b></td>
                                        <td><b>Estado</b></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="petReviewTable">
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- //Revisiones -->
                        <!-- Patologías -->
                        <div class="tab-pane" id="tab_3">
                            
                        </div>
                        <!-- //Patologías -->
                        <!-- Citas-->
                        <div class="tab-pane" id="tab_4">
                            
                        </div>
                        <!-- //Citas-->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="updatePet()">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var file;
    var curr_pet;
    /*
     * Load's pet-info into the modal
     */
    function loadPet(fk_pet)
    {
        //Store a tmp variable with the fk
        curr_pet = fk_pet;
        //Dload data
        jQuery.ajax({
            url: "{{URL::to('/pet/fetch/')}}/" + fk_pet,
                    method: "GET",
            }).done(function (data) {
                //Parse json
                var obj = JSON.parse(data);
                console.log(obj);
                //Set the data
                jQuery("#pet_name_v").val(obj.info.name);
                jQuery("#pet_description_v").val(obj.info.description);
                jQuery("#pet_type_v").val(obj.info.type);
                jQuery("#pet_observations_v").val(obj.info.observations);
                jQuery("#pet_birthdate_v").val(obj.info.birthdate);
                jQuery("#pet_image").attr("src", "data:image/png;base64," + obj.info.pic);
                loadPetReviews(obj.reviews);
            }).fail(function () {
                alert("Error al cargar los detalles de la mascota, contacte con soporte");
        });
    }

    /*
     * Load's the pet reviews info
     */
    function loadPetReviews(data)
    {
        //Empty the table
        jQuery("#petReviewTable").html("");
        //Add a row for-each review
        for(var i=0;i<data.lenght;i++){
            if(data[i].done == 1)
                jQuery("#petReviewTable").append("<tr> <td>"+data[i].name+"</td>  <td>"+data[i].date_revision+"</td>  <td><small class=\"label bg-green\">Ok</small></td>  <td></td> </tr>");
            else
                jQuery("#petReviewTable").append("<tr> <td>"+data[i].name+"</td>  <td>"+data[i].date_revision+"</td>  <td><small class=\"label bg-yellow\">Pendiente</small></td>  <td></td> </tr>");
        }
    }

    /*
     * Opens prompt for upload
     */
    function uploadPrompt()
    {
        jQuery("#pet_pic").show();
        jQuery("#pet_upload").show();
    }
    /*
     * Prepares the file to upload 
     */
    function prepareUpload(event)
    {
        file = event.target.files;
    }

    function uploadPic()
    {
        setTimeout(function () {
        // Create a formdata object and add the files
        var data = new FormData();
        $.each(file, function (key, value)
        {
            data.append(key, value);
        });
        //Add the token and path to the data array
        data.append('id', curr_pet);
        //Send data to the server
        $.ajax({
        url: '{{URL::to("/pet/upload")}}',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR)
                {
                alert("Se ha subido la imagen correctamente");
                location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                alert("Error: " + errorThrown);
                }
        });
        //do what you need here
        }, 2000);
    }
</script>
<!-- Modals -->
<div class="modal fade" id="addPetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar una nueva mascota</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Nombre*</label>
                    <input class="form-control" id="pet_name" placeholder="Escriba" type="text">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <input class="form-control" id="pet_description" placeholder="Escriba" type="text">
                </div>
                <div class="form-group">
                    <label>Tipo y raza*</label>
                    <input class="form-control" id="pet_type" placeholder="Escriba" type="text">
                </div>
                <div class="form-group">
                    <label>Observaciones, patologías, alergias</label>
                    <textarea class="form-control" rows="3" id="pet_observations" placeholder="Escriba"></textarea>
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento*</label>
                    <input class="form-control" id="pet_birthdate" placeholder="Escriba" type="date">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="savePet()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- //Modals -->