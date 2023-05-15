@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
            <section class="featured-posts-section">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ asset('storage/' . $post->preview_image) }}" alt="blog post">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="blog-post-category">{{ $post->category->title }}</p>
                                @auth()
                                    <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                        @csrf
                                        <span class="text-danger">{{ $post->liked_users_count > 0 ? $post->liked_users_count : '' }}</span>
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="{{ auth()->user()->likedPosts->contains($post->id) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                                        </button>
                                    </form>
                                @endauth
                                @guest()
                                    <div>
                                        <span class="text-danger">{{ $post->liked_users_count }}</span>
                                        <i class="far fa-heart text-danger"></i>
                                    </div>
                                @endguest
                            </div>
                            <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{ $post->title }}</h6>
                            </a>
                        </div>
                    @endforeach
                    <div class="row w-100">
                        <div class="mx-auto" style="margin-top: -80px;">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>
@endsection
