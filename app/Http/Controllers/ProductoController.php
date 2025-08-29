<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // 📌 Mostrar listado de productos
    public function index()
    {
        return view('productos.index');
    }

    // 📌 Formulario para crear un nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // 📌 Guardar nuevo producto
    public function store(Request $request)
    {
        // Aquí iría la lógica para guardar en BD
        // Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    // 📌 Mostrar un producto específico
    public function show($id)
    {
        // $producto = Producto::findOrFail($id);
        return view('productos.show', compact('id'));
    }

    // 📌 Formulario para editar un producto
    public function edit($id)
    {
        // $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('id'));
    }

    // 📌 Actualizar producto
    public function update(Request $request, $id)
    {
        // $producto = Producto::findOrFail($id);
        // $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // 📌 Eliminar producto
    public function destroy($id)
    {
        // $producto = Producto::findOrFail($id);
        // $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
