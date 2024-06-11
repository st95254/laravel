@include('layouts.head', ['title' => '灃耘 - 茶葉', 'cssPath' => 'css/tea.css'])

<x-app-layout>
    <div class="container">
        <div class="product_lis">
            @foreach ($products as $product)
                <div class="card">
                    <div class="img">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div class="info">
                        <div class="tt">
                           <a href="{{ route('products.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                        </div>
                        <div class="price">${{ number_format($product->price, 0) }}元</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <br><br><br>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1">
    <br>
</x-app-layout>
