@php
    $items = $items ?? [];
    $list = [];
    $pos = 1;

    foreach ($items as $it) {
        $name = trim((string) ($it['name'] ?? ''));
        $url = (string) ($it['url'] ?? '');

        if ($name === '' || $url === '') {
            continue;
        }

        // jeśli ktoś poda relative, zamień na absolute
        $absUrl = str_starts_with($url, 'http') ? $url : url($url);

        $list[] = [
            '@type' => 'ListItem',
            'position' => $pos++,
            'name' => $name,
            'item' => $absUrl,
        ];
    }
@endphp

@if (count($list) >= 2)
    <script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => $list,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
