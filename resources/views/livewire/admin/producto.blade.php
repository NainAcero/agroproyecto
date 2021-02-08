<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Productos</span></li>
            </ul>
        </div>

        <div class="form-outline mb-4">
            <input type="search" class="form-control" id="buscar" placeholder="BUSCAR...">
            <br>
        </div>

        <div class=" main-content-area">
            <div id="error-body"></div>
             <div class="wrap-address-billing">
                {{-- REGISTER PRODUCTO --}}
                <div>
                    <h3 class="box-title"><b>REGISTRAR PRODUCTO</b></h3>
                    <form action="{{ route('producto.store') }}" method="post" name="frm-billing" id="producto-create">
                        @csrf
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pname">Nombre del Producto<span>*</span></label>
                            <input id="pname" type="text" name="name" value="" placeholder="Nombre Producto">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pprecio">Precio del Producto<span>*</span></label>
                            <input id="pprecio" type="number" name="regular_price" value="" placeholder="Precio Producto">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pdescription">Descripción del Producto<span>*</span></label>
                            <textarea name="description" rows="6" class="form-control" id="comment"></textarea>
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pshortdescription">Descripción Corta del Producto<span>*</span></label>
                            <textarea name="short_description" rows="6" class="form-control" id="comment"></textarea>
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pshu">SKU del Producto<span>*</span></label>
                            <input id="pshu" type="text" name="SKU" value="" placeholder="SKU del Producto">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pquantity">Cantidad<span>*</span></label>
                            <input id="pquantity" type="number" name="quantity" value="" placeholder="Cantidad">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <select name="category_id" class="form-control" >
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </p>
                        <input type="submit" class="btn btn-success" id="bottom-register" value="Registrar">
                    </form>
                </div>
                {{-- END PRODUCTO --}}

            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>

@push('scripts')

    <script src="{{ asset('assets/js/admin/producto.js') }}"></script>

@endpush

</x-guest-layout>

