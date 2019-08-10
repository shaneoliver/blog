@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            @each('articles.tease', $articles, 'article')

            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
