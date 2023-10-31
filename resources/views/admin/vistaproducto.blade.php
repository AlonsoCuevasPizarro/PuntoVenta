@extends('layouts.main')
@section('main-content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="container">
        {{-- aca va todo el contenido de la pagina --}}
<h1>Vista Productos</h1>
<hr>

@foreach ($categories as $key => $category)
    <section class="mb-5">
        <h6>Categoría: {{ $category->name }}</h6>
        <table id="tabla-productos" class="table table-bordered datatable-table">
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
                @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{ $product->id }}</td>
                        <td>{{ $product->barcode }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stocks }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endforeach

    </div>
</main>

{{-- scripts de plugins para DataTable --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

{{-- script configuracion de Datatable --}}
<script>
    $(document).ready(function() {
        $('#tabla-productos').DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [{
                    // boton para exportar como excel
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Excluir la última columna (columna de acción)
                    }
                },
                {
                    // boton para exportar como pdf
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    className: 'btn btn-danger btn-sm',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Excluir la última columna (columna de acción)
                    }
                }
            ]
        });
    });
</script>

@endsection