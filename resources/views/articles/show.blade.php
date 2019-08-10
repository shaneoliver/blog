@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            <article>
                <h1>{{ $article->title }}</h1>

                <p>{!! nl2br($article->content) !!}</p>
            </article>
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}"><span class="fad fa-edit mr-2"></span>Edit Article</a>
            @endcan
        </div>
    </div>
</div>
@endsection
