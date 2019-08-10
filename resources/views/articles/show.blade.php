@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            <article>
                <h1>{{ $article->title }}</h1>

                <p>{{ $article->content }}</p>
            </article>
        </div>
    </div>
</div>
@endsection
