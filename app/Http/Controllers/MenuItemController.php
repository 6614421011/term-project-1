<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    // 1. READ
    public function index(Request $request) 
    {
        $menus = MenuItem::all();

        if ($request->is('api/*')) {
            return response()->json($menus, 200);
        }

        return view('menus.index', compact('menus'));
    }

    // 2. CREATE
    public function create() 
    {
        return view('menus.create');
    }

    // 3. POST
    public function store(Request $request) 
    {
        $validated = $request->validate([
            'item_code'       => 'required|unique:menu_items',
            'name_th'         => 'required',
            'name_en'         => 'nullable|string',
            'category'        => 'required',
            'description'     => 'nullable|string',
            'price_hot'       => 'nullable|numeric',
            'price_iced'      => 'nullable|numeric',
            'price_frappe'    => 'nullable|numeric',
            'cost_price'      => 'required|numeric',
            'calories'        => 'nullable|integer',
            'caffeine_level'  => 'nullable|string',
            'recommend_sweet' => 'nullable|integer',
            'is_available'    => 'boolean',
            'note'            => 'nullable|string',
        ]);

        $validated['is_available'] = $request->input('is_available', 1);

        $menu = MenuItem::create($validated);

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'เพิ่มเมนูเรียบร้อย!',
                'data' => $menu
            ], 201);
        }

        return redirect()->route('menus.index')->with('success', 'เพิ่มเมนูเรียบร้อย!');
    }

  // 4. GET ID
    public function show(Request $request, MenuItem $menu) 
    {
        // หากเรียกผ่าน API ให้คืนค่า JSON
        if ($request->is('api/*')) {
            return response()->json($menu, 200);
        }

        // หากเรียกผ่านหน้าเว็บ
        return view('menus.show', compact('menu'));
    }

    // 5. EDIT
    public function edit(MenuItem $menu) 
    {
        return view('menus.edit', compact('menu'));
    }

    // 6. UPDATE
    public function update(Request $request, MenuItem $menu) 
    {
        $validated = $request->validate([
            'item_code'       => 'required|unique:menu_items,item_code,' . $menu->id,
            'name_th'         => 'required',
            'name_en'         => 'nullable|string',
            'category'        => 'required',
            'description'     => 'nullable|string',
            'price_hot'       => 'nullable|numeric',
            'price_iced'      => 'nullable|numeric',
            'price_frappe'    => 'nullable|numeric',
            'cost_price'      => 'required|numeric',
            'calories'        => 'nullable|integer',
            'caffeine_level'  => 'nullable|string',
            'recommend_sweet' => 'nullable|integer',
            'is_available'    => 'boolean',
            'note'            => 'nullable|string',
        ]);

        $validated['is_available'] = $request->has('is_available') ? $request->input('is_available') : 0;

        $menu->update($validated);

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'อัปเดตข้อมูลแล้ว!',
                'data' => $menu
            ], 200);
        }

        return redirect()->route('menus.index')->with('success', 'อัปเดตข้อมูลแล้ว!');
    }

    // 7. DELETE
    public function destroy(Request $request, MenuItem $menu) 
    {
        $menu->delete();

        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'ลบเมนูแล้ว!'
            ], 200);
        }

        return redirect()->route('menus.index')->with('success', 'ลบเมนูแล้ว!');
    }
}