@extends('layouts.app')

@section('title', 'Products - abcsheba.com')

@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-md-12 col-lg-4 col-xl-3 remove-padding-mobile">
                    <div class="card search-filter sticky-sidebar">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Filter Products</h4>
                            <a href="{{ route('products') }}" class="small text-danger fw-bold">Reset</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products') }}" method="GET" id="filter-form">
                                <!-- Search -->
                                <div class="filter-widget">
                                    <h4 class="filter-booking-title">Search</h4>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-search search-icon"></i>
                                        <input type="text" name="search" class="form-control" placeholder="Search..."
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="filter-widget">
                                    <h4 class="filter-booking-title">Price Range</h4>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="number" name="min_price" class="form-control form-control-sm"
                                            placeholder="Min" value="{{ request('min_price') }}">
                                        <span class="text-muted">-</span>
                                        <input type="number" name="max_price" class="form-control form-control-sm"
                                            placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>

                                <!-- Categories -->
                                <div class="filter-widget">
                                    <h4 class="filter-booking-title">Categories</h4>
                                    <div class="filter-scroll">
                                        @foreach($categories as $category)
                                            <div class="filter-checkbox">
                                                <label class="custom_check">
                                                    <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="category-name">{{ $category->name }}</span>
                                                    {{-- <span class="count">(0)</span> --}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="btn-search">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar Filter -->

                <!-- Product Grid -->
                <div class="col-md-12 col-lg-8 col-xl-9">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                                <div class="product-card-modern">
                                    <!-- Stock Badge -->
                                    <div class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                        {{ $product->stock > 0 ? 'IN STOCK' : 'OUT OF STOCK' }}
                                    </div>

                                    <!-- Product Image -->
                                    <div class="product-image-container">
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <img src="{{ $product->image ? asset($product->image) : asset('assets/img/products/product-1.jpg') }}"
                                                class="product-main-img" alt="{{ $product->name }}">
                                        </a>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="product-details">
                                        <!-- Rating -->
                                        <div class="product-rating">
                                            <i class="fas fa-star"></i>
                                            <span class="rating-value">{{ number_format($product->rating ?? 4.5, 1) }}</span>
                                            <span class="review-count">({{ $product->reviews_count ?? rand(10, 200) }})</span>
                                        </div>

                                        <!-- Brand/Category -->
                                        <div class="product-brand">{{ $product->category->name ?? 'General' }}</div>

                                        <!-- Title -->
                                        <h4 class="product-name">
                                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                        </h4>

                                        <!-- Price & Actions -->
                                        <div class="product-footer">
                                            <div class="product-price-tag">
                                                @if($product->sale_price)
                                                    <span class="price-current">৳{{ number_format($product->sale_price, 2) }}</span>
                                                    <span class="price-original">৳{{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span class="price-current">৳{{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add') }}" method="POST" class="product-actions-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <div class="btn-group-modern">
                                                    <button type="submit" class="btn-cart-modern" title="Add to Cart">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                    <button type="submit" name="buy_now" value="1" class="btn-buy-modern">
                                                        Buy
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">No products found.</div>
                            </div>
                        @endforelse
                    </div>

                    <div class="load-more text-center mt-4">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
                <!-- /Product Grid -->
            </div>

        </div>
    </div>
    <!-- /Page Content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Auto submit form when category is changed
            $('input[name="category"]').on('change', function () {
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush

<style>
    /* Product Card Modern */
    .product-card-modern {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid #f0f0f0;
    }

    .product-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0, 102, 255, 0.12);
    }

    /* Stock Badge */
    .stock-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.5px;
        z-index: 10;
        text-transform: uppercase;
    }

    .stock-badge.in-stock {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .stock-badge.out-of-stock {
        background: #ffebee;
        color: #c62828;
    }

    /* Product Image */
    .product-image-container {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-main-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card-modern:hover .product-main-img {
        transform: scale(1.05);
    }

    /* Product Details */
    .product-details {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Rating */
    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .product-rating i {
        color: #ffc107;
        font-size: 12px;
    }

    .product-rating .rating-value {
        font-weight: 600;
        color: #333;
    }

    .product-rating .review-count {
        color: #999;
        font-size: 12px;
    }

    /* Brand */
    .product-brand {
        font-size: 11px;
        color: #1D4ED8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    /* Product Name */
    .product-name {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 40px;
    }

    .product-name a {
        color: #272b41;
        text-decoration: none;
        transition: color 0.2s;
    }

    .product-name a:hover {
        color: #1D4ED8;
    }

    /* Product Footer - Price & Buttons */
    .product-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .product-price-tag {
        display: flex;
        flex-direction: column;
    }

    .price-current {
        font-size: 18px;
        font-weight: 700;
        color: #272b41;
    }

    .price-original {
        font-size: 12px;
        color: #999;
        text-decoration: line-through;
    }

    /* Button Group */
    .product-actions-form {
        display: flex;
    }

    .btn-group-modern {
        display: flex;
        gap: 6px;
    }

    .btn-cart-modern {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        border: 2px solid #1D4ED8;
        background: transparent;
        color: #1D4ED8;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-cart-modern:hover {
        background: #1D4ED8;
        color: #fff;
    }

    .btn-buy-modern {
        padding: 0 20px;
        height: 38px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #1D4ED8 0%, #60A5FA 100%);
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-buy-modern:hover {
        background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
    }

    /* Sticky Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 90px; /* Adjust based on header height */
        z-index: 9;
    }

    /* Filter Headers */
    .filter-booking-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #272b41;
        position: relative;
        padding-bottom: 8px;
    }

    .filter-booking-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 30px;
        height: 2px;
        background: #1D4ED8;
        border-radius: 2px;
    }

    /* Search Input */
    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 14px;
        pointer-events: none;
    }

    .search-input-wrapper input {
        padding-left: 35px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        font-size: 14px;
    }

    .search-input-wrapper input:focus {
        border-color: #1D4ED8;
        box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
    }

    /* Filter Checkbox styles override or enhance if needed */
    .custom_check {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        cursor: pointer;
        padding: 5px 0;
        transition: all 0.2s;
    }

    .custom_check:hover .category-name {
        color: #1D4ED8;
    }

    .custom_check .checkmark {
        border-radius: 4px; /* Softer look */
    }

    .custom_check input:checked ~ .checkmark {
        background-color: #1D4ED8;
        border-color: #1D4ED8;
    }

    .category-name {
        font-size: 14px;
        color: #444;
        transition: color 0.2s;
    }

    .filter-scroll {
        max-height: 250px;
        overflow-y: auto;
        padding-right: 5px;
    }

    /* Scrollbar styling */
    .filter-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .filter-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
</style>