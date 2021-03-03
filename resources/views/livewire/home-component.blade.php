    <main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">

					<div class="item-slide">
						<img src="{{ asset('https://argentina.agrofystatic.com/media/sliderhome/image/s/l/slides-enero-od-30-12-20-02.jpg?usewebp=true' ) }}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 20% Off</h2>
							<span class="f-subtitle" style="color: #fff">Sobre pagos en línea</span>
							<p class="discount-code">Utilice Code: CODEPROMOCION_2021</p>

						</div>
					</div>
					<div class="item-slide">
						<img src="{{ asset('https://argentina.agrofystatic.com/media/sliderhome/image/s/l/slides-fertec-enero-02.jpg?usewebp=true' ) }}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title" style="color: #fff">Gran variedad de <b>paquetes de agroquimicos exclusivos</b></h2>
							<span class="f-subtitle" style="color: #fff">Paquetes exclusivos para satisfacer todas las necesidades.</span>
							<p class="sale-info" style="color: #fff">Productos desde : <b class="price">$26.00</b></p>
							<a href="/shop" class="btn-link">Comprar Ahora</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="/shop" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('img/img2.jpg' ) }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="/shop" class="link-banner banner-effect-1">
						<figure><img src="{{ asset('img/img1.jpg' ) }}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">EN VENTA</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/03/16 12:34:56"></div>
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
								<a  href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" class="function-link">{{ $p_product->name }}</a>
							</div>
						</div>
						<div class="product-info">
                            <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" class="product-name"><span>{{ $p_product->name }}</span></a>
                            <div class="wrap-price"><span class="product-price">${{ $p_product->regular_price }}</span></div>
                        </div>
					</div>
                    @endforeach

				</div>
			</div>

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">ÚLTIMOS PRODUCTOS</h3>
				<div class="wrap-top-banner">
					<a href="/shop" class="link-banner banner-effect-2">
						<figure><img src="https://irp-cdn.multiscreensite.com/519cc0c7/DESKTOP/jpg/1380793-banner.jpg" width="1170" height="240" alt=""></figure>
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
                                                    <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" class="function-link">{{ $p_product->name }}</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}"  class="product-name"><span>{{ $p_product->name }}</span></a>
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
				<h3 class="title-box">CATEGORÍAS DE PRODUCTO</h3>
				<div class="wrap-top-banner">
					<a href="/shop" class="link-banner banner-effect-2">
						<figure><img src="https://irp-cdn.multiscreensite.com/519cc0c7/DESKTOP/jpg/1380794-banner-01.jpg" width="1170" height="240" alt=""></figure>
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
                                                    <a href="{{ route('product.details', ['slug'=>$producto->slug]) }}" class="function-link">{{ $producto->name }}</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('product.details', ['slug'=>$producto->slug]) }}" class="product-name"><span>{{ $producto->name }}</span></a>
                                                <div class="wrap-price"><span class="product-price">{{ $producto->regular_price }}</span></div>
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
