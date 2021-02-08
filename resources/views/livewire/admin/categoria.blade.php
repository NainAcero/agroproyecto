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
            <input type="search" class="form-control" placeholder="BUSCAR...">
            <br>
        </div>

        <div class=" main-content-area ">
            <div id="error-body"></div>
            {{-- REGISTER CATEGORIA --}}
            <div>
                <h3 class="box-title"><b>REGISTRAR CATEGORIA</b></h3>
                <form action="{{ route('categoria.store') }}" method="post" id="categoria-create">
                    @csrf
                    <br><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="cname" type="text" name="name" class="form-control" placeholder="Nombre Categoria">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" class="btn btn-success" id="bottom-register" value="Registrar">
                        </div>
                    </div>
                    <br><br>
                </form>
            </div>
            {{-- END REGISTER CATEGORIA --}}
        </div><!--end main content area-->
    </div><!--end container-->

</main>

@push('scripts')

    <script src="{{ asset('assets/js/admin/categoria.js') }}"></script>

@endpush

</x-guest-layout>

