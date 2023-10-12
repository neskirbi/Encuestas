<?php 
  $relacion=GetPlantaActual();
  $relaciones=GetPlantas();
  ?>
  
  @if(count($relaciones))
  <form action="{{url('cambiaplanta')}}" id="cambiaplanta" method="post">
    @csrf
    <select class="form-control" name="planta" id="planta"  onchange="$('#ok').click();">
    
      <option value="{{$relacion->id_planta}}">{{$relacion->planta}}</option>
      <optgroup></optgroup>
      @foreach($relaciones as $relacion)
        <option value="{{$relacion->id_planta}}">{{$relacion->planta}}</option>
      @endforeach
    </select>
    
  </form>
  @endif
  <button style="display:none;" id="ok" data-texto="Quiere cambiar de planta? no olvide actializar las pestañas que tenga abiertes de Reci-trak." onclick="Submite('cambiaplanta',this);"></button>
  