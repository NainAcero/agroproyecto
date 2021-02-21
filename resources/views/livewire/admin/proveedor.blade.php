<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span><a href="/admin/proveedor" class="link">Proveedor</a></span></li>
            </ul>
        </div>

        <div class="form-outline mb-4">
            <input list="encodings" type="search" id="buscar" class="form-control" placeholder="BUSCAR...">
            <datalist id="encodings">

            </datalist>
            <br>
        </div>
        <div class="alert alert-success" id="alerta">
            <strong>Mensaje</strong> Cargando Proveedores...
        </div>
        <div  id="table-proveedores">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">RUC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="proveedor-lista">
                    {{-- @foreach($proveedors as $proveedor)
                    <tr>
                        <td>
                        @if($proveedor->imagen == null)
                            <img src="{{ asset('img/photo.jpg') }}" width="40px"/>
                        @else

                        @endif
                        </td>
                        <td>{{ $proveedor->ruc }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->adress }}</td>
                        <td>{{ $proveedor->telefono }}</td>
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

        <div class=" main-content-area ">
            <div id="error-body"></div>
            {{-- REGISTER PROVEEDOR --}}

                <div style="display:none" id="formulario-proveedor">
                    <h3 class="box-title"><i onclick="back()" class="fas fa-arrow-circle-left"></i> <b>PROVEEDOR</b></h3>
                    <form action="{{ route('proveedor.store') }}" method="post" name="frm-billing" id="proveedor-create">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                                    <label for="pruc">RUC<span>*</span></label>
                                    <input id="pruc" type="text" class="form-control" name="ruc" value="" placeholder="RUC del proveedor">
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                                    <label for="pnombre">Nombre del Proveedor<span>*</span></label>
                                    <input id="pnombre" type="text" class="form-control" name="nombre" value="" placeholder="Nombre del Proveedor">
                                </p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                                    <label for="padress">Dirección del Proveedor<span>*</span></label>
                                    <input id="padress" type="text" class="form-control" name="adress" value="" placeholder="Dirección del Proveedor">
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                                    <label for="ptelefono">Teléfono del Proveedor<span>*</span></label>
                                    <input id="ptelefono" type="text" class="form-control" name="telefono" value="" placeholder="Teléfono del Proveedor">
                                </p>
                            </div>
                        </div>

                        <input type="hidden" id="pid" name="id" value="" >
                        <input type="submit" class="btn btn-success" id="bottom-register" value="Enviar">
                    </form>
                </div>

            {{-- END REGISTER PROVEEDOR --}}
        </div><!--end main content area-->
    </div><!--end container-->

</main>

@push('scripts')
    <script src="{{ asset('assets/js/admin/proveedor.js') }}"></script>
@endpush

</x-guest-layout>

