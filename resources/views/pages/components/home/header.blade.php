<header class="home-header">

    <div class="home-header-text">
        <p class="tagline">En verden af eventyrlige bøger</p>
    </div>

    <div class="home-header-search">
        <form action="/" method="GET">
            <input type="text" name="query" placeholder="Søg på titler, formater, tilstande eller sprog.." value="{{ request()->get('query') }}" />
            <input type="submit" style="display: none;" />
        </form>
    </div>

</header>
