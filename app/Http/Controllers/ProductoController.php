<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    // 📌 Mostrar listado de productos
    public function index()
    {
        $productos = Producto::with('categoria')->get(); // Carga la relación categoría
        $categorias = Categoria::all(); // Para mostrar las categorías en la vista
        return view('productos.index', compact('productos', 'categorias'));
    }

    // 📌 Formulario para crear un nuevo producto
    public function create()
    {
        $categorias = Categoria::all(); // Pasar categorías para el formulario
        return view('productos.create', compact('categorias'));
    }

    // 📌 Guardar nuevo producto
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|max:2048', // Validación para imagen
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Guardar el producto
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;

        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $imagenPath;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    // 📌 Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // 📌 Formulario para editar un producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Pasar categorías para el formulario de edición
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // 📌 Actualizar producto
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;

        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $imagenPath;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // 📌 Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        // Eliminar imagen si existe
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    // 📌 Mostrar productos por categoría
    public function categoria($slug)
    {
        $categoria = Categoria::where('slug', $slug)->firstOrFail();
        $productos = $categoria->productos()->with('categoria')->paginate(10);
        return view('productos.categoria', compact('productos', 'categoria'));
    }
}