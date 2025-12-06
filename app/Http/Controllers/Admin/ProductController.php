<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Метод index - список товаров
    public function index()
    {
        // Проверка авторизации
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Проверка прав админа
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    
    // Метод create - форма создания товара
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        return view('admin.products.create');
    }
    
    // Метод store - сохранение товара
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->all();
        
        // Загрузка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['image'] = $imageName;
        }
        
        Product::create($data);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно создан!');
    }
    
    // Метод show - просмотр товара
    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }
    
    // Метод edit - форма редактирования товара
    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    
    // Метод update - обновление товара
    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $product = Product::findOrFail($id);
        $data = $request->all();
        
        // Обновление изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $data['image'] = $imageName;
        }
        
        $product->update($data);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно обновлен!');
    }
    
    // Метод destroy - удаление товара
    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа');
        }
        
        $product = Product::findOrFail($id);
        
        // Удаляем изображение
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален!');
    }
}