    @php
    use App\Models\WebsiteSetting;
    $setting = WebsiteSetting::first();
    @endphp

<div class="card car-item">
    <!-- Badges -->
    <!-- <div class="rc-badges">
        <span class="badge">🔥</span>
        <span class="badge">{{
            __('home.new') }}</span>
    </div> -->

    <!-- Image -->
    <div class="position-relative image-hover-wrapper">
        <a href="{{ route('checkout', $car->slug) }}">
            <img loading="lazy" src="{{ asset('storage/' . $car->thumbnail_image) }}" class="card-img-top"
                alt="{{ trans_field($car->name) }}" />
    
            <!-- Overlay -->
            <div class="image-overlay"></div>
    
            <!-- Details Button -->
            <span"
                class="btn btn-theme btn-theme-transparent item-btn details-btn">
                {{ __('home.details') }}
            </span>
        </a>
    </div>

    <div class="card-body custom-card-body">
        <!-- Category -->
        <span class="item-manufacturer">
            {{ $car->category->name[App::getLocale()] ?? $car->category->name['en'] ?? '' }}
        </span>

        <!-- Title -->
        <h5 class="item-model">
            {{ trans_field($car->name) }} - {{ $car->model_year }}
        </h5>

        <!-- Price Section -->
        <div class="item-prices">
            @if ($car->base_price_per_month != $car->current_price_per_month)
                <div class="item-price">
                    <div class="text-muted text-decoration-line-through small">
                        {{ getCurrencySymbol() }} {{ $car->base_price_per_month }}
                    </div>
                </div>
            @endif
            <div class="item-price">
                <span class="duration">{{ __('home.monthly') }}</span>
                <span class="currency">{{ getCurrencySymbol() }}</span>
                <span class="price">{{ $car->current_price_per_month }}</span>
            </div>
            @if ($car->base_price_per_week != $car->current_price_per_week)
                <div class="item-price">
                    <div class="text-muted text-decoration-line-through small">
                        {{ getCurrencySymbol() }} {{ $car->base_price_per_week }}
                    </div>
                </div>
            @endif
            <div class="item-price">
                <span class="duration">{{ __('home.weekly') }}</span>
                <span class="currency">{{ getCurrencySymbol() }}</span>
                <span class="price">{{ $car->current_price_per_week }}</span>
            </div>
            @if ($car->base_price_per_day != $car->current_price_per_day)
                <div class="item-price">
                    <div class="text-muted text-decoration-line-through small">
                        {{ getCurrencySymbol() }} {{ $car->base_price_per_day }}
                    </div>
                </div>
            @endif
            <div class="item-price">
                <span class="duration">{{ __('home.daily') }}</span>
                <span class="currency">{{ getCurrencySymbol() }}</span>
                <span class="price">{{ $car->current_price_per_day }}</span>
            </div>
        </div>
    </div>
    <!-- Buttons -->
    <div class="item-buttons">
        <a href="{{ route('checkout-form', $car->id) }}" class="rc-btn rc-btntwo">{{ __('home.book_now') }}</a>
    </div>
</div>