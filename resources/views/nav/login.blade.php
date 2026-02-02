@extends('layouts.app')
@section('content')

<input type="text" id="search" placeholder="Buscar artículos...">
<ul id="results"></ul>

<div class="container" id="container">
    <div id="listadoarticulos" class="column">
        <h1>Artículos</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Crear artículo</a>
        @foreach($articles as $article)
        <div class="card mt-3" id="articulo_{{ $article->id }}">
            <div class="card-body">
                <h3><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>
                <p>{{ Str::limit($article->content, 150) }}</p>
                <input type="button" value="Eliminar" name="Eliminar" class="btn_eliminar">
                <!-- <button class="btn_elimin" data-id="{{ $article->id }}">Delete</button> -->
            </div>
        </div>

        @endforeach
    
        <div class="mt-3">

        </div>
    </div>
    <div id="detallearticulo" class="column">
        <h1>this is teh fucking login page</h1>
    </div>


</div>
@endsection