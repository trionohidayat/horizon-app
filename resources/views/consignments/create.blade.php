<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Consignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <form action="{{ route('consignments.store') }}" method="POST" class="container my-4">
        @csrf
        <div class="row g-4">
            
            <!-- Sender Details -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">1. DETAIL PENGIRIMAN (Alamat Pengambilan)</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Passport</label>
                            <input type="text" name="passport_no" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mode Pengiriman</label>
                            <select name="shipping_mode" class="form-select" required>
                                <option value="">-- Pilih Mode --</option>
                                <option value="Reguler">Reguler</option>
                                <option value="Laut">Laut</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama:</label>
                            <input type="text" name="sender_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat Hotel:</label>
                            <input type="text" name="sender_hotel" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota:</label>
                            <input type="text" name="sender_city" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Negara:</label>
                            <input type="text" name="sender_country" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="sender_phone" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Receiver Details -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">2. DETAIL PENERIMA (Alamat Tujuan)</div>
                    <div class="card-body row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nama:</label>
                            <input type="text" name="receiver_name" class="form-control" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Alamat:</label>
                            <input type="text" name="receiver_address" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kota:</label>
                            <input type="text" name="receiver_city" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="receiver_province" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode Pos:</label>
                            <input type="number" name="receiver_postal_code" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Negara:</label>
                            <input type="text" name="receiver_country" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Kontak:</label>
                            <input type="text" name="receiver_contact" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor Telepon:</label>
                            <input type="number" name="receiver_phone" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cargo Items -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <span>3. ITEM KARGO</span>
                        <button type="button" class="btn btn-sm btn-light" id="add-item-btn">➕ Tambah Barang</button>
                    </div>
                    <div class="card-body" id="cargo-items-wrapper">
                        <div class="row g-3 cargo-item">
                            <div class="col-md-4">
                                <input type="text" name="cargo_items[0][description]" class="form-control" placeholder="Deskripsi Barang" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="cargo_items[0][quantity]" class="form-control" placeholder="Jumlah" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="cargo_items[0][price]" class="form-control" placeholder="Harga" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <!-- No remove button for first item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cargo Details -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">4. DETAIL KARGO</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Karton:</label>
                            <select name="carton_type" id="carton_type" class="form-select" required>
                                <option value="">-- Select Type --</option>
                                <option value="S" data-price="14">Small (S) 40x35x35 SAR 14.00</option>
                                <option value="M" data-price="18">Medium (M) 50x40x40 SAR 18.00</option>
                                <option value="L" data-price="40">Large (L) 60x50x50 SAR 40.00</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Berat:</label>
                            <input type="number" name="weight" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Admin: </label>
                            <input type="number" name="admin_fee" id="admin_fee" value="10" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Total Biaya: </label>
                            <input type="number" name="total_cost" id="total_cost" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">5. Terms and Conditions</div>
                    <div class="card-body">
                        <ul class="list-disc list-inside text-sm text-gray-700 space-y-2">
                            <li>Dengan ini saya menyatakan bahwa rincian yang disebutkan di atas adalah benar dan tepat.</li>
                            <li>Saya menyatakan bahwa barang dikemas di hadapan saya tidak ada barang terlarang, tidak dikenal dan tidak ada barang curian di dalam paket saya.</li>
                            <li>Saya bertanggung jawab penuh atas barang yang dinyatakan dalam daftar pengapakan sesuai dengan peraturan bea cukai negara ekspor dan pengimpor.</li>
                            <li>Saya dengan ini setuju untuk mengangkat rugi dan membebaskan biaya pengangkut dan agennya dalam setiap konsekuensi, klaim, risiko, dan kewajiban yang mungkin timbul di tempat asal dan tujuan.</li>
                            <li>Saya setuju untuk menyelesaikan jika berlaku - bea cukai, <i>demurrage</i>, dan biaya resmi lainnya sesuai kwitansi resmi.</li>
                        </ul>
                        <div class="mt-4 flex items-start gap-2">
                            <input type="checkbox" id="agreement" class="mt-1" required>
                            <label for="agreement" class="text-sm text-gray-800">Saya telah membaca dan menyetujui syarat dan ketentuan di atas.</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-4">Submit Consignment</button>
            </div>
        </div>
    </form>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let index = 1;
            const wrapper = document.getElementById('cargo-items-wrapper');
            const addBtn = document.getElementById('add-item-btn');
            addBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('row', 'g-3', 'cargo-item', 'mt-2');
                row.innerHTML = `
                    <div class="col-md-4">
                        <input type="text" name="cargo_items[${index}][description]" class="form-control" placeholder="Description">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="cargo_items[${index}][quantity]" class="form-control" placeholder="Quantity">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="cargo_items[${index}][price]" class="form-control" placeholder="Price">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-danger remove-item">❌ Remove</button>
                    </div>
                `;
                wrapper.appendChild(row);
                index++;
            });
            wrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.cargo-item').remove();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Carton Price Map
            const cartonPrices = {
                S: 14,
                M: 18,
                L: 40
            };
            const cartonSelect = document.getElementById('carton_type');
            const adminFeeInput = document.getElementById('admin_fee');
            const totalCostInput = document.getElementById('total_cost');

            function updateTotalCost() {
                const selectedCarton = cartonSelect.value;
                const cartonPrice = cartonPrices[selectedCarton] || 0;
                const adminFee = parseFloat(adminFeeInput.value) || 0;
                const total = cartonPrice + adminFee;
                totalCostInput.value = total;
            }
            cartonSelect.addEventListener('change', updateTotalCost);
            adminFeeInput.addEventListener('input', updateTotalCost);

            updateTotalCost(); // initial call
        });

        document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('agreement');
        const submitButton = document.querySelector('button[type="submit"]');

        const toggleSubmit = () => {
            submitButton.disabled = !checkbox.checked;
            submitButton.classList.toggle('opacity-50', !checkbox.checked);
            submitButton.classList.toggle('cursor-not-allowed', !checkbox.checked);
        };

        checkbox.addEventListener('change', toggleSubmit);
        toggleSubmit(); // set initial state
    });
    </script>
</body>
</html>
