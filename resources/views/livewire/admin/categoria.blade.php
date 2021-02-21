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
            <input list="encodings" type="search" id="buscar" class="form-control" placeholder="BUSCAR...">
            <datalist id="encodings">

            </datalist>
            <br>
        </div>

        <div class="alert alert-success" id="alerta">
            <strong>Mensaje</strong> Cargando Categorias...
        </div>

        <div id="table-categorias">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">SLUG</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="category-lista">
                    {{-- @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->productos->count() }}</td>
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
            {{-- REGISTER CATEGORIA --}}
            <div style="display:none" id="formulario-categoria">
                 <h3 class="box-title" style="font-size:24px"><i onclick="back()" class="fas fa-arrow-circle-left"></i> <b>CATEGORIA</b></h3>
                <form action="{{ route('categoria.store') }}" method="post" id="categoria-create">
                    @csrf
                    <br><br>
                    <div class="form-row">
                        <div class="form-group col-md-6" id="agregar">
                            <input id="cname" type="text" name="name[]" class="form-control" placeholder="Nombre Categoria" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <a href="#" class="btn btn-primary" id="add">Añadir</a>
                            <a href="#" class="btn btn-danger" id="remove">Eliminar</a>

                            <input type="hidden" id="pid" name="id" value="" >
                            <input type="submit" class="btn btn-success" id="bottom-register" value="Enviar">
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

