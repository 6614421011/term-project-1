<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController; // <--- แก้ไขจาก MenuItem เป็น MenuItemController

// สร้างเส้นทาง API สำหรับจัดการข้อมูลเมนู (CRUD)
Route::apiResource('menus', MenuItemController::class)
    ->names('api.menus');