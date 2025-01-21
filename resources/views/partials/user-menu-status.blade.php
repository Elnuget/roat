@php
    $lastCashHistory = \App\Models\CashHistory::latest()->first();
    $statusColor = $lastCashHistory && $lastCashHistory->estado === 'Apertura' ? 'success' : 'danger';
    $statusText = $lastCashHistory ? $lastCashHistory->estado : 'Sin registro';
@endphp

<span class="text-sm">
    <i class="fas fa-cash-register"></i>
    <span class="badge badge-{{ $statusColor }} ml-1">{{ $statusText }}</span>
</span>
