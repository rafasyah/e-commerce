@extends('layouts.app')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
    {{ session('error') }}
</div>
@endif

{{-- Error message container for JavaScript --}}
<div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 hidden">
    <span id="errorText"></span>
</div>

<div class="bg-white rounded-2xl shadow-lg p-8 grid md:grid-cols-2 gap-10">

    <div>
        <img
            src="{{ asset('storage/' . $product->gambar) }}"
            alt="{{ $product->nama_barang }}"
            class="rounded-2xl w-full h-96 object-cover"
            onerror="this.src='{{ asset('images/placeholder-product.jpg') }}'"
        >
    </div>

    <div>

        <h1 class="text-4xl font-bold">
            {{ $product->nama_barang }}
        </h1>

        <p class="text-orange-500 text-3xl font-bold mt-4">
            Rp {{ number_format($product->harga) }}
        </p>

        <p class="text-gray-600 mt-6 leading-8">
            {{ $product->deskripsi }}
        </p>

        <p class="mt-4 font-semibold">
            Stok: {{ $product->stok }}
        </p>

        <form
            id="checkoutForm"
            action="{{ route('checkout', $product->id) }}"
            method="POST"
            class="mt-8"
            onsubmit="return showCheckoutConfirmation(event)"
        >
            @csrf

            <div class="mb-4">
                <label for="jumlah" class="block text-gray-700 font-semibold mb-2">
                    Jumlah
                </label>
                <input
                    type="number"
                    id="jumlah"
                    name="jumlah"
                    placeholder="Masukkan jumlah"
                    min="1"
                    max="{{ $product->stok }}"
                    class="border w-full p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500"
                    required
                    aria-describedby="jumlah-help"
                >
                <small id="jumlah-help" class="text-gray-500">Stok tersedia: {{ $product->stok }}</small>
            </div>

            <div class="mb-6">
                <label for="jenis_pembayaran" class="block text-gray-700 font-semibold mb-2">
                    Metode Pembayaran
                </label>
                <select
                    id="jenis_pembayaran"
                    name="jenis_pembayaran"
                    class="border w-full p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500"
                    required
                    aria-describedby="payment-help"
                >
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
                <small id="payment-help" class="text-gray-500">Pilih metode pembayaran yang diinginkan</small>
            </div>

            <button
                type="submit"
                class="bg-orange-500 text-white px-8 py-3 rounded-xl hover:bg-orange-600 w-full font-semibold"
            >
                Checkout Sekarang
            </button>

        </form>

        <!-- Checkout Confirmation Modal -->
        <div id="checkoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" role="document">
                <div class="mt-3">
                    <div class="flex items-center justify-center">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <h3 id="modal-title" class="text-lg font-medium text-gray-900 text-center mt-4">
                        Konfirmasi Checkout
                    </h3>
                    <div class="mt-4 px-4">
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="font-medium">Produk:</span>
                                <span id="modal-product">{{ $product->nama_barang }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Jumlah:</span>
                                <span id="modal-quantity">-</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Harga Satuan:</span>
                                <span>Rp {{ number_format($product->harga) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">Pembayaran:</span>
                                <span id="modal-payment">-</span>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total:</span>
                                <span id="modal-total">-</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button
                            type="button"
                            onclick="closeModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition focus:outline-none focus:ring-2 focus:ring-gray-500"
                            aria-label="Batal checkout"
                        >
                            Batal
                        </button>
                        <button
                            type="button"
                            id="confirmBtn"
                            onclick="confirmCheckout()"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition focus:outline-none focus:ring-2 focus:ring-orange-500"
                            aria-label="Konfirmasi dan lanjutkan checkout"
                        >
                            <span id="confirmText">Konfirmasi & Checkout</span>
                            <span id="loadingText" class="hidden">Memproses...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
function showCheckoutConfirmation(event) {
    event.preventDefault();

    const jumlah = document.getElementById('jumlah').value;
    const jenisPembayaran = document.getElementById('jenis_pembayaran').value;
    const harga = {{ $product->harga }};
    const stok = {{ $product->stok }};

    // Validate form
    if (!jumlah || jumlah < 1) {
        showErrorMessage('Silakan masukkan jumlah yang valid (minimal 1)');
        document.getElementById('jumlah').focus();
        return false;
    }

    if (!jenisPembayaran) {
        showErrorMessage('Silakan pilih metode pembayaran');
        document.getElementById('jenis_pembayaran').focus();
        return false;
    }

    if (jumlah > stok) {
        showErrorMessage(`Stok tidak mencukupi. Maksimal ${stok} item tersedia.`);
        document.getElementById('jumlah').focus();
        return false;
    }

    // Calculate total
    const total = jumlah * harga;

    // Update modal content
    document.getElementById('modal-quantity').textContent = jumlah;
    document.getElementById('modal-payment').textContent = getPaymentMethodName(jenisPembayaran);
    document.getElementById('modal-total').textContent = 'Rp ' + total.toLocaleString('id-ID');

    // Show modal
    document.getElementById('checkoutModal').classList.remove('hidden');

    return false;
}

function closeModal() {
    document.getElementById('checkoutModal').classList.add('hidden');
}

function confirmCheckout() {
    // Show loading state
    const confirmBtn = document.getElementById('confirmBtn');
    const confirmText = document.getElementById('confirmText');
    const loadingText = document.getElementById('loadingText');

    confirmBtn.disabled = true;
    confirmText.classList.add('hidden');
    loadingText.classList.remove('hidden');

    // Hide modal
    document.getElementById('checkoutModal').classList.add('hidden');

    // Submit the form
    document.getElementById('checkoutForm').submit();
}

function getPaymentMethodName(method) {
    switch(method) {
        case 'cod':
            return 'Cash on Delivery (COD)';
        case 'transfer':
            return 'Transfer Bank';
        case 'ewallet':
            return 'E-Wallet';
        default:
            return method;
    }
}

function showErrorMessage(message) {
    const errorDiv = document.getElementById('errorMessage');
    const errorText = document.getElementById('errorText');
    errorText.textContent = message;
    errorDiv.classList.remove('hidden');
    errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    // Auto hide after 5 seconds
    setTimeout(() => {
        errorDiv.classList.add('hidden');
    }, 5000);
}

// Close modal when clicking outside
document.getElementById('checkoutModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && !document.getElementById('checkoutModal').classList.contains('hidden')) {
        closeModal();
    }
});

// Prevent form submission on Enter key for better UX
document.getElementById('checkoutForm').addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && event.target.tagName !== 'TEXTAREA') {
        event.preventDefault();
        showCheckoutConfirmation(event);
    }
});
</script>

@endsection