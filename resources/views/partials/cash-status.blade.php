@php
    $lastCashHistory = \App\Models\CashHistory::latest()->first();
    $statusColor = $lastCashHistory && $lastCashHistory->estado === 'Apertura' ? 'success' : 'danger';
    $statusText = $lastCashHistory ? $lastCashHistory->estado : 'Sin registro';
@endphp

<li class="nav-item">
    <span class="nav-link">
        <i class="fas fa-cash-register"></i>
        Caja: <span class="badge badge-{{ $statusColor }}">{{ $statusText }}</span>
    </span>
</li>
