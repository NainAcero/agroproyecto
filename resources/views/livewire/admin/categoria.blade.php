<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span><a href="/admin/categoria" class="link">Categoria</a></span></li>
            </ul>
        </div>

        <div class="form-outline mb-4">
            <input type="search" id="buscar" class="form-control" placeholder="BUSCAR...">
            <br>
        </div>

        <div id="table-categorias">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Productos</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->productos->count() }}</td>
                        <td>
                            <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class=" main-content-area ">
            <div id="error-body"></div>
            {{-- REGISTER CATEGORIA --}}
            <div style="display:none" id="formulario-categoria">
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

