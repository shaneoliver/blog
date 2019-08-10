<article class="mb-4">
    <h2>
        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
    </h2>
    <div class="d-flex">
        <p class="mr-2"><span class="fad fa-user mr-1"></span>{{ $article->author->name }}</p>
        @if($article->published_at)
            <p class="mr-2"><span class="fad fa-calendar mr-1"></span>{{ $article->published_at->diffForHumans() }}</p>
        @else
            <p class="mr-2"><span class="fad fa-calendar-exclamation mr-1"></span>Unpublished</p>
        @endif
    </div>
    <p>{{ $article->content }}</p>
</article>