@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Котировки на {{ Request::route('date') }}</h2>
    <div class="row justify-content-center">
        @foreach($data as $dat)
        <div class="col-md-3 mb-3">             
            <div class="card">
                <div class="card-body">
                    <p>ID: {{$dat['@attributes']['ID']}}<br>
                    Код страны: {{$dat['NumCode']}}<br>
                    Буквенный код страны: {{$dat['CharCode']}}<br>
                    Номинал: {{$dat['Nominal']}}<br>
                    Название валюты: {{$dat['Name']}}<br>
                    Стоимость: {{$dat['Value']}} руб.</p>                        
                </div>
            </div>            
        </div>
        @endforeach
    </div>
</div>
@endsection
