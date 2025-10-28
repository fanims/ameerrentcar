<ol class="breadcrumb float-sm-right">
    @php
        $build = '';
    @endphp
    @foreach ($segments as $segment)
        @continue(is_numeric($segment)) {{-- Skip numeric segments like IDs --}}

        @php
            $build .= '/' . $segment;
            $isLast = $loop->last;

            // Label and custom mapping
            $label = ucwords(str_replace(['-', '_'], ' ', $segment));
            $customLink = $build;

            if ($segment === 'admin') {
                $label = 'Dashboard';
                $customLink = '/admin/dashboard';
            }
        @endphp

        <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}">
            @if (!$isLast)
                <a href="{{ url($customLink) }}">{{ $label }}</a>
            @else
                {{ $label }}
            @endif
        </li>
    @endforeach
</ol>
