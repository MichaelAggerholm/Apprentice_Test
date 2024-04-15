<section class="book-box">
    <div class="image">
        <img src="{{asset('img/books/pandekage_huset.jpg')}}" alt="">
    </div>

    <a href="{{route('book', $book->id)}}">
        <div class="product-title">{{$book->title}}</div>
        <div class="product-category">{{$book->genre->genre}}</div>
        <div class="product-price">{{$book->price}} Dkk,-</div>
    </a>
</section>
