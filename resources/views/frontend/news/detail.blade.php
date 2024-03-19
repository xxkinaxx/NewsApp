@extends('frontend.parent')

@section('content')
<section class="single-post-content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 post-content" data-aos="fade-up">
                <div class="single-post">
                    <div class="post-meta"><span class="date">{{ $news->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                    <h1 class="mb-5">{{ $news->title }}</h1>
                    <img src="{{ $news->image }}" alt="" class="img-fluid">
                    <p>

                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <!-- ======= Sidebar ======= -->
                <div class="aside-block">

                    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <!-- Popular -->
                        <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                            @foreach ($sideNews->random(5) as $row)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $row->created_at->diffForHumans() }}</span></div>
                                <h2 class="mb-2"><a href="#">{{ $row->title }}</a></h2>
                                <span class="author mb-3 d-block">Admin</span>
                            </div>
                            @endforeach
                        </div> <!-- End Popular -->

                        <!-- Trending -->
                        <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                            @foreach ($sideNews->random(5) as $row)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $row->created_at->diffForHumans() }}</span></div>
                                <h2 class="mb-2"><a href="#">{{ $row->title }}</a></h2>
                                <span class="author mb-3 d-block">Admin</span>
                            </div>
                            @endforeach
                        </div> <!-- End Trending -->

                        <!-- Latest -->
                        <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                            @foreach ($sideNews->random(5) as $row)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $row->created_at->diffForHumans() }}</span></div>
                                <h2 class="mb-2"><a href="#">{{ $row->title }}</a></h2>
                                <span class="author mb-3 d-block">Admin</span>
                            </div>
                            @endforeach

                        </div> <!-- End Latest -->

                    </div>
                </div>
                <div class="aside-block">
                    <h3 class="aside-title">Categories</h3>
                    <ul class="aside-links list-unstyled">
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Culture</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Sport</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Food</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Politics</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Startups</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Travel</a></li>
                    </ul>
                </div><!-- End Categories -->
            </div>
        </div>
</section>
@endsection