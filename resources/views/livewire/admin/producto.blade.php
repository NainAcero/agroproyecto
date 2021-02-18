<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span><a href="/admin/producto" class="link">Productos</a></span></li>
            </ul>
        </div>

        <div class="form-outline mb-4">
            <input type="search" class="form-control" id="buscar" placeholder="BUSCAR...">
            <br>
        </div>
        <div class="alert alert-success" id="alerta">
            <strong>Mensaje</strong> Cargando Productos...
        </div>
        <div id="table-productos">
            <table class="table" >
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="producto-lista">
                    {{-- @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            <div class="product-image">
                                <figure><img src="{{ asset('assets/images/products' ) }}/{{ $producto->image }}" alt="{{ $producto->name }}" width="60px"></figure>
                            </div>
                        </td>
                        <td>{{ $producto->name }}</td>
                        <td>{{ $producto->regular_price }}</td>
                        <td>{{ $producto->SKU }}</td>
                        <td>{{ $producto->category->name }}</td>
                        <td>
                            <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>

            <div id="paginador">

            </div>
        </div>

        <div class=" main-content-area">
            <div id="error-body"></div>
             <div class="wrap-address-billing">
                {{-- REGISTER PRODUCTO --}}

                <div style="display:none" id="formulario-producto">
                    <h3 class="box-title" style="font-size:24px"><i onclick="back()" class="fas fa-arrow-circle-left"></i> <b>PRODUCTO</b></h3>
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
                            <textarea id="pdescription" name="description" rows="6" class="form-control" id="comment"></textarea>
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pshortdescription">Descripción Corta del Producto<span>*</span></label>
                            <textarea id="short_description" name="short_description" rows="6" class="form-control" id="comment"></textarea>
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pshu">SKU del Producto<span>*</span></label>
                            <input id="pshu" type="text" name="SKU" value="" placeholder="SKU del Producto">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pquantity">Cantidad<span>*</span></label>
                            <input id="pquantity" type="number" name="quantity" value="" placeholder="Cantidad">
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px" id="category_id">

                        </p>
                        <input type="hidden" id="pid" name="id" value="" >
                        <input type="submit" class="btn btn-success" id="bottom-register" value="Enviar">
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

