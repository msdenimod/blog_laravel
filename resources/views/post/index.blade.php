@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Блог</h1>
        <section class="featured-posts-section">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 fetured-post blog-post mb-3"  data-aos="fade-up">
                    <div class="blog-post-thumbnail-wrapper">
                        <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="blog-post-category">{{ $post->category->title }}</p>
                        @auth()
                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent">
                                <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                                ({{ $post->liked_users_count }})
                            </button>
                        </form>
                        @endauth
                    </div>
                    <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                        <h6 class="blog-post-title">{{ $post->title }}</h6>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
