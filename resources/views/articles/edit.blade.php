@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            <form method="POST" action="{{ route('articles.update', $article) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="form-label">{{ __('Article Title') }}</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $article->title) }}" autocomplete="title" autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">{{ __('Article Content') }}</label>
                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="content" rows="5">{{ old('content', $article->content) }}</textarea>                    
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save Article</button>
                <a class="btn btn-link" href="{{ route('articles.show', $article) }}">cancel</a>
            </form>
        </div>
        <div class="col-12 col-md-2 col-lg-4">
            <form method="POST" action="{{ route('articles.destroy', $article) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Article</button>
            </form>
        </div>
    </div>
</div>
@endsection
