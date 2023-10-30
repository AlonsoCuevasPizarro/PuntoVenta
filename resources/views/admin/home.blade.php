@extends('layouts.main')
@section('main-content')
    <div class="container py-4">
        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-primary" href="{{ route('logout') }}">Cerrar Sesión</a>
        </div>

        <h4 class="my-4">PANTALLA - AGREGAR / ELIMINAR Y VISTA DE PRODUCTOS</h4>
        <h4 class="my-4">DESPUES VOY A SEPARAR ESTAS DOS PANTALLAS </h4>
        <hr />

        @if ($errors->any())
            <div class="alert alert-danger my-4" role="alert">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif

        {{-- creacion de categorias --}}
        <section class="section-separator">
            <h5>Crear nuevas categorias</h5>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <input type="text" placeholder="Nombre de la categoria" name="name">
                <input type="submit" value="Crear Categoría">
            </form>
        </section>
        <hr />



        <section class="section-separator">
            <h5>Agregar un Nuevo Producto con Categoria</h5>
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <span>Categorias</span>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="input-group mt-2">
                    <span class="input-group-text">Codigo de barra</span>
                    <input type="number" class="form-control" name="barcode">
                </div>
                <div class="input-group mt-2">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="input-group mt-2">
                    <span class="input-group-text">Cantidad</span>
                    <input type="number" class="form-control" name="stocks">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Precio</span>
                    <input type="number" class="form-control" name="price">
                </div>
                <input type="submit" value="Agregar Producto" class="btn btn-primary mt-4">
            </form>
        </section>
        <hr />





        <h5 class="section-separator mb-4">Listar nuevas categorias</h5>
        @foreach ($categories as $key => $category)
            <section class="mb-5">
                <h6>Categoría: {{ $category->name }} ( id: {{ $category->id }})</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Codigo de Barra</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->products as $product)
                            <tr>
                                <td scope="row">{{ $product->id }}</td>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stocks }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    {{--
     IMPORTANTE

     Por defecto las solicitudes en los navegadores son post o get. Cuando uno define un metodo diferente para la ruta en laravel (en este caso delete),
     Debe enviar la petición dentro de un formulario y especificar el metodo con @method().
     El @csrf generará un token unico para el formulario que laravel gestiona por detrás de escena, con ello previene ataques maliciosos en los formularios
--}}
                                    <form action="{{ route('products.delete', ['id' => $products->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Eliminar" class="btn btn-outline-secondary btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endforeach
    </div>
@endsection


@push('css')
    <style>
        .section-separator {
            margin-top: 80px;
        }
    </style>
@endpush
