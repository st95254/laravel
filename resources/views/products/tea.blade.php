@include('layouts.head', ['title' => '灃耘 - 茶葉', 'cssPath' => 'css/tea.css'])

<x-app-layout>
    <section id="product_sec">
        <div class="product_lis">
            @foreach ($products as $product)
                <a href="{{ route('products.detail', ['id' => $product->id]) }}" class="card-link">
                    <div class="card">
                        <div class="img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="info">
                            <div class="tt">
                                {{ $product->name }}
                            </div>
                            <div class="price">${{ number_format($product->price, 0) }}元</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <br><br><br>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1">
    <br>
</x-app-layout>
