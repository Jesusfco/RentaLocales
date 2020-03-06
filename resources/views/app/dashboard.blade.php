@extends('blades.app')

@section('title', 'Inicio - Estadisticas y resumen')

@section('css')
@endsection

@section('content')
<h3>Inicio</h3>
    
    <div class="row">
        <div class="col l6 s12">
            <div id="piechart"></div>
            <p class="">Locales Pendiente: {{ count($businessNormal) }} / {{ count($businessPend) + count($businessNormal) }}</p>
        </div>
        
        <div class="col l6 s12">
            <div id="piechart2"></div>
            <p class="">Dinero Pendiente: ${{ $moneyPayed }} / ${{ $moneyPend  + $moneyPayed  }}</p>
        </div>
        
        
        <div class="col l6 s12">
            <h5>Negocios con pago Pendiente</h5>
            <table class="striped responsive-table">
                <thead>           
                    <th>Nombre</th>            
                    <th>Local</th>            
                    <th>Día de pago</th>            
                    <th>Ultimo Pago</th>                   
                </thead>
                <tbody>
                @foreach($businessPend as $n)
                
                <tr>            
                    <td><a href=" {{url('app/negocios/ver', $n->id) }}">
                        {{ $n->name }}</a></td>
                    <td>{{ $n->getLocalsView() }}</td>
                    <td>{{ $n->currentMonthly->date_to_pay }}</td>
                    <td>{{ $n->last_receipt->created_at }}</td>            
                
                </tr>
                
                @endforeach
            </tbody>
            </table>
        
        </div>
        <div class="col l6 s12">
            <h5>Negocios sin saldo pendiente</h5>
            <table class="striped responsive-table">
                <thead>           
                    <th>Nombre</th>            
                    <th>Local</th>            
                    <th>Día de pago</th>            
                    <th>Fecha de Pago</th>                   
                </thead>
                <tbody>
                @foreach($businessNormal as $n)
                
                <tr>            
                    <td><a href=" {{url('app/negocios/ver', $n->id) }}">
                        {{ $n->name }}</a></td>
                    <td>{{ $n->getLocalsView() }}</td>
                    <td>{{ $n->currentMonthly->date_to_pay }}</td>
                    <td>{{ $n->last_receipt->created_at }}</td>            
                
                </tr>
                
                @endforeach
            </tbody>
            </table>
        
        </div>

    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
 
	function drawChart() {
 
		var data = google.visualization.arrayToDataTable([
            ['Estatus de Negocio', '#'],
			['Locales Pendientes', {{ count($businessPend) }} ],
			['Negocios Al corriente', {{ count($businessNormal) }} ],			
		]);
 
 
		// grafico en 2d
		var options = {
			title: 'Estadisticas de Negocios'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);

        var data = google.visualization.arrayToDataTable([
            ['Mensualidades', 'Dinero'],
			['Por Cobrar', {{ $moneyPend}} ],
			['Cobrado', {{ $moneyPayed }} ],			
		]);
 
 
		// grafico en 2d
		var options = {
			title: 'Dinero Por Cobrar'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
		chart.draw(data, options);
 
		
	}

</script>
@endsection