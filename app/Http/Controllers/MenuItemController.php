<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    // 1. แสดงรายการทั้งหมด (Read)
    public function index(Request $request) 
    {
        $menus = MenuItem::all();

        // เช็คว่าถ้าเรียกผ่าน path ที่ขึ้นต้นด้วย api/ ให้คืนค่าเป็น JSON
        if ($request->is('api/*')) {
            return response()->json($menus, 200);
        }

        return view('menus.index', compact('menus'));
    }

    // 2. หน้าฟอร์มเพิ่มเมนู (Create) - (เฉพาะ Web)
    public function create() 
    {
        return view('menus.create');
    }

    // 3. บันทึกข้อมูล (Store)
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

        // ถ้าไม่ได้ส่ง is_available มา ให้ค่าเริ่มต้นเป็น 1 (เปิดขาย)
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

  // 4. แสดงข้อมูลรายตัว (Show)
    public function show(Request $request, MenuItem $menu) 
    {
        // หากเรียกผ่าน API ให้คืนค่า JSON
        if ($request->is('api/*')) {
            return response()->json($menu, 200);
        }

        // หากเรียกผ่านหน้าเว็บ
        return view('menus.show', compact('menu'));
    }
    // 5. หน้าฟอร์มแก้ไข (Edit) - (เฉพาะ Web)
    public function edit(MenuItem $menu) 
    {
        return view('menus.edit', compact('menu'));
    }

    // 6. อัปเดตข้อมูล (Update)
    public function update(Request $request, MenuItem $menu) 
    {
        $validated = $request->validate([
            // ยกเว้นการเช็ครหัสซ้ำสำหรับ ID ของเมนูที่กำลังแก้ไขอยู่
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

        // กรณีอัปเดตผ่านฟอร์มหน้าเว็บ ถ้าไม่ได้ติ๊ก Checkbox มันจะไม่ส่งค่ามา ให้บังคับเป็น 0 (ปิดขาย)
        // แต่ถ้าส่งมาทาง API หรือติ๊กมา ก็ให้ใช้ค่านั้น
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

    // 7. ลบข้อมูล (Delete)
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