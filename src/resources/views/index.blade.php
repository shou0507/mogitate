<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}" />
    <link rel="stylesheet" href="{{asset('css/index.css')}}?v=10" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h2 class="header__logo">
                mogitate
            </h2>
        </div>
    </header>
    <main class="main">
        <div class="product__header">
            <h2 class="product__title">
                商品一覧
            </h2>
            <a href="/products/register" class="product__button">+ 商品を追加</a>
        </div>

        <form action="/products/search" method="get">
            <div class="product-search">
                <input type="text" class="product-search__input" placeholder="商品名で検索" name="keyword" value="{{request('keyword')}}" />
                <button type="submit" class="product-search__button">
                    検索
                </button>
            </div>

            <div class="product-section">
                <div class="product-sort">
                    <label for="price-sort" class="sort__label">価格順で表示</label>
                    <select name="sort" id="price-sort" class="sort__select">
                        <option value="" selected hidden>価格を並び替え</option>
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    </select>

                @if(request('sort') === 'desc' || request('sort') === 'asc')
                    <div class="sort-tag">
                        <span class="sort-tag__label">
                            @if(request('sort') === 'desc')
                                高い順に表示
                            @elseif(request('sort') === 'asc')
                                低い順に表示
                            @endif
                        </span>
                        <a href="{{url()->current() . '?' . http_build_query(request()->except('sort'))}}" class="sort-tag__close">
                            ×
                        </a>
                    </div>
                @endif
            </div>

            <div class="card-grid">
                @foreach($products as $product)
                <a href="/products/{{$product->id}}" class="card-link">
                    <div class="card">
                        <div class="card__img">
                            <img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}">
                        </div>
                        <div class="card__body">
                            <p class="card__ttl">{{$product->name}}</p>
                            <p class="card__price">¥{{number_format($product->price)}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="pagination">
                {{$products->links()}}
        </div>
        </form>
    </main>
</body>
</html>