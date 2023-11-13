<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RegistroVentaController extends Controller
{
    public function index()
    {
        // Lógica del controlador para la acción "index"
        $products = [];

        return view('registroventa', compact('products'));
    }

    public function buscarProducto(Request $request)
    {
        // Validar la entrada del formulario
        $request->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);

        // Buscar el producto en la base de datos
        $product = Product::where('barcode', $request->barcode)->first();

        // Obtener los resultados anteriores
        $products = $request->session()->get('products', []);

        // Agregar el nuevo resultado
        $products[] = $product;

        // Guardar los resultados en la sesión
        $request->session()->put('products', $products);

        return redirect()->route('registroventa')->with('products', $products);
    }

    public function limpiarBusquedas(Request $request)
    {
        // Limpiar los resultados en la sesión
        $request->session()->forget('products');

        return redirect()->route('registroventa');
    }
}
