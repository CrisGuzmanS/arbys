@extends('layouts.blank')
@section('content')
<div class="container">
	<div class="panel-body">
		<div class="col-lg-6">
			<form action="">
				<div class="input-group">
					<input type="text" 
					       id="cliente" 
					       name="query" 
					       class="form-control" 
					       placeholder="Buscar..."
					       autofocus
					       onKeypress="if(event.keyCode == 13) event.returnValue = false;"
					       > {{--   --}}
					<span class="input-group-btn">
						<a readonly class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a>
					</span>
				</div>
			</form>
		</div>
		<div class="col-lg-6">
			<a class="btn btn-info" 
				href="{{ route('clientes.create')}}"><strong>Agregar Cliente</strong>
			</a>
		</div>
	</div>
			

{{-- TABLA AJAX DE PROVEEDORES --}} 
	<div id="datos" name="datos" class="jumbotron">
		<table class="table table-striped table-bordered table-hover" style="color:rgb(51,51,51); border-collapse: collapse; margin-bottom: 0px">
			<thead>
				<tr class="info">
					<th>@sortablelink('identificador', 'Identificador')</th>
					<th>@sortablelink('nombre', 'Nombre/Razón Social')</th>
					<th>@sortablelink('tipopersona', 'Tipo de persona')</th>
					<th>@sortablelink('rfc', 'RFC')</th>
					<th>@sortablelink('folio', 'Folio')</th>
					<th>@sortablelink('calificacion', 'Calificaciòn') </th>
					<th>Operacion</th>
				</tr>
			</thead>
			 <tbody>
			@foreach($clientes as $cliente)
				<tr class="active"
				    title="Has Click Aquì para Ver"
					style="cursor: pointer"
					href="#{{$cliente->id}}">
					<td>{{$cliente->identificador}}</td>
					<td>
						@if ($cliente->tipopersona == "Fisica")
						{{$cliente->nombre}} {{ $cliente->apellidopaterno }} {{ $cliente->apellidomaterno }}
						@else
						{{$cliente->razonsocial}}
						@endif
					</td>
					<td>{{ $cliente->tipopersona }}</td>
					<td>{{ strtoupper($cliente->rfc) }}</td>
					<td>{{ strtoupper($cliente->folio) }}</td>
					<td>{{$cliente->calificacion}}</td>
					<td>
						<div class="row">
							<div class="col-sm-4">
							<a class="btn btn-success btn-sm" href="{{ route('clientes.show',['id'=>$cliente->id]) }}">
								<i class="fa fa-eye" aria-hidden="true"></i> 
								<strong>Ver
							</strong></a>
						</div>
						<div class="col-sm-4">
							<a class="btn btn-info btn-sm" href="{{ route('clientes.edit',['id'=>$cliente->id]) }}">
								
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <strong>Editar</strong>
							</a>
						</div>
						</div>
				
				</td>
				</tr>
				@endforeach
			 </tbody> 
			</table>
		</div>
			
		


	</div>
{{-- TABLA AJAX DE PROVEEDORES --}}


