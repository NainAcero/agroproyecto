<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <strong>Success</strong> {{Session::get('success_message')}}
                    </div>
                @elseif(Session::has('error_message'))
                    <div class="alert alert-danger">
                        <strong>Error</strong> {{Session::get('error_message')}}
                    </div>
                @endif
                @if(Cart::count() > 0)
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart">
                        <a href="#" >

                        </a>
                        @foreach(Cart::content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets/images/products' ) }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->model->slug]) }}">{{ $item->model->name }}</a>
                                </div>
                                <div class="price-field produtc-price"><p class="price">${{ $item->model->regular_price }}</p></div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*" >
                                        <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
                                        <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p class="price">${{ $item->subtotal }}</p></div>
                                <div class="delete">
                                    <a href="#"  wire:click="$emit('triggerDelete', '{{ $item->rowId }}' )" >
                                        <span class="ua-icon-alert-close text-danger" style="font-size:30px">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Ningún artículo en el carrito</p>
                @endif
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">RESUMEN DEL PEDIDO</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{Cart::subtotal()}}</b></p>
                    <p class="summary-info"><span class="title">Impuesto</span><b class="index">${{Cart::tax()}}</b></p>
                    <p class="summary-info"><span class="title">Transporte</span><b class="index">Envío gratis</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ $total }}</b></p>

                </div>
                <div class="checkout-info">
                    <label class="checkbox-field">
                        <input class="frm-input" name="have-code" id="have-code" wire:click="$emit('have-code', 1)" type="checkbox"><span>Tengo un código promocional</span>
                    </label>
                    <fieldset class="wrap-input" >
                        <br>
                        <input type="text" id="hidden" class="form-control" style="display:none" name="code"  wire:keydown.enter="$emit('code-submit', 1)" placeholder="Código*" autofocus="">

                        <small id="emailHelp" id="mensaje" style="display:none" class="form-text text-danger text-muted"><b>Código Incorrecto</b></small>
                    </fieldset>

                    <a class="btn btn-checkout" href="{{ route('user.dashboard') }}">COMPRAR AHORA</a>
                    <a class="link-to-shop" href="shop.html">Continuar Comprando<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear"  wire:click.prevent="destroyAll()" href="#">Eliminar Productos</a>
                </div>
            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Productos más vistos</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                        @foreach($popular_products as $p_product)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" title="{{ $p_product->name }}">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $p_product->image }}" width="214" height="214" alt="{{ $p_product->name }}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" class="function-link">{{ $p_product->name }}</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.details', ['slug'=>$p_product->slug]) }}" class="product-name"><span>{{ $p_product->name }}</span></a>
                                    <div class="wrap-price"><span class="product-price">${{ $p_product->regular_price }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!--End wrap-products-->
            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        var show = document.getElementById('have-code');
        var hidden = document.getElementById('hidden');

        @this.on('triggerDelete', orderId => {
           Swal.fire({
                title: 'Estas seguro de eliminarlo?',
                showDenyButton: false,
                showCancelButton: true,
                denyButtonText: `No Resetear`,
                confirmButtonText: 'Delete!'
            }).then((result) => {
                if (result.value) {
                    @this.call('destroy',orderId)
                    responseAlert({title: session('message'), type: 'success'});

                } else {
                    responseAlert({
                        title: 'Operation Cancelled!',
                        type: 'success'
                    });
                }
            });
        });

        @this.on('have-code', data => hidden.style.display = (show.checked)? 'inline' : 'none' );

        @this.on('code-submit', data => {
            @this.call('code_discount',hidden.value)
        });

    })
</script>
@endpush
