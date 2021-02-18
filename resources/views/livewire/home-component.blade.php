    <main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">

					<div class="item-slide">
						<img src="{{ asset('https://argentina.agrofystatic.com/media/sliderhome/image/s/l/slides-enero-od-30-12-20-02.jpg?usewebp=true' ) }}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle" style="color: #fff">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle" style="color: #fff">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{ asset('https://argentina.agrofystatic.com/media/sliderhome/image/s/l/slides-fertec-enero-02.jpg?usewebp=true' ) }}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title" style="color: #fff">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle" style="color: #fff">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info" style="color: #fff">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-1.jpg' ) }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('assets/images/home-1-banner-2.jpg' ) }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">On Sale</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/05/12 12:34:56"></div>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                    @foreach($popular_products as $p_product)
					<div class="product product-style-2 equal-elem ">
						<div class="product-thumnail">
							<a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" title="{{ $p_product->name }}">
								<figure><img src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" width="800" height="800" alt="{{ $p_product->name }}"></figure>
							</a>
							<div class="group-flash">
								<span class="flash-item sale-label">sale</span>
							</div>
							<div class="wrap-btn">
								<a href="#" class="function-link">quick view</a>
							</div>
						</div>
						<div class="product-info">
                            <a src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" class="product-name"><span>{{ $p_product->name }}</span></a>
                            <div class="wrap-price"><span class="product-price">${{ $p_product->regular_price }}</span></div>
                        </div>
					</div>
                    @endforeach

				</div>
			</div>

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/digital-electronic-banner.jpg' ) }}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @foreach($popular_products as $p_product)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" title="{{ $p_product->name }}">
                                                    <figure><img src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" width="800" height="800" alt="{{ $p_product->name }}"></figure>
                                                </a>
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">new</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="#" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" class="product-name"><span>{{ $p_product->name }}</span></a>
                                                <div class="wrap-price"><span class="product-price">${{ $p_product->regular_price }}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg' ) }}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
                    <div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
                            @php $con = 1; @endphp
                            @foreach($categories as $category)
							    <a href="<?php echo "#fashion_".$category->id ?>" class="<?php echo ($con == 1)? 'tab-control-item active' : 'tab-control-item' ?>">{{ $category->name }}</a>
                                @php $con = 0; @endphp
                            @endforeach
						</div>
						<div class="tab-contents">
                            @php $con = 1; @endphp
                            @foreach($categories as $category)
                                <div class="<?php echo ($con == 1)? 'tab-content-item active' : 'tab-content-item' ?>" id="<?php echo "fashion_".$category->id ?>">
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                    @foreach($category->productos as $producto)
                                        <div class="product product-style-2 equal-elem ">
                                            <div class="product-thumnail">
                                                <a href="{{ route('product.details', ['slug'=>$producto->slug]) }}" title="{{ $producto->name }}">
                                                    <figure>
                                                        <img src="{{ asset('assets/images/products') }}/{{ $producto->image }}" width="800" height="800"  alt="{{ $producto->name }}">
                                                    </figure>
                                                </a>
                                                <!-- <div class="group-flash">
                                                    <span class="flash-item bestseller-label">Bestseller</span>
                                                </div> -->
                                                <div class="wrap-btn">
                                                    <a href="#" class="function-link">quick view</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                @php $con = 0; @endphp
                            @endforeach
						</div>
					</div>
				</div>
			</div>

		</div>

	</main>