{{--   TABLA VISTA RÀPIDA  --}}
 @foreach ($clientes as $cliente)
	
	<div class="persona" id="{{$cliente->id}}">
		<div class="container" id="tab">
			<div role="application" class="panel panel-group" >
				<div class="panel-default">
					<div class="panel-heading"><h4>@if ($cliente->tipopersona == "Fisica")
						
						{{ucwords($cliente->nombre)." ".ucwords($cliente->apellidopaterno)." ".ucwords($cliente->apellidomaterno)}}
					@else
						
						{{ucwords($cliente->razonsocial)}}
					@endif:</h4></div>
					
				</div>
				<ul role="tablist" class="nav nav-tabs nav-pills nav-justified">
					<li role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active active"><a href="#tab1{{$cliente->id}}" tabindex="-1">Datos Generales:</a></li>
					<li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="#tab2{{$cliente->id}}" role="tab" tabindex="-1" class="ui-tabs-anchor" id="ui-id-2">Datos para Cotización:</a></li>
					
					<li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="#tab4{{$cliente->id}}" role="tab" tabindex="-1" class="ui-tabs-anchor" id="ui-id-3">CRM:</a></li>
				</ul>
				<div class="panel-default pestana" aria-hidden="false" id="tab1{{$cliente->id}}" style="display: block;">
					<div class="panel-heading">Datos Generales</div>
					<div class="panel-body">
						<div class="col-md-12 offset-md-2 mt-3">
							@if($cliente->tipopersona=='Fisica')
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">

		    					<label class="control-label" for="calle">Nombre Completo:</label>
		    					
		    					<dd>{{ $cliente->nombre }}&nbsp;&nbsp;{{ $cliente->apellidopaterno }}&nbsp;&nbsp;{{ $cliente->apellidomaterno }}</dd>
		    				</div>
		  					@else
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="calle">Razón Social:</label>
		  						<dd>{{$cliente->razonsocial}}</dd>
		  					</div>
		  					@endif
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		    					<label class="control-label" for="numext">ID de Cliente:</label>
		    					<dd>{{ $cliente->identificador }}</dd>
		  					</div>	
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		    					<label class="control-label" for="numinter">Folio de Cliente:</label>
		    					<dd>{{ $cliente->folio }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		    					<label class="control-label" for="cp">Tipo de Persona:</label>
		    					<dd>{{ $cliente->tipopersona }}</dd>
		  					</div>		
						</div>
						<div class="col-md-12 offset-md-2 mt-3" id="perfisica">
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="colonia">RFC:</label>
		  						<dd>{{ strtoupper($cliente->rfc) }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="municipio">Teléfono:</label>
		  						<dd>{{ $cliente->telefono }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="ciudad">Teléfono Celular:</label>
		  						<dd>{{ $cliente->telefonocel }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="estado">Correo(E-mail):</label>
		  						<dd>{{ $cliente->mail }}</dd>
		  					</div>
						</div>
						
					</div>
				</div>
				<div class="panel-default pestana" id="tab2{{$cliente->id}}">

					<div class="panel-heading">Datos para Cotización:</div>
					<div class="panel-body">
						

						<div class="col-md-12 offset-md-2 mt-3" id="perfisica">
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="calle1">Calificación:</label>
		  						<dd>{{ $cliente->calificacion }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="calle2">Promoción:</label>
		  						<dd>{{ $cliente->promocion }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="referencia">Canal de Venta:</label>
		  						<dd>{{ $cliente->canalventa }}</dd>
		  					</div>
		  					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  						<label class="control-label" for="referencia">Ingresos Mensuales:</label>
		  						<dd>{{ $cliente->ingresos }}</dd>
		  					</div>
						</div>
				
					
					
					</div>
				</div>
				<div class="panel-default pestana" id="tab4{{$cliente->id}}">
					<div class="panel-heading">
						CRM:
					</div> 
					
					 @if (count($cliente->crm) == 0)
					<div class="panel-body">
						<h3>Aún no tiene CRM</h3>
					</div>
					@endif
					@if (count($cliente->crm) !=0)
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" style="color:rgb(51,51,51); border-collapse: collapse; margin-bottom: 0px">
							<thead>
								<tr class="info">
									<th>Fecha de Contacto</th>
									<th>Fecha de Aviso</th>
									<th>Tipo de Contacto</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($cliente->crm as $crm)
								<tr class="active">
									<td>{{$crm->fecha_cont }}</td>

									<td>{{$crm->fecha_aviso}}</td>
									
									<td>{{$crm->tipo_cont}}</td>

									<td>{{$crm->status}}</td>
									
								</tr>
								
							@endforeach
							</tbody>
						</table>
					</div>
					@endif 
				 </div>
				
							
			
			</div>
		</div>
	</div>
@endforeach 
					{{--   TABLA VISTA RÀPIDA  --}}





	
 </div> 


@endsection