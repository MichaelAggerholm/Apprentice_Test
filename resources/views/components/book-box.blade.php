<section class="book-box">
    <div class="image">
        <img src="{{asset('storage/' . $book->image)}}" alt="">
    </div>

    <div class="book-box-content-container">
        <a href="{{route('book', $book->id)}}">
            <div class="book-title">{{$book->title}}</div>
            <div class="book-summary">{{ mb_substr($book->summary, 0, 85, 'UTF-8') . (strlen($book->summary) > 20 ? '..' : '') }}</div>
            <div class="book-price">{{$book->price}} Dkk,-</div>
        </a>
    </div>
</section>
