
@php
    $statuses = [
        'pending' => 'warning',
        'shipped' => 'primary',
        'processing' => 'info',
        'delivered' => 'success',
        'returned' => 'secondary',
        // 'failed_to_delivery' => 'danger',
        'cancelled' => 'dark',
    ];
@endphp

<select id="order-status"  data-order-id="{{ $order->id }}"
    style="color: white !important;    width: fit-content;"
    class="form-select form-select-sm text-white bg-{{ $statuses[$order->status] ?? 'light' }}">
    @foreach ($statuses as $status => $color)
        <option value="{{ $status }}" class="bg-{{ $color }} text-white"
            {{ $order->status == $status ? 'selected' : '' }}>
            {{ ucfirst(str_replace('_', ' ', $status)) }}
        </option>
    @endforeach
</select>
