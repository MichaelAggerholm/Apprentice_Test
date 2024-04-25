<nav class="menu">

    <h1>
        <a href="/" class="logo">Sidernes Verden</a>
    </h1>

    <ul>
        <li><a href="{{route('home')}}">Forside</a></li>
        <li><a href="{{route('allBooks')}}">bøger</a></li>

        <?php
        $quantity = 0;

        if (session()->has('cart')) {
            $cart = session()->get('cart');

            foreach ($cart as $item) {
                $quantity += $item['quantity'];
            }
        }
        ?>
        <li><a href="{{route('cart')}}"><span class="info-count">{{$quantity}}</span>Kurv</a></li>

        <li>
            <a href="{{route('account')}}">Bruger</a>
        </li>
    </ul>

</nav>
