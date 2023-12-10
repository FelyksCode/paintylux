<?php
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;
use App\Models\Order;

use function Livewire\Volt\{layout, state, mount};

layout('layouts.app');

state([
    'order' => Auth::user()->activeOrder(),
    'details' => collect([]),
    'exists' => Auth::user()->activeOrder() ? true : false,
])->locked();

mount(function () {
    if ($this->exists) {
        $this->order->getOrderDetails();
        $this->details = $this->order->orderDetails->get();
    }
});

$updateQuantity = function ($id, $add) {
    // Ensure order detail exists
    $orderDetail = OrderDetail::find($id);
    if (!$orderDetail || $orderDetail->order_id !== $this->order->id) {
        return;
    }

    // Get current quantity
    $currentQuantity = $orderDetail->quantity;

    // Ask to delete quantity decrease and quantity is 1
    if ($currentQuantity === 1 && !$add) {
        $this->dispatch('open-modal', "confirm-detail-$id-deletion");
        return;
    }

    // Update quantity
    $orderDetail->update([
        'quantity' => $currentQuantity + ($add ? 1 : -1),
    ]);

    // Refresh order details and dispatch event
    $this->order->getOrderDetails();
    $this->details = $this->order->orderDetails->get();
    $this->dispatch('order-updated');
};

$delete = function ($id) {
    OrderDetail::find($id)->delete();
    $this->order->getOrderDetails();
    $this->details = $this->order->orderDetails->get();
    $this->dispatch('order-updated');
};

$checkout = function () {
    $this->order->confirmOrder();
    return $this->redirect(route('profile'), navigate: true);
};

?>

