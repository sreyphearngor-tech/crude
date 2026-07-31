<!-- Categories Section -->
<div class="row">
    @foreach($categories as $category)
        <div class="col-md-2">
            <div class="card border p-3 text-center">
                <div class="category-image mb-2">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: contain;">
                    @else
                        <img src="{{ asset('images/default-icon.png') }}" style="width: 50px;">
                    @endif
                </div>
                <p class="mb-0">{{ $category->name }}</p>
            </div>
        </div>
    @endforeach
</div>

<!-- Best Selling Products Section -->
<div class="row">
    @foreach($bestSellingProducts as $product)
        <div class="col-md-3">
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                <h5>{{ $product->name }}</h5>
                <p class="text-danger">${{ $product->price }}</p>
            </div>
        </div>
    @endforeach
</div>
