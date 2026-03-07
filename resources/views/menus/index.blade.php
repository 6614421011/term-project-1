<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #fdfaf7; font-family: 'Sarabun', sans-serif; color: #4a3427; }
        .card-cafe { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(111, 78, 55, 0.1); border-top: 5px solid #6f4e37; }
        .btn-cafe { background-color: #6f4e37; color: white; border-radius: 12px; padding: 10px 25px; transition: 0.3s; border: none; }
        .btn-cafe:hover { background-color: #5d402d; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .form-control, .form-select { border-radius: 10px; padding: 12px; border: 1px solid #e2d5cc; }
        .form-control:focus { border-color: #6f4e37; box-shadow: 0 0 0 0.25rem rgba(111, 78, 55, 0.25); }
        .section-header { font-size: 1.1rem; font-weight: 700; color: #6f4e37; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="cafe-card bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="bi bi-cup-hot"></i> เมนูร้านกาแฟของเรา</h2>
            <a href="{{ route('menus.create') }}" class="btn btn-cafe"><i class="bi bi-plus-lg"></i> เพิ่มเมนูใหม่</a>
        </div>

        <form action="{{ route('menus.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="ค้นหาชื่อเมนูหรือรหัส..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-dark w-100">ค้นหา</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-3">รหัส</th>
                        <th>ชื่อเมนู</th>
                        <th>หมวดหมู่</th>
                        <th class="text-center">ราคา (R/Y/P)</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center pe-3">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                    <tr>
                        <td class="ps-3 fw-bold">#{{ $menu->item_code }}</td>
                        <td>
                            <div class="fw-bold">{{ $menu->name_th }}</div>
                            <small class="text-muted">{{ $menu->name_en }}</small>
                        </td>
                        <td><span class="badge bg-secondary rounded-pill">{{ $menu->category }}</span></td>
                        <td class="text-center fw-bold text-brown">{{ $menu->price_hot }}/{{ $menu->price_iced }}/{{ $menu->price_frappe }}</td>
                        <td class="text-center">
                            {!! $menu->is_available ? '<span class="text-success"><i class="bi bi-check-circle-fill"></i> พร้อม</span>' : '<span class="text-danger"><i class="bi bi-x-circle-fill"></i> หมด</span>' !!}
                        </td>
                        <td class="text-center pe-3">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-light text-warning"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('ลบเมนูนี้?')"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted">ไม่พบข้อมูลเมนู</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>