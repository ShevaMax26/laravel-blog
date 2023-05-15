@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Blog single page</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{ $data->format('F') }} {{ $data->day }}, {{ $data->year }}
                • {{ $data->format('H:i') }} • {{ $post->comments->count() }} Comments</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <div class="mb-3">{!! $post->content !!};</div>
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
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                    <img src="{{ asset('storage/' . $relatedPost->main_image) }}" alt="related post"
                                         class="post-thumbnail">
                                    <p class="post-category">{{ $relatedPost->category->title }}</p>
                                    <a href="{{ route('post.show', $relatedPost->id) }}" class="text-decoration-none">
                                        <h5 class="post-title">{{ $relatedPost->title }}</h5>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <section class="comment-list mb-5">
                        <h2 class="section-title mb-4" data-aos="fade-up">Comments ({{ $post->comments->count() }})</h2>
                        @foreach($post->comments as $comment)
                            <div class="comment-text mb-3">
                                <div class="username">
                                    <span class="text-danger">{{ $comment->user->name }}</span>
                                    <span
                                        class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                                </div>
                                <div>{{ $comment->message }}</div>
                            </div>
                        @endforeach
                    </section>
                    <section class="comment-section">
                        <h2 class="section-title mb-4" data-aos="fade-up">Leave a Reply</h2>
                        <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea {{ auth()->user() ? '' : 'disabled' }}
                                              name="message" id="comment" class="form-control"
                                              placeholder="{{ auth()->user() ? 'Enter your comment' : 'Only authorized users can comment' }}"
                                              rows="10"></textarea>
                                </div>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    @auth()
                                        <input type="submit" value="Send Message" class="btn btn-warning">
                                    @endauth
                                    @guest()
                                        <a href="{{ route('login') }}" class="btn btn-warning">Login</a>
                                    @endguest
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
