<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Products</title>
</head>
<body>
    <h1>Gold Products List</h1>
    <ul>
        @foreach ($products as $product)
            <li>
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ number_format($product->price, 2) }}</p>
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100px;height:auto;">
            </li>
        @endforeach
    </ul>
</body>
</html>
