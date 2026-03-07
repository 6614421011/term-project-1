<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเมนู - Premium Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root { --cafe-brown: #6f4e37; --cafe-light: #fdfaf7; }
        body { background-color: var(--cafe-light); font-family: 'Sarabun', sans-serif; }
        .card-cafe { border: none; border-radius: 25px; box-shadow: 0 15px 35px rgba(111, 78, 55, 0.07); overflow: hidden; }
        .card-header-cafe { background: var(--cafe-brown); color: white; padding: 20px; border: none; }
        .btn-cafe { background: var(--cafe-brown); color: white; border-radius: 12px; border: none; padding: 12px 25px; }
        .section-title { color: var(--cafe-brown); font-weight: bold; border-left: 5px solid var(--cafe-brown); padding-left: 10px; margin: 25px 0 15px 0; }
        .form-control { border-radius: 10px; padding: 10px; border: 1px solid #e2d5cc; }
    </style>
</head>

<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-cafe">
                <div class="card-header-cafe text-center">
                    <h4 class="mb-0"><i class="bi bi-cup-hot-fill me-2"></i> แก้ไขข้อมูลเมนู: {{ $menu->name_th }}</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="section-title">1. ข้อมูลพื้นฐาน</div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">รหัสเมนู</label>
                                <input type="text" name="item_code" class="form-control bg-light" value="{{ $menu->item_code }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">ชื่อเมนู (ไทย)</label>
                                <input type="text" name="name_th" class="form-control" value="{{ $menu->name_th }}" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">ชื่อเมนู (อังกฤษ)</label>
                                <input type="text" name="name_en" class="form-control" value="{{ $menu->name_en }}">
                            </div>
                        </div>

                        <div class="section-title">2. กำหนดราคา (บาท)</div>
                        <div class="row g-3 text-center">
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-danger">ร้อน</label>
                                <input type="number" name="price_hot" class="form-control text-center" value="{{ $menu->price_hot }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-primary">เย็น</label>
                                <input type="number" name="price_iced" class="form-control text-center" value="{{ $menu->price_iced }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-success">ปั่น</label>
                                <input type="number" name="price_frappe" class="form-control text-center" value="{{ $menu->price_frappe }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">ต้นทุน</label>
                                <input type="number" name="cost_price" class="form-control text-center" value="{{ $menu->cost_price }}">
                            </div>
                        </div>

                        <div class="section-title">3. สถานะการจำหน่าย</div>
                        <div class="row g-3 align-items-center bg-light p-3 rounded-3">
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold ms-2">พร้อมจำหน่าย (เปิด/ปิด)</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="note" class="form-control" placeholder="หมายเหตุเพิ่มเติม เช่น มีเฉพาะหน้าร้อน" value="{{ $menu->note }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>กลับหน้าหลัก
                            </a>
                            <button type="submit" class="btn btn-cafe px-5 rounded-pill shadow">
                                <i class="bi bi-save2 me-2"></i>อัปเดตข้อมูลเมนู
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>