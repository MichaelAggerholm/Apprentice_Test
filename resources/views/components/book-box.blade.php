<section class="book-box">
    <div class="image">
        <img src="{{asset('storage/' . $book->image)}}" alt="">
    </div>

    <a href="{{route('book', $book->id)}}">
        <div class="book-title">{{$book->title}}</div>
        <!-- TODO: Trim efter 20 tegn og afslut med ".." -->
        <div class="book-genre">{{$book->summary}}</div>
        <div class="book-price">{{$book->price}} Dkk,-</div>
    </a>
</section>
