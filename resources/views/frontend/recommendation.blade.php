<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Products</title>
</head>
<body>
    <h1>Recommended Products</h1>
    <ul>
        @foreach ($recommendedProducts as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
</body>
</html>
