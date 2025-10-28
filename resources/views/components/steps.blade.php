 <section class="page-section dark">
        <div class="{{ $from == 'home' ? 'container' : 'container-fluid' }} my-5">
            <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <small>{{ __('home.what_you_want') }}</small>
                <span>{{ __('home.rent_your_car_in_dubain') }}</span>
            </h2>

            <!-- Requirements Intro Text -->
            <div class="requirement-text">
                <p>
                    {{ __('home.rent_your_car_in_dubain_desc_1') }}
                </p>
                <p>
                    {{ __('home.rent_your_car_in_dubain_desc_2') }}
                </p>
            </div>

            <!-- Requirements Cards -->
            <div class="row g-4">
                <!-- Emirates & UAE Residents Card -->
                <div class="col-md-4">
                    <div class="requirement-card">
                        <div class="id-icon">
                            <img src="{{ asset('assets/ico/image copy 4.png') }}" alt="ID Card Icon" />
                        </div>
                        <h2 class="requirement-card-title">
                            {{ __('home.emirates_or_uae_residents') }}
                        </h2>
                        <ul class="requirement-list">
                            <li>
                                <span class="requirement-highlight">{{ __('home.emirates_id') }}</span>
                                {{ __('home.emirates_id_description') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.uae_driving_licence') }}</span>
                                {{ __('home.uae_driving_licence_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.debit_card_and_cash') }}</span>
                                {{ __('home.debit_card_and_cash_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.residential_visa') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Foreign Tourist Card -->
                <div class="col-md-4">
                    <div class="requirement-card">
                        <div class="id-icon">
                            <img src="{{ asset('assets/ico/image.png') }}" alt="ID Card Icon" />
                        </div>
                        <h2 class="requirement-card-title">{{ __('home.foreign_tourist') }}</h2>
                        <ul class="requirement-list">
                            <li>
                                <span class="requirement-highlight">{{ __('home.foreign_tourist_desc') }}</span>
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.passport') }}</span>
                                {{ __('home.passport_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.home_country_driving_license') }}</span>
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.IDP') }}</span>
                                {{ __('home.IDP_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.debit_card_and_cash') }}</span>
                                {{ __('home.debit_card_and_cash_desc') }}
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Foreign Tourist Card -->
                <div class="col-md-4">
                    <div class="requirement-card">
                        <div class="id-icon">
                            <img src="{{ asset('assets/ico/image copy 5.png') }}" alt="ID Card Icon" />
                        </div>
                        <h2 class="requirement-card-title">{{ __('home.foreign_tourist') }}</h2>
                        <ul class="requirement-list">
                            <li>
                                <span class="requirement-highlight">{{ __('home.foreign_tourist_desc') }}</span>
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.passport') }}</span> 
                                {{ __('home.passport_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.home_country_driving_license') }}</span>
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.IDP') }}</span> 
                                {{ __('home.IDP_desc') }}
                            </li>
                            <li>
                                <span class="requirement-highlight">{{ __('home.debit_card_and_cash') }}</span>
                                {{ __('home.debit_card_and_cash_desc') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>