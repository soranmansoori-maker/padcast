@php
    $size = $size ?? 40;
    $fontSize = $fontSize ?? '1.1rem';
@endphp
<a href="{{ route('homepage') }}" class="d-flex align-items-center" style="text-decoration:none;color:inherit;" aria-label="WaveCast">
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left:8px;">
        <path d="M2 12C6 6 10 6 14 12C18 18 22 18 22 18" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="6" cy="6" r="1.5" fill="#FFFFFF"/>
    </svg>
    <span class="brand-text" style="color:#fff;font-weight:800;font-size:{{ $fontSize }};">WaveCast</span>
</a>
