<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">Inicio</a></li>
                <li class="item-link"><span>Tienda</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="/shop" class="banner-link">
                        <figure><img src="http://www.solteq.co/wp-content/uploads/2015/02/banner-agroquimicos.jpg" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title"></h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen" wire:model="sorting">
                                <option value="default" selected="selected">Clasificación por defecto</option>
                                <option value="date">Ordenar por novedad</option>
                                <option value="price">Ordenar por precio: de menor a mayor</option>
                                <option value="price-desc">Ordenar por precio: de mayor a menor</option>
                            </select>
                        </div>

                        <div class="sort-item product-per-page" wire:model="pageSize">
                            <select name="post-per-page" class="use-chosen" >
                                <option value="12" selected="selected">12 por página</option>
                                <option value="16">16 por página</option>
                                <option value="18">18 por página</option>
                                <option value="21">21 por página</option>
                                <option value="24">24 por página</option>
                                <option value="30">30 por página</option>
                                <option value="32">32 por página</option>
                            </select>
                        </div>

                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                         </div>

                    </div>

                </div><!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">

                        @foreach($products as $product)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details', ['slug'=>$product->slug]) }}" title="{{ $product->name }}">
                                            <figure><img src="{{ asset('assets/images/products') }}/{{ $product->image }}" alt="{{ $product->image }}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product.details', ['slug'=>$product->slug]) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{ $product->regular_price }}</span></div>
                                        <a href="#" class="btn add-to-cart" wire:click.prevent="store({{ $product->id }} , '{{ $product->name }}',{{ $product->regular_price }})" >Add To Cart</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                </div>

                <div class="wrap-pagination-info">

                    {{ $products->links() }}

                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">CATEGORIAS</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach($categories as $category)
                                <li class="category-item">
                                    <a href="{{ route('product.category', ['category_slug' => $category->slug]) }}" class="cate-link">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">PRODUCTOS POPULARES</h2>
                    <div class="widget-content">
                        <ul class="products">

                            @foreach($popular_products as $p_product)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" title="{{ $p_product->name }}">
                                            <figure><img src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" alt="{{ $p_product->name }}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" class="product-name"><span>{{ $p_product->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price">${{ $p_product->regular_price }}</span></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

</main>
