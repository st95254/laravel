@include('layouts.head', ['title' => '灃耘', 'cssPath' => 'css/product.css'])

<x-app-layout>
    <div class="content">
        <article class="showcase">
            <img src="{{ $product->image ?: 'images/home/gold.jpeg' }}" class="product-image">
        </article>
        <aside class="information">
            <div id="frame">
                <div class="name">
                    <p>{{ $product->name }}</p>
                </div>
                <div class="description">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="detail">
                    <div class="money">NT$ {{ $product->price }}</div>
                    <div class="counter">
                        <button id="decrease">-</button>
                        <span id="number">1</span>
                        <button id="increase">+</button>
                    </div>
                </div>
                <div class="cart">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="quantity" name="quantity" value="1">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" class="add_btn">加入購物車</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

<script src="{{ asset('js/product.js') }}"></script>
