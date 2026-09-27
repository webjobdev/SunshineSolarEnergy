<!-- Latest News Section Start -->
<div class="latest-news">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Recent Articles</h3>
                    <h2 class="text-anime">Our Latest News</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $posts = [
                    ['title' => 'Exploring the Latest Innovations in Solar Technology', 'date' => '09 Feb 2024', 'tag' => 'Solar Panel', 'image' => 'post-1.jpg', 'delay' => '0.25s'],
                    ['title' => 'Solar Solutions for a Sustainable Tomorrow', 'date' => '09 Feb 2024', 'tag' => 'Solar Panel', 'image' => 'post-2.jpg', 'delay' => '0.5s'],
                    ['title' => 'Advancements and Breakthroughs in Renewable Power', 'date' => '09 Feb 2024', 'tag' => 'Solar Panel', 'image' => 'post-3.jpg', 'delay' => '0.75s']
                ];
            @endphp
            @foreach($posts as $post)
                <div class="col-lg-4">
                    <div class="blog-item wow fadeInUp" data-wow-delay="{{ $post['delay'] }}">
                        <div class="post-featured-image">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend/images/'.$post['image']) }}" alt="">
                            </figure>
                        </div>
                        <div class="post-item-body">
                            <h2><a href="#">{{ $post['title'] }}</a></h2>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="fa-regular fa-calendar-days"></i> {{ $post['date'] }}</a></li>
                                    <li><a href="#"><i class="fa-solid fa-tag"></i> {{ $post['tag'] }}</a></li>
                                </ul>
                            </div>
                            <div class="btn-readmore">
                                <a href="#" class="btn-default">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Latest News Section End -->