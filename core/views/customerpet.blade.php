<?php

use App\modules\pets\core\controllers\PetController;
?>
<div class="box box-default color-palette-box">
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
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Fecha nacimiento</th>
                                <th> </th>
                            </tr>
                            @foreach(PetController::fetchPets($customer->id) as $pet)
                            <tr>
                                <td>{{$pet->name}}</td>
                                <td>{{$pet->type}}</td>
                                <td>{{$pet->birthdate}}</td>
                                <td>
                                    <a class='btn btn-xs btn-success' href="#"><i class='fa fa-eye'></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="col-md-12">
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
    <script>
        window.onload = function ()
        {
            jQuery("#pet_birthdate").datepicker();
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
    </script>