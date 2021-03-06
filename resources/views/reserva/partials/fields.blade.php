<style>
    .rectangle {
    height: 50px;
    width: 50px;
    background-color: #ffffff;
    border: 2px solid #ffffff;
    border-radius: 5px;

    }
</style>
<div class="card">
    <div class="card-header">
    <h5>{{ $reserva->nome }}</h5>
    </div>
    <div class="card-body">
        <div class="col-sm form-group">
            <form action="/reservas/{{  $reserva->id  }}" method="POST">
                <a class="btn btn-outline-success" href="/reservas/{{  $reserva->id  }}/edit" role="button">Editar</a>
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger" type="submit" name="tipo" value="one" onclick="return confirm('Tem certeza?');">Apagar</button>

                @if($reserva->parent_id != null)
                    <button class="btn btn-outline-danger" type="submit" name="tipo" value="all" onclick="return confirm('Todas instâncias serão deletadas');">Apagar todas instâncias</button> 
                @endif
            </form>
            
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item" ><h6>Nome</h6><a href="/reservas/{{$reserva->id}}">{{  $reserva->nome ?? ''  }}</a></li>
            <li class="list-group-item" ><h6>Data</h6>{{  $reserva->data ?? ''  }}</li>
            <li class="list-group-item" ><h6>Horário de início</h6>{{  $reserva->horario_inicio ?? ''  }}</li>
            <li class="list-group-item" ><h6>Horário de fim</h6>{{  $reserva->horario_fim ?? ''  }}</li>
            <li class="list-group-item" ><h6>Sala</h6>
            @foreach($reserva::salas() as $sala)
                @if($reserva->sala_id == $sala->id)
                    {{  $sala->nome  }}<br>
                @endif
            @endforeach</li>
            <li class="list-group-item" ><h6>Cor</h6><div class="rectangle" style="background-color: {{  $reserva->cor ?? ''  }};"></div></li>
            <li class="list-group-item" ><h6>Descrição</h6>{{ $reserva->descricao ?? '' }}</li>

            <br>
            <b>Reservas do mesmo grupo:</b>
            <ul>
            
            @if($reserva->irmaos())
                @foreach($reserva->irmaos() as $reserva)
                    <li><a href="/reservas/{{ $reserva->id }}">{{ $reserva->data }}</a></li>
                @endforeach
            @endif
            </ul>

        </ul>
        </br>

    </div>
</div>
<br>