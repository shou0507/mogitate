<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}" />
    <link rel="stylesheet" href="{{asset('css/show.css')}}?v=6" />
</head>
<body>
    <header class="header">
        <div class="header inner">
            <h2 class="header__logo">
                mogitate
            </h2>
        </div>
    </header>
    <main class="main">
    <div class="container">
        <form action="/products/{{ $product->id }}/update" class="product-edit" method="post" enctype="multipart/form-data">
            @csrf
            <div class="product-edit__top">
                <div class="product-edit__image">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-edit__image-img">
                    <label class="product-edit__image-label">
                        <input type="file" name="image" accept="image/*">
                    </label>
                    @error('image')
                    <div class="form-error">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="product-edit__fields">

                    {{-- 商品名 --}}
                    <div class="form-group">
                        <label class="form-label">商品名</label>
                        <input type="text" class="form-input" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                        @error('name')
                        <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- 価格（class名とnameを修正） --}}
                    <div class="form-group">
                        <label class="form-label">価格</label>
                        <input type="text" class="form-input" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                        @error('price')
                        <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- 季節（fields の中に入れる） --}}
                    <div class="form-group">
                        <div class="form-label">季節</div>
                        <div class="season-group">
                            @foreach($seasons as $season)
                                <label class="season-item">
                                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, $product->seasons->pluck('id')->all()) ? 'checked' : '' }}>
                                    {{ $season->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('seasons')
                        <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            {{-- 下：商品説明 --}}
            <div class="product-edit__bottom">
                <div class="form-group">
                    <label class="form-label">商品説明</label>
                    <textarea name="description" rows="5" class="form-textarea" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="edit-buttons">
                <a href="/products" class="btn-back">戻る</a>

                <button class="btn-save" type="submit">
                    変更を保存
                </button>
            </div>
        </form>
        <div class="buttons-row">
            <form action="/products/{{ $product->id }}/delete" method="post" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="M3 6h18"></path>
                        <path d="M8 6V4h8v2"></path>
                        <path d="M10 11v6"></path>
                        <path d="M14 11v6"></path>
                        <path d="M5 6l1 14h12l1-14"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</main>

</body>
</html>