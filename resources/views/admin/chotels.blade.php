<?php use App\Models\Hotel; use App\Models\User;
 ?>

<!-- NOMBRE DE TABLA -->
<div class='container-fluid'>
    <div class="row align-item-start">
        <div class="col fs-1">Lista de Hoteles
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Registrar</button>
        </div>
    </div>
</div>

<!-- TABLA -->
<div class="p-4">
    <table class="table table-striped">
        <thead>
            <tr class="card-header">
                <th scope="col">#</th> <th scope="col">RUC</th>  <th scope="col">Nombre de Usuario</th> <th scope="col">Correo Electrónico</th>  <th scope="col">País</th> <th scope="col">Ciudad</th> <th scope="col">Creado en</th> <th scope="col">Actualizado en</th> <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        
            @php $muestra = User::where('rol','M')->get(); $contador = 1; @endphp
            
            @foreach ($muestra as $filas)
                <tr>
                    <td scope="row">{{ $contador }}</td>
                    <td> {{ Hotel::getRuc($filas->email) }} </td> <td> {{ $filas->name}} </td> <td> {{ Hotel::getEmail($filas->email); }} </td> <td> {{ Hotel::getPais($filas->email) }} </td> <td> {{ Hotel::getCiudad($filas->email) }} </td> <td> {{ $filas->created_at }} </td> <td>{{ $filas->updated_at }}</td>

                    <td><a href="#"><button class="btn btn btn-outline-danger btn-sm" ><i class="bi bi-trash3"></i></button></a></td>
                    @php $contador += 1 @endphp
                </tr>
                
                <?php //$nro_indice = $nro_indice + 1;?>
                
            @endforeach

            
        </tbody>

        
    </table>
</div>



<!-- REGISTER HOTEL -->
<!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            

            <form class="row g-3" action="{{ Route('registrar_hot') }}" method="get">
                
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">RUC del Hotel</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" name="id" required>
                </div>

                <div class="mb-3">
                    <label for="validationCustomUsername" class="form-label">Nombre Oficial del Hotel</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="name" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="test@example.com" name="email" required>
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-select" aria-label="Disabled select example" disabled>
                        <option value="M" selected>Hotel</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="inputEmail4" class="form-label">Location</label>
                    <div class="input-group">
                        
                        <select name="pais" class="form-select" aria-label="Default select example" required>
                            <option>Indique su País</option>
                            <option value="Perú">Perú</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Londres">Londres</option>
                        </select>

                        <input type="text" class="form-control" placeholder="Indique su ciudad" name="ciudad" required>

                        <input type="text" class="form-control" placeholder="1234 Main St" name="direccion" required>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" value="Crear Cuenta">
                </div>

            </form>

            
        </div>
        </div>
    </div>
  </div>