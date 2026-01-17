<p><strong>Imię:</strong> {{ $d['name'] }}</p>
<p><strong>Email:</strong> {{ $d['email'] }}</p>
<p><strong>Język:</strong> {{ $d['language'] ?? '-' }}</p>
<p><strong>Poziom:</strong> {{ $d['level'] ?? '-' }}</p>
<p><strong>Cel:</strong> {{ $d['goal'] ?? '-' }}</p>
<p><strong>Dostępność:</strong> {{ $d['availability'] ?? '-' }}</p>
<hr>
<p style="white-space: pre-line;">{{ $d['message'] }}</p>
