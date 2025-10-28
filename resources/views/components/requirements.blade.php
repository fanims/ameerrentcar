 <section class="page-section rc-requirement">
        <div class="{{ $from == 'home' ? 'container' : '' }}">
            <div class="row">
                <div class="col-12">
                    <div class="rc-section-title">
                        <div class="rc-section-title-content">
                            <span>{{ __('home.requirements_tagline') }}</span>
                            <h2>{{ __('home.requirements') }}</h2>
                            <p>{{ __('home.requirements_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="requirement-cards">
                        <!-- Emirates & UAE Residents Card -->
                        <div class="requirement-card">
                            <div class="requirement-card-content">
                                <h2 class="requirement-card-title">{{ __('home.requirement_title') }}</h2>
                                <ul class="requirement-list">
                                    <li>
                                        <span>{{ __('home.emirates_id') }} {{ __('home.emirates_id_desc') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.uae_driving_licence') }} {{ __('home.uae_driving_licence_desc') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.debit_card_and_cash') }} {{ __('home.debit_card_and_cash_desc') }} </span>
                                        <span>{{ __('home.residential_visa') }}</span>
                                    </li>
                                </ul>
                            </div>
                            <button class="rc-btn-theme">{{ __('home.book_now') }}</button>
                        </div>
        
                        <!-- Foreign Tourist Card -->
                        <div class="requirement-card">
                            <div class="requirement-card-content">
                                <h2 class="requirement-card-title">{{ __('home.foreign_tourist') }}</h2>
                                <ul class="requirement-list">
                                    <li>
                                        <span>{{ __('home.foreign_tourist_desc') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.passport') }} {{ __('home.passport_desc') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.home_country_driving_license') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.IDP') }} {{ __('home.IDP_desc') }}</span>
                                    </li>
                                    <li>
                                        <span>{{ __('home.debit_card_and_cash') }} {{ __('home.debit_card_and_cash_desc') }}</span>
                                    </li>
                                </ul>
                            </div>
                            <button class="rc-btn-theme">{{ __('home.book_now') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>