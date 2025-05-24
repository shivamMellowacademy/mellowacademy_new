@extends('front.layout')
@section('content')

<div class="search-results-page bg-light" style="margin-top: 200px;">
    @if(isset($search_total) && $search_total > 0)
        <div class="container py-4">
            <!-- Search Header -->
            <div class="search-header text-center mb-4">
                <h1 class="font-weight-bold text-dark mb-2">Search Results</h1>
                <p class="lead mb-3 text-dark">Showing results for "<span class="text-primary font-weight-bold">{{ $search_query }}</span>"</p>
                <div class="d-flex justify-content-center align-items-center">
                    <span class="badge badge-primary badge-pill px-3 py-2 mr-2">
                        <i class="fa fa-check-circle mr-1"></i> {{ $search_total }} matches
                    </span>
                    
                </div>
            </div>

            <!-- Results Navigation -->
            <div class="results-navigation mb-4">
                <ul class="nav nav-pills nav-justified flex-column flex-sm-row border-bottom-0" id="searchTabs" role="tablist">
                    @if(isset($search_products_total) && $search_products_total > 0)
                    <li class="nav-item flex-sm-fill text-sm-center mb-2 mb-sm-0">
                        <a class="nav-link active px-4 py-2 rounded-pill" id="products-tab" data-toggle="pill" href="#products" role="tab">
                            <i class="fa fa-shopping-bag mr-2"></i> Products 
                            <span class="badge badge-light ml-1">{{ $search_products_total }}</span>
                        </a>
                    </li>
                    @endif
                    
                    @if(isset($search_developers_total) && $search_developers_total > 0)
                    <li class="nav-item flex-sm-fill text-sm-center">
                        <a class="nav-link px-4 py-2 rounded-pill {{ !isset($search_products_total) || $search_products_total == 0 ? 'active' : '' }}" 
                           id="developers-tab" data-toggle="pill" href="#developers" role="tab">
                            <i class="fa fa-code mr-2"></i> Developers 
                            <span class="badge badge-light ml-1">{{ $search_developers_total }}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content" id="searchTabsContent">
                <!-- Products Tab -->
                @if(isset($search_products_total) && $search_products_total > 0)
                <div class="tab-pane fade show active" id="products" role="tabpanel">
                    <div class="row">
                        @foreach($search_products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative overflow-hidden" style="height: 180px; background-color: #f8f9fa;">
                                    @if($product->image == '')
                                        <div class="h-100 d-flex align-items-center justify-content-center bg-dark">
                                            <video class="h-100" controls controlsList="nodownload">
                                                <source src="{{ asset('public/upload/video/'.$product->video) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    @else
                                        <img src="{{ asset('public/upload/product/'.$product->image) }}" class="img-fluid w-100 h-100" alt="{{ $product->name }}" style="object-fit: contain;">
                                    @endif
                                    <div class="product-badge position-absolute top-0 left-0 bg-danger text-white px-2 py-1 small">
                                        @if($product->tax)
                                        <span>Tax {{ $product->tax }}%</span>
                                        @endif
                                    </div>
                                    <div class="product-actions position-absolute top-0 right-0 p-2">
                                        <button class="btn btn-sm btn-light rounded-circle shadow-sm mb-1" data-toggle="tooltip" title="Quick View" onclick="window.location.href='{{ route('product_details', ['id' => $product->id]) }}'">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary rounded-circle shadow-sm add_to_cart" value="{{ $product->id }}" data-toggle="tooltip" title="Add to Cart">
                                            <i class="fa fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1 font-weight-bold">
                                        <a href="{{ route('product_details', ['id' => $product->id]) }}" class="text-dark">{{ Str::limit($product->name, 40) }}</a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-primary font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                        @if($product->pro_size)
                                        <span class="badge badge-light border small">{{ $product->pro_size }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($search_products_total > 8)
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary px-4 py-2 rounded-pill">
                            <i class="fa fa-plus-circle mr-2"></i> Show More Products
                        </button>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Developers Tab -->
                @if(isset($search_developers_total) && $search_developers_total > 0)
                    <div class="tab-pane fade {{ !isset($search_products_total) || $search_products_total == 0 ? 'show active' : '' }}" id="developers" role="tabpanel">
                        <div class="row">
                            @foreach($search_developers as $developer)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card developer-card h-100 border-0 shadow-hover">
                                    <!-- Developer Header with Image -->
                                    <div class="developer-header position-relative overflow-hidden" style="height: 180px;">
                                        @if($developer->image)
                                            <img src="{{ asset('public/upload/developer/'.$developer->image) }}" class="img-fluid w-100 h-100" alt="{{ $developer->name }}" style="transition: transform 0.5s ease;">
                                        @else
                                            <div class="h-100 d-flex align-items-center justify-content-center bg-gradient-primary">
                                                <i class="fa fa-user-circle fa-5x text-white"></i>
                                            </div>
                                        @endif
                                        
                                        <!-- Rating Badge -->
                                        <div class="developer-rating position-absolute top-0 right-0 bg-white text-primary font-weight-bold px-2 py-1 m-3 rounded-circle shadow-sm">
                                            {{ $developer->rating ?? '5.0' }} <i class="fa fa-star ml-1"></i>
                                        </div>
                                        
                                        <!-- Skills Overlay -->
                                        @if($developer->skills)
                                        <div class="skills-overlay position-absolute bottom-0 left-0 right-0 p-3 bg-gradient-dark">
                                            <div class="d-flex flex-wrap">
                                                @foreach(array_slice(explode(',', $developer->skills), 0, 3) as $skill)
                                                    <span class="badge badge-light badge-pill border-0 text-dark mr-1 mb-1">{{ trim($skill) }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Developer Body -->
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="font-weight-bold mb-1 text-dark">{{ $developer->name }}</h5>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-success badge-pill mr-2">
                                                        <i class="fa fa-check-circle mr-1"></i> Verified
                                                    </span>
                                                    <small class="text-muted">
                                                        <i class="fa fa-map-marker-alt text-primary mr-1"></i> 
                                                        {{ $developer->address ?? 'Remote' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Experience & Rate -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="experience-badge bg-light rounded-pill px-3 py-1">
                                                <i class="fa fa-briefcase text-primary mr-1"></i>
                                                <span class="font-weight-bold text-dark">{{ $developer->total_experience ?? '0' }} yrs</span>
                                            </div>
                                            <div class="hourly-rate">
                                                <span class="text-primary font-weight-bold text-dark">${{ $developer->perhr ?? '0' }}/Monthly</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Availability -->
                                       
                                            <div class="availability-badge mb-3 text-dark">
                                                
                                                <span class="badge  badge-pill py-1 px-3">
                                                    <i class="fa fa-clock-o mr-1"></i> 'Full-time'
                                                </span>
                                            </div>
                                      
                                        
                                        <!-- View Profile Button -->
                                        <a href="{{ url('developer_detail/'.$developer->dev_id) }}" class="btn btn-primary btn-block rounded-pill py-2 mt-2">
                                            <i class="fa fa-user-tie mr-2"></i> View Full Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @if($search_developers_total > 6)
                        <div class="text-center mt-4">
                            <button class="btn btn-outline-primary px-4 py-2 rounded-pill load-more-developers">
                                <i class="fa fa-refresh mr-2"></i> Load More Developers
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif
            </div>
        </div>
    @else
        <!-- No Results Section -->
        <div class="no-results py-5" style="min-height: calc(100vh - 200px);">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="mb-4">
                            <i class="fa fa-search fa-5x text-muted mb-4"></i>
                            <h2 class="font-weight-bold mb-3">No Results Found</h2>
                            <p class="lead text-muted">We couldn't find any matches for "<span class="text-primary">{{ $search_query }}</span>"</p>
                        </div>
                        
                        <div class="search-suggestions bg-white p-4 rounded shadow-sm mb-4">
                            <h5 class="font-weight-bold mb-3">Search Tips:</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="p-3 border rounded h-100">
                                        <i class="fa fa-check-circle text-primary mb-2"></i>
                                        <p class="mb-0 small">Try different or more general keywords</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="p-3 border rounded h-100">
                                        <i class="fa fa-check-circle text-primary mb-2"></i>
                                        <p class="mb-0 small">Check your spelling</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 border rounded h-100">
                                        <i class="fa fa-check-circle text-primary mb-2"></i>
                                        <p class="mb-0 small">Browse our categories</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('index') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                            <i class="fa fa-arrow-left mr-2"></i> Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .search-results-page {
        min-height: calc(100vh - 200px);
    }
    
    .product-card, .developer-card {
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    
    .product-card:hover, .developer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    
    .product-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card:hover .product-actions {
        opacity: 1;
    }
    
    .nav-pills .nav-link {
        border: 1px solid #dee2e6;
        color: #495057;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link.active {
        background-color: #00264d;
        color: white;
        border-color: #00264d;
    }
    
    .nav-pills .nav-link:not(.active):hover {
        background-color: #f8f9fa;
    }
    
    .no-results {
        background-color: #f8f9fa;
    }
    
    .search-suggestions {
        border: 1px solid rgba(0,0,0,0.1);
    }

    .developer-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .developer-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .developer-card:hover .developer-header img {
        transform: scale(1.05);
    }
    
    .developer-header {
        position: relative;
        overflow: hidden;
    }
    
    .bg-gradient-primary {
        background: #00264d;
    }
    
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    
    .developer-rating {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    
    .skills-overlay {
        transition: all 0.3s ease;
    }
    
    .developer-card:hover .skills-overlay {
        transform: translateY(0);
    }
    
    .experience-badge {
        font-size: 0.85rem;
    }
    
    .shadow-hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .badge-pill {
        border-radius: 50px;
    }
</style>

<script>
    $(document).ready(function(){
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Load more developers functionality
        $('.load-more-developers').click(function(){
            // Implement your load more functionality here
            console.log('Load more developers clicked');
        });
    });
</script>

<script>
    $(document).ready(function(){
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Add to cart functionality
        $('.add_to_cart').click(function(e){
            e.preventDefault();
            var productId = $(this).attr('value');
            // Implement your add to cart logic here
            console.log('Add to cart clicked for product ID: ' + productId);
            
            // Example toast notification
            toastr.success('Product added to cart successfully!');
        });
        
        // Tab switching logic
        $('#searchTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
            
            // Update URL hash
            window.location.hash = $(this).attr('href');
        });
        
        // Activate tab based on URL hash
        if(window.location.hash) {
            $('#searchTabs a[href="' + window.location.hash + '"]').tab('show');
        }
    });
</script>

@endsection