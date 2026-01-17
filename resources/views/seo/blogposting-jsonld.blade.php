@php
    $json = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp
<script type="application/ld+json">{!! $json !!}</script>