<section
    class="std-section flex flex-col space-y-6 min-[1280px]:flex-row min-[1280px]:space-x-12 min-[1280px]:space-y-0">
    {{-- Orders --}}
    <section class="flex w-full flex-col space-y-6 min-[1280px]:w-[60%]">
        {{-- Header --}}
        <x-header-count :title="__('Checkout')" :count="$this->exists ? $this->order->totalQuantity($minified = true) : 0" />
        <hr class="border-[rgb(var(--fg-rgb))]">

        @if ($this->details->count())
            <a wire:navigate href="{{ route('products') }}"
                class="text-link smooth group flex w-fit items-center space-x-2 hover:opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="smooth h-5 w-5 opacity-90 group-hover:opacity-100">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                </svg>
                <div
                    class="text-upperwide smooth text-lg opacity-90 group-hover:tracking-[0.15em] group-hover:opacity-100">
                    {{ __('Kembali lihat produk') }}
                </div>
            </a>
        @endif

        {{-- List --}}
        <div class="max-h-[450px] w-full space-y-2 overflow-y-scroll xl:h-[450px]">
            @forelse ($this->details as $detail)
                <div
                    class="flex flex-col space-y-4 rounded-lg border border-[rgba(var(--fg-rgb),0.3)] px-6 py-4 shadow-md shadow-[rgba(var(--fg-rgb),0.15)] min-[530px]:flex-row min-[530px]:items-center min-[530px]:justify-between min-[530px]:space-y-0">
                    <div
                        class="flex flex-col items-center space-y-2 text-center min-[530px]:flex-row min-[530px]:space-x-4 min-[530px]:space-y-0 min-[530px]:text-start">
                        <!-- Color -->
                        <div class="aspect-square h-[100px] w-[100px] rounded-full border border-[rgba(var(--fg-rgb),0.2)]"
                            style="background-color: #{{ $detail->color->hex }}"></div>

                        <!-- Details -->
                        <div class="space-y-2">
                            <div>
                                <div class="text-xl font-medium">
                                    {{ $detail->color->name }}
                                </div>
                                <div class="text-upperwide text-sm">
                                    {{ $detail->category->name() }}
                                </div>
                            </div>
                            <div class="text-upperwide font-bold">{{ format_price($detail->subtotal()) }}</div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="flex flex-col items-center space-y-2">
                        <div class="flex flex-col items-center">
                            <div class="text-upperwide text-sm">
                                {{ __('Jumlah') }}
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg wire:click.debounce.0ms="updateQuantity({{ $detail->id }}, false)"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="smooth h-4 w-4 cursor-pointer hover:opacity-75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                </svg>
                                <div class="select-none text-3xl font-bold tracking-tighter">
                                    {{ $detail->quantity }}
                                </div>
                                <svg wire:click.debounce.0ms="updateQuantity({{ $detail->id }}, true)"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="smooth h-4 w-4 cursor-pointer hover:opacity-75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                        <x-icons.delete-button
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-detail-{{ $detail->id }}-deletion')"
                            class="!h-5 !w-5 text-[rgb(var(--red-rgb))]" />
                    </div>
                </div>
                <x-modal name="confirm-detail-{{ $detail->id }}-deletion" :show="false" focusable>
                    <div class="p-6">
                        <h2 class="text-lg font-medium">
                            {{ __('Apakah Anda yakin ingin menghapus produk ini dari keranjang?') }}
                        </h2>
                        <div class="mt-6 flex">
                            <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                                {{ __('Batal') }}
                            </x-primary-button>

                            <x-danger-button class="ms-3" wire:click="delete({{ $detail->id }})"
                                x-on:click="$dispatch('close')">
                                {{ __('Hapus') }}
                            </x-danger-button>
                        </div>
                    </div>
                </x-modal>
            @empty
                <div class="text-inactive text-lg min-[500px]:text-xl">
                    {{ __('Anda belum melakukan pemesanan.') }}
                    <br class="hidden min-[350px]:block">
                    <a href="{{ route('products') }}" class="text-link">{{ __('Lihat produk kami') }}</a>
                    {{ __(' untuk mulai memesan.') }}
                </div>
            @endforelse
        </div>
    </section>

    {{-- Summary --}}
    <section class="w-full space-y-4 min-[1280px]:w-[40%]">
        <div
            class="flex flex-col space-y-6 rounded-xl bg-[rgb(var(--fg-rgb))] px-6 py-6 text-[rgb(var(--bg-rgb))] selection:bg-[rgb(var(--bg-rgb))] selection:text-[rgb(var(--fg-rgb))] min-[400px]:px-8">
            <div class="text-upperwide text-2xl font-bold">
                {{ __('Rincian Pesanan') }}
            </div>
            <div class="text-upperwide flex w-full flex-col text-[rgb(var(--bg-rgb),0.7)]">
                <div class="text-xs">{{ __('Jumlah Produk') }}</div>
                <div class="text-xl font-bold">{{ $this->exists ? $this->order->totalQuantity() : 0 }}</div>
            </div>
            <div class="text-upperwide flex w-full flex-col text-[rgb(var(--bg-rgb),0.7)]">
                <div class="text-xs">{{ __('Total Berat') }}</div>
                <div class="text-xl font-bold">{{ $this->exists ? $this->order->totalWeight() : 0 }} kg</div>
            </div>
            <div class="text-upperwide flex w-full flex-col">
                <div>IDR</div>
                <div class="text-3xl font-bold">
                    {{ format_price($this->exists ? $this->order->totalSum() : 0, $prefix = false) }}</div>
            </div>
        </div>
        @if ($this->details->count())
            <button x-on:click.prevent="$dispatch('open-modal', 'confirm-order')"
                class="text-upperwide smooth flex w-full items-center justify-center rounded-lg border border-[rgb(var(--fg-rgb))] p-2 text-[rgb(var(--fg-rgb))] hover:bg-[rgb(var(--fg-rgb))] hover:text-[rgb(var(--white-rgb))]">
                {{ __('Konfirmasi Order') }}
            </button>
            <x-modal name="confirm-order" :show="false" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium">
                        {{ __('Apakah Anda yakin ingin mengkonfirmasi order ini?') }}
                    </h2>
                    <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
                        {{ __('Setelah mengkonfirmasi, kami akan memproses order Anda lebih lanjut.') }}
                    </p>
                    <div class="mt-6 flex">
                        <x-primary-button class="!w-fit !text-[rgb(var(--bg-rgb))]" x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-primary-button>

                        <x-danger-button class="ms-3 !bg-[rgb(var(--green-rgb))] focus:!ring-[rgb(var(--green-rgb))]"
                            wire:click="checkout" x-on:click="$dispatch('close')">
                            {{ __('Order') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        @endif
    </section>
</section>
