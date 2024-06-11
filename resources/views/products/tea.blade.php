<!DOCTYPE html>
<html lang="en">
@include('layouts.head', ['title' => '茶葉', 'cssPath' => 'css/tea.css'])

<body>
    <div class="container">
        <div class="product_lis">
            @foreach ($products as $product)
                <div class="card">
                    <div class="img">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div class="info">
                        <div class="tt">
                            <a href="#">{{ $product->name }}</a>
                        </div>
                        <div class="price">${{ number_format($product->price, 0) }}元</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <br><br><br>
    <hr align=center width=80% color=#e6e6e6 SIZE=1>
    <br>

    @include('partials.footer')
</body>
</html>
