@php
    $tipe = $tipe ?? 'info';
@endphp

<div class="alert alert-{{ $tipe }}" role="alert">
    {{ $pesan }}
</div>