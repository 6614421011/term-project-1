<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem; // <--- เพิ่มบรรทัดนี้เข้าไปครับ!
class MenuItemController extends Controller
{
    // 1. แสดงรายการทั้งหมด (Read)
    public function index() {
        $menus = MenuItem::all();
        return view('menus.index', compact('menus'));
    }

    // 2. หน้าฟอร์มเพิ่มเมนู (Create)
    public function create() {
        return view('menus.create');
    }

    // 3. บันทึกข้อมูล (Store)
    public function store(Request $request) {
        $request->validate([
            'item_code' => 'required|unique:menu_items',
            'name_th' => 'required',
            'category' => 'required',
            'cost_price' => 'required|numeric',
        ]);

        MenuItem::create($request->all());
        return redirect()->route('menus.index')->with('success', 'เพิ่มเมนูเรียบร้อย!');
    }

    // 4. หน้าฟอร์มแก้ไข (Edit)
    public function edit(MenuItem $menu) {
        return view('menus.edit', compact('menu'));
    }

    // 5. อัปเดตข้อมูล (Update)
    public function update(Request $request, MenuItem $menu) {
        $menu->update($request->all());
        return redirect()->route('menus.index')->with('success', 'อัปเดตข้อมูลแล้ว!');
    }

    // 6. ลบข้อมูล (Delete)
    public function destroy(MenuItem $menu) {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'ลบเมนูแล้ว!');
    }
}