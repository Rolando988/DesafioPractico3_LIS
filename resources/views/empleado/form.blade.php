<h1>{{$modo}} receta </h1>

@if(count($errors)>0)


<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li> 
@endforeach
</ul>
</div>

@endif



<div class="form-group">

<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name ="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre">


</div>

<div class="form-group">
<label for="ApellidoPaterno">Tipo</label>
<input type="text" class="form-control" name ="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">

</div>

<div class="form-group">
<label for="ApeliidoMaterno">Ingredientes</label>
<textarea  class="form-control" name ="ApeliidoMaterno" rows="5" value="" id="ApeliidoMaterno">{{ isset($empleado->ApeliidoMaterno)?$empleado->ApeliidoMaterno:old('ApeliidoMaterno') }}</textarea>

</div>

<div class="form-group">
<label for="Correo">Preparacion</label>
<textarea type="text" class="form-control" name ="Correo" rows="5" value="" id="Correo">{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}</textarea>

</div>

<div class="form-group">
<label for="Foto"></label>
@if(isset($empleado->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto  }}" width="100" alt="">
@endif
<input type="file" name ="Foto" class="form-control" id="Foto">

</div>

<input class="btn btn-success" type="submit" value="{{$modo}} receta ">

<a  class="btn btn-primary" href="{{url('empleado/')}}">Regresar</a>
