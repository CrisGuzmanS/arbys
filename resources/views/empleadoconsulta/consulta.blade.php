@extends('layouts.blank')
@section('content')

<div class="container" align="left">
	<div class="container well well-lg">
		<h4> <strong>Empleados</strong></h4>
			 	 <br /><br />

			 	 <div class="container-fluid">
  	<h4><strong>Resultados
  		<i class="fa fa-television" aria-hidden="true"></i>
  	</h4>

  	</strong>
  	          <br /> 
  	<table class="table table-hover">
    	<thead>
      	<tr>
        	<th>Nombre</th>
        	<th>Apellido Paterno</th>
        	<th>Apellido Materno</th>
        	<th>Puesto</th>
      	</tr>
    	</thead>
    	<tbody>
      	<tr>
        	<td>John</td>
        	<td>Doe</td>
        	<td>Moe</td>
        	<td>Director</td>
      	</tr>
      	<tr>
        	<td>Mary</td>
        	<td>Moe</td>
        	<td>Doe</td>
        	<td>Sub-Director</td>
        </tr>
        <tr>
        	<td>July</td>
        	<td>Dooley</td>
        	<td>Yooled</td>
        	<td>Asistente</td>
        </tr>
        </tbody>
  </table>
			</div>

	</div>
</div>

@endsection