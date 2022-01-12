@extends('layouts.main')

@section('content')
<main class="blog-post">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
        <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{ $date->translatedFormat('F') }}, {{ $date->day }}, {{ $date->year }} / {{ $post->comments->count() }} Комментариев </p>
        <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
            <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100">
        </section>
        <section class="post-content">
            {!! $post->content !!}
        </section>
        <section>
            @auth()
                <form action="{{ route('post.like.store', $post->id) }}" method="post">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent">
                        <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                        ({{ $post->liked_users_count }})
                    </button>
                </form>
            @endauth
        </section>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <section class="related-posts">
                    <h2 class="section-title mb-4" data-aos="fade-up">Похожие статьи</h2>
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                            <img src="{{ asset('storage/' . $relatedPost->preview_image) }}" alt="related post" class="post-thumbnail">
                            <p class="post-category">{{ $relatedPost->category->title }}</p>
                            <a href="{{ route('post.show', $relatedPost->id) }}"><h5 class="post-title">{{ $relatedPost->title }}</h5></a>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                @if($post->comments->count() > 0)
                <h2 class="section-title mb-5" data-aos="fade-up">Комментарии ({{ $post->comments->count() }})</h2>
                <section class="comment-list mb-5">
                    @foreach($post->comments as $comment)
                    <div class="comment-item mb-3">
                        <div class="comment-item_user">{{ $comment->user->name }} <span class="comment-item_time">{{ $comment->date->diffForHumans() }}</span></div>
                        <div class="comment-item_message">{{ $comment->message }}</div>
                    </div>
                    @endforeach
                </section>
                @endif
                @auth()
                <section class="comment-section">
                    <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12" data-aos="fade-up">
                                <label for="comment" class="sr-only">Comment</label>
                                <textarea name="message" id="comment" class="form-control" placeholder="Написать комментарий..." rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" data-aos="fade-up">
                                <input type="submit" value="Отправить комментарий" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </section>
                @endauth
            </div>
        </div>
    </div>
</main>
@endsection
