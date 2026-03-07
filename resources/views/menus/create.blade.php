<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root { --cafe-brown: #6f4e37; --cafe-light: #fdfaf7; }
        body { background-color: var(--cafe-light); font-family: 'Sarabun', sans-serif; }
        .card-cafe { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .card-header-cafe { background: var(--cafe-brown); color: white; border-radius: 20px 20px 0 0 !important; padding: 20px; }
        .section-title { color: var(--cafe-brown); font-weight: bold; border-left: 5px solid var(--cafe-brown); padding-left: 10px; margin: 20px 0; }
        .form-control { border-radius: 10px; border: 1px solid #e2d5cc; padding: 10px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-cafe">
                <div class="card-header-cafe">
                    <h4 class="mb-0 text-center"><i class="bi bi-plus-circle me-2"></i> เพิ่มเมนูเครื่องดื่ม/ขนมใหม่</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf

                        <div class="section-title">1. ข้อมูลทั่วไป (General Info)</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">รหัสเมนู</label>
                                <input type="text" name="item_code" class="form-control" placeholder="เช่น CF-001" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ชื่อเมนู (ไทย)</label>
                                <input type="text" name="name_th" class="form-control" placeholder="เช่น เอสเพรสโซ่" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ชื่อเมนู (อังกฤษ)</label>
                                <input type="text" name="name_en" class="form-control" placeholder="เช่น Espresso">
                            </div>
                        </div>

                        <div class="section-title">2. ราคาและต้นทุน (Pricing)</div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label text-danger">ราคาร้อน (Hot)</label>
                                <input type="number" name="price_hot" class="form-control text-center" value="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-primary">ราคาเย็น (Iced)</label>
                                <input type="number" name="price_iced" class="form-control text-center" value="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-success">ราคาปั่น (Frappe)</label>
                                <input type="number" name="price_frappe" class="form-control text-center" value="0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">ราคาทุน (Cost)</label>
                                <input type="number" name="cost_price" class="form-control text-center" placeholder="0" required>
                            </div>
                        </div>

                        <div class="section-title">3. คุณลักษณะ (Attributes)</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">หมวดหมู่</label>
                                <select name="category" class="form-select border-radius-10">
                                    <option value="Coffee">Coffee</option>
                                    <option value="Tea">Tea</option>
                                    <option value="Bakery">Bakery</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ระดับคาเฟอีน</label>
                                <select name="caffeine_level" class="form-select">
                                    <option value="None">ไม่มี (None)</option>
                                    <option value="Low">ต่ำ (Low)</option>
                                    <option value="High">สูง (High)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">หวานแนะนำ (%)</label>
                                <input type="number" name="recommend_sweet" class="form-control" value="100">
                            </div>
                        </div>

                        <div class="section-title">4. สถานะและอื่นๆ (Status & Others)</div>
                        <div class="bg-light p-3 rounded-3 mb-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1" checked>
                                <label class="form-check-label ms-2">เปิดจำหน่ายเมนูนี้</label>
                            </div>
                            <textarea name="note" class="form-control mt-2" placeholder="หมายเหตุเพิ่มเติม เช่น มีเฉพาะฤดูกาล"></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('menus.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill">ยกเลิก</a>
                            <button type="submit" class="btn btn-cafe px-5 py-2 rounded-pill shadow" style="background-color: #198754;">บันทึกข้อมูลเมนู</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>