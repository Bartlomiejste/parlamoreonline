@php
    $courseLabels = [
        'individual' => __('contact.form.course_individual'),
        'pair' => __('contact.form.course_pair'),
        'group' => __('contact.form.course_group'),
    ];

    $course = $d['course_type'] ?? '';
    $courseText = $courseLabels[$course] ?? '-';
@endphp

<p><strong>Imię:</strong> {{ $d['name'] ?? '-' }}</p>
<p><strong>Email:</strong> {{ $d['email'] ?? '-' }}</p>
<p><strong>Typ kursu:</strong> {{ $courseText }}</p>
<hr>
<p style="white-space: pre-line;">{{ $d['message'] ?? '' }}</p>
