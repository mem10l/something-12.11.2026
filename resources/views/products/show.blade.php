<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ $product->name }}</h1>
    <h4>Quantity:<span data-product-quantity>{{ $product->quantity }}</span></h4>

    <div
        class="quantity-controls"
        data-quantity-controls
        data-increase-url="{{ route('products/increaseQuantity', [$product]) }}"
        data-decrease-url="{{ route('products/decreaseQuantity', [$product]) }}"
    >
        <button type="button" class="btn btn-decrease" data-quantity-action="decrease" >-</button>
        <button type="button" class="btn btn-increase" data-quantity-action="increase">+</button>
    </div>

    <p>{{ $product->description }}</p>

    <a href="{{ route('products/edit', [$product]) }}">Edit</a>
    <form action="{{ route('products/destroy', [$product]) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</x-layout>