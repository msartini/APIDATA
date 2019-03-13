<!DOCTYPE html>
<html>
<head>
	<title>Backend</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
.td-header {
	font-weight: bold;
	font-size: 16px;
}

.td-city {
    width: 176px;
}

.td-title {
    width: 230px;
}
td {
    vertical-align: initial;
    font-size: 14px;
    border: 1px solid #efefef;
}

select {
	height: 38px;
}

button {
	margin-top: 33px;
    height: 38px;
}
</style>
<div class="container">
    <form  >
         <div class="row">
            <div class="col-md-4 form-group">
                <label>Vaga</label>
                <input class="form-control" name="q" type="text"/>
            </div>
            <div class="col-md-3 form-group">
                <label>Cidade</label><br>
                <select name="cidade">
                    <option value="">Selectione uma Cidade:</option>
                    @foreach ($cities as $city)
                        <option value="{{$city}}">{{$city}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                    <label>Ordenar</label><br>
                    <select name="sort_salary">
                        <option value="">Ordenar por:</option>
                        <option value="desc">Maior Salário</option>
                        <option value="asc">Menor Salário</option>
                    </select>
            </div>
            <div class="col-xs-6 form-group">
                    <button type="submit">Buscar</button>
            </div>
        </div>
        <div class="row">
        	<table>
        		<tr class="td-header">
                    <td class="td-city">Cidade</td>
                    <td class="td-title">Vaga</td>
                    <td>Descrição</td>
                    <td>Salário</td>
                </tr>
        		@foreach ($jobs as $job)
        			<tr><td>{{array_first($job->cidade)}}<td>{{$job->title}}</td><td>{!!$job->description!!}</td><td>{{$job->salario}}</td></tr>
        		@endforeach
        	</table>
        </div>
    </form>
</div>
</body>
</html>
