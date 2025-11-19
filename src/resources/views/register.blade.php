<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}" />
    <link rel="stylesheet" href="{{asset('css/register.css')}}?v=7" />
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
        <h2>
            商品登録
        </h2>
        <form action="/products/register" class="product-edit" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form__row">
                <label for="" class="form--label">商品名<span class="required">必須</span></label>
                <input type="text" name="name" class="form-input" placeholder="商品名を入力">
                @error('name')
                <div class="form-error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form__row">
                <label class="form-label">価格<span class="required">必須</span></label>
                <input type="text" name="price" class="input" placeholder="値段を入力">
                @error('price')
                <div class="form-error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form__row">
                <label for="" class="form-label">商品画像<span class="required">必須</span></label>

                <label for="" class="image-upload" class="image-btn">ファイルを選択</label>
                <input type="file" id="image-upload" name="image" accept="image/*">
                @error('image')
                <div class="form-error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form__row">
                <label for="" class="form-label">季節<span class="required">必須</span></label>

                <div class="season-group">
                    
                    <label for="" class="season-item">
                        <input type="checkbox" name="seasons[]" value="1"> 春
                    </label>
                    <label for="" class="season-item">
                        <input type="checkbox" name="seasons[]" value="2">夏
                    </label>
                    <label for="" class="season-item">
                        <input type="checkbox" name="seasons[]" value="3">秋
                    </label>
                    <label for="" class="season-item">
                        <input type="checkbox" name="seasons[]" value="4">冬
                    </label>
                </div>
                @error('seasons')
                <div class="form-error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-row">
                <label for="" class="form-label">商品説明<span class="required">必須</span></label>
                <textarea name="description" id="" row="5" class="form-textarea" placeholder="商品の説明を入力"></textarea>
                @error('description')
                <div class="form-error">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="register-buttons">
                <a href="/products" class="btn-back">戻る</a>

                <button class="btn-register" type="submit">
                    登録
                </button>
            </div>
        </form>
    </main>
</body>
</html>