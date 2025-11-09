<div class="rc-topbar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rc-topbar-content">
                    @php
                    $settings = getWebsiteSetting();
                    @endphp
                    <span class="rc-topbar-phone">{{ $settings[0]['phone'] ?? '' }}</span>
                    <div class="rc-topbar-opening-time">
                        <span>OPENING TIME:</span>
                        @if (!empty($settings[0]['opening_schedule']))
                        @php
                        $today = \Carbon\Carbon::now()->format('l'); // e.g., "Monday"
                        $todaySchedule = $settings[0]['opening_schedule'][$today] ?? null;
                        @endphp
    
                        @if (!empty($todaySchedule['active']) && $todaySchedule['from'] && $todaySchedule['to'])
                        {{ $today }} {{ $todaySchedule['from'] }} - {{ $todaySchedule['to'] }}
                        @else
                        Closed Today
                        @endif
                        @else
                        Not Set
                        @endif
                    </div>
                    <div class="rc-btn-group">
                        @guest
                        <button class="rc-btn rc-btntwo" onclick="window.location.href='{{ route('login') }}';">{{ __('auth.login') }}</button>
                        <button class="rc-btn rc-btn-theme" onclick="window.location.href='{{ route('register.form') }}';">{{ __('auth.signup') }}</button>
                        @endguest
                        @auth
                        <button class="rc-btn rc-btn-theme"
                            onclick="window.location.href='{{ route('user.profile') }}';">{{ __('auth.profile') }}</button>
                        @endauth
                        <button class="rc-btn rc-btn-outline-secondary btn-sm dropdown-toggle" type="button" id="currencyDropdown"
                            data-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="currencyDropdown">
                            @foreach(getLang() as $key => $lang)
                            <li>
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang->code) }}"
                                    onclick="selectCurrency('{{ $lang->code }}')">{{ strtoupper($lang->code) }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
