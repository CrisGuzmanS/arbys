<div class="container">
	<div class="panel panel-group">
		{{-- @include('vendedores.control.head')
		<ul class="nav nav-tabs nav-justified">
			<li class="active"><a href="{{ url('control_vendedores/subgerentes') }}">Subgerentes:</a></li>
			<li><a href="{{ route('control.vendedores.grupos') }}">Grupos:</a></li>
			<li><a href="{{ route('control.vendedores.ven') }}">Vendedores:</a></li>
				
		</ul> --}}
		<div class="panel-body">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-3 form-group">
							<div class="input-group">
								<input type="text" id="buscador" class="form-control" autofocus placeholder="Buscar...">
						        <span class="input-group-btn">
									<a class="btn btn-default" onclick="buscar()">
										<i class="fa fa-search"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
					<div id="vendedores">
						<div class="row">
							<div class="col-sm-12 text-center">
								<table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
									<tr class="info">
										<th class="text-center">Nombre</th>
										<th class="text-center">Número de grupos</th>
										<th class="text-center">Número de vendedores</th>						
										<th class="col-sm-1">Acciones</th>
									</tr>
									@foreach($subgerentes as $subgerente)
										<tr>
											{{-- @if(isset($vendedor->grupo)) --}}
											<td>{{ $subgerente->empleado->nombre}} {{ $subgerente->empleado->appaterno }} {{ $subgerente->empleado->apmaterno }}</td>
											<td>{{ $subgerente->grupos->count() }}</td>
											{{-- @else --}}
												{{-- <td>No asignado</td>
												<td>No asignado</td> --}}
											{{-- @endif --}}
											@php
													$vendedores=0;
													
											@endphp	
											<td>@foreach ($subgerente->grupos as $grupo)
												@php
													$vendedores+=$grupo->vendedores->count();
												@endphp
											@endforeach
											{{$vendedores}}
											</td>
											<td>
												<button class="btn btn-primary detalleg">
													Detalles
												</button>
											</td>
											{{-- <td class="text-center">
												<input type="radio" name="vendedor_id" value="{{ $vendedor->id }}" required="">
											</td> --}}
										</tr>
									@endforeach
								</table>
								<br>
								<br>
								<br>
								<table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;display: none;" id="grupos">
								</table>
								<br>
								<br>
								<br>
								<table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;display: none;" id="vende">									
								</table>
								<br>
								<br>
								<br>
							</div>
						</div>
					</div>
				</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var arreglo_gerentes = [
			@foreach($grupos as $grupo)
				{
					'nombre': "{{ $grupo->subgerente->empleado->nombre }} {{ $grupo->subgerente->empleado->appaterno }} {{ $grupo->subgerente->empleado->apmaterno }}",
					'grupo': @json($grupo),
					'num_vendedores': {{ $grupo->vendedores->count() }},
				},
			@endforeach
		];
		var arreglo_vendedores = [
			@foreach($grupos as $grupo)
				@foreach($grupo->vendedores as $vendedor)
				{
					'nombre': "{{ $grupo->nombre }}",
					'vendedor': @json($vendedor->empleado),
					'clientes': @json($vendedor->contador->last()),
					'objetivo': @json($vendedor->objetivo->last()),
				},
				@endforeach
			@endforeach
		];
		$('.detalleg').click( function(event) {
			var gerente = $(this).parent().parent().children().eq(0).html();
			var contenido = `<tr class="info">
									<th class="text-center">Grupo</th>
									<th class="text-center">Número de Vendedores</th>						
									<th class="col-sm-1">Acciones</th>
								</tr>`;
			$('#grupos').empty();
			$('#grupos').prop('style', 'margin-bottom: 0px;');
			$.each(arreglo_gerentes, function(index, elem) {
				if (elem.nombre == gerente) {
					contenido += `<tr>
									<td>${elem.grupo.nombre}</td>
									<td>${elem.num_vendedores}</td>
									<td>
										<button class="btn btn-primary detallev">Detalles</button>
									</td>
								  </tr>`;
				}
			});
			$('#grupos').append(contenido);
		});

		$('#grupos').on('click','.detallev', function(event) {
			var grupo = $(this).parent().parent().children().eq(0).html();
			var contenido = `<tr class="info">
								<th class="text-center">Vendedor</th>
								<th class="text-center">Objetivo</th>
								<th class="text-center">Clientes</th>
								<th class="text-center">Ventas</th>						
							</tr>`;
			$('#vende').empty();
			$('#vende').prop('style', 'margin-bottom: 0px;');
			$.each(arreglo_vendedores, function(index, elem) {
				if (elem.nombre == grupo) {
					contenido += `<tr>
									<td>${elem.vendedor.nombre} ${elem.vendedor.appaterno} ${elem.vendedor.apmaterno ? elem.vendedor.apmaterno : ' '}</td>
									<td>${elem.objetivo ? elem.objetivo.num_clientes : '--'}</td>
									<td>${elem.clientes ? elem.clientes.total_clientes : '--'}</td>
									<td>${elem.clientes ? elem.clientes.total_ventas : '--'}</td>
								  </tr>`;
				}
			});
			$('#vende').append(contenido);
			//console.log(arreglo_vendedores);

		});
	});

</script>
