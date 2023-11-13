@extends('layouts.main')
@section('main-content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">



        <section id="boton">
            <br>
            <div class="registroventa-container">
                {{-- aca va todo el contenido de la pagina --}}
                <h1 class="my-4">Registro Venta</h1>
                <hr>
                <br>
            </div>
        </section>



        <div class="container">
            <div class="left">
                <!-- Elementos que quieres a la izquierda -->
                <h1>Productos de la Venta</h1>
                <hr>
                <br>

                <!-- Agregar el formulario de búsqueda -->
                <form action="{{ route('buscarProducto') }}" method="post">
                    @csrf
                    <label for="barcode">Buscar por Barcode:</label>
                    <input type="text" name="barcode" id="barcode">
                    <button type="submit">Buscar</button>
                </form>

                <!-- Mostrar la tabla de resultados -->
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Codigo de Barra</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products ?? [] as $product)
                            <tr>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ '$ ' . $product->price }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <!-- Botón para limpiar búsquedas -->
                <a href="{{ route('limpiarBusquedas') }}">Limpiar Búsquedas</a>

                <!---------------------------------------------------------------------->

                <br>
                <br>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Codigo de Barra</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($barcode)
                            <tr>
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ '$ ' . $product->price }}</td>
                            </tr>
                        @endisset
                    </tbody>

                </table>
            </div>


            <div class="right">
                <!-- Elementos que quieres a la derecha -->
                <h1>Costo de la Venta</h1>
                <hr>
                <br>
                <br>
                <h2>Deuda Total: </h2>
                <br>
                <br>
                <h2>Se paga:</h2>
                <br>
                <br>
                <h2>Vuelto:</h2>
            </div>
        </div>
        </div>

        <style>
            /* Estilos básicos para el diseño */
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .container {
                width: 100%;
                margin: 0 auto;
                overflow: hidden;
                /* Para contener los elementos flotantes */
            }

            .left {
                float: left;
                width: 50%;
                background: lightgrey;
            }

            .right {
                float: right;
                width: 50%;
                padding-left: 5%;
            }
        </style>


    </main>
@endsection
