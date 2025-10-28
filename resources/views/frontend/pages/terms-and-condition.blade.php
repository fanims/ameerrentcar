@extends('frontend.layout.layout')

@section('meta_title')
Ameer RAC | Privacy Policy
@endsection


@section('content')
<!-- CONTENT AREA -->
<div class="content-area">
    <section class="page-section dark">
        <div class="container">
            <main>
                <h1 style="color: #ce933c; font-weight: bold;">{{ __('terms.title') }}</h1>

                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.delivery_return.title') }}</h2>
                    <p>{{ __('terms.sections.delivery_return.points.rental_period') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.extension_policy') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.contract_validity') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.vehicle_condition') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.return_requirements') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.contract_violation') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.after_hours_return') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.offsite_return') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.no_liability') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.vehicle_replacement') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.early_termination') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.daily_rate_applied') }}</p>
                    <p>{{ __('terms.sections.delivery_return.points.late_return_liability') }}</p>
                    <ul>
                        <li>{{ __('terms.sections.delivery_return.points.late_return_liability_li1') }}</li>
                        <li>{{ __('terms.sections.delivery_return.points.late_return_liability_li2') }}</li>
                    </ul>
                </section>

                <section>
                    <h2 style="color: #ce933c">{{ __('terms.sections.personal_data.title') }}</h2>
                    <p> {{ __('terms.sections.personal_data.content') }}</p>
                </section>

                <section>
                    <h2 style="color: #ce933c">{{ __('terms.sections.pricing_adjustments.title') }}</h2>
                    <p> {{ __('terms.sections.pricing_adjustments.content') }}</p>
                </section>

                <section>
                    <h2 style="color: #ce933c">{{ __('terms.sections.terms_of_use.title') }}</h2>
                    <p> {{ __('terms.sections.terms_of_use.prohibited_uses.fee_transport') }}</p>
                    <ul style="list-style-type: disc">
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.over_capacity') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.damaging_materials') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.towing') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.racing_illegal_use') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.offroad_driving') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.under_influence') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.subletting') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.outside_uae') }}</li>
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.prohibited_areas') }}
                        <li>{{ __('terms.sections.terms_of_use.prohibited_uses.prohibited_geographies') }}
                            <ul style="list-style-type: disc">
                                <li>{{ __('terms.sections.terms_of_use.prohibited_uses.prohibited_geographies_li1') }}</li>
                                <li>{{ __('terms.sections.terms_of_use.prohibited_uses.prohibited_geographies_li2') }}</li>
                                <li>{{ __('terms.sections.terms_of_use.prohibited_uses.prohibited_geographies_li3') }}</li>
                            </ul>
                        </li>
                    </ul>
                </section>

          
                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.insurance_policy.title') }}</h2>
                    <p>{{ __('terms.sections.insurance_policy.points.standard_coverage') }}</p>
                    <p>{{ __('terms.sections.insurance_policy.points.collision_waiver') }}</p>
                    <p>{{ __('terms.sections.insurance_policy.points.super_collision_waiver') }}</p>
                    <p>{{ __('terms.sections.insurance_policy.points.young_driver_penalty') }}</p>

                </section>

                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.damage_theft.title') }}</h2>
                    <p>{{ __('terms.sections.damage_theft.points.cost_liability') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.special_conditions') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.accident_reporting') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.insurance_violation') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.insurance_rejection') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.assistance_duty') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.unknown_fault') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.excluded_damage') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.unauthorized_repair') }}</p>
                    <p>{{ __('terms.sections.damage_theft.points.policy_cancellation') }}</p>

                </section>

                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.law_jurisdiction.title') }}</h2>
                    <p>{{ __('terms.sections.law_jurisdiction.content') }}</p>
                </section>



                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.fees.title') }}</h2>
                    <p>{{ __('terms.sections.fees.points.policy_changes') }}</p>
                    <p>{{ __('terms.sections.fees.points.excess_mileage') }}</p>
                    <p>{{ __('terms.sections.fees.points.traffic_fines') }}</p>
                    <p>{{ __('terms.sections.fees.points.salik_fee') }}</p>
                    <p>{{ __('terms.sections.fees.points.violation_fees') }}</p>
                    <p>{{ __('terms.sections.fees.points.admin_fees') }}</p>
                    <p>{{ __('terms.sections.fees.points.cleaning_fee') }}</p>
                    <p>{{ __('terms.sections.fees.points.roadside_fee') }}</p>
                    <p>{{ __('terms.sections.fees.points.payment_terms') }}</p>
                    <p>{{ __('terms.sections.fees.points.auto_deductions') }}</p>
                    <p>{{ __('terms.sections.fees.points.fuel_policy') }}</p>
                    <p>{{ __('terms.sections.fees.points.vat_applied') }}</p> 
                </section>


                <section>
                    <h2 style="color: #ce933c;"> {{ __('terms.sections.payment_refund.title') }}</h2>
                    <p> {{ __('terms.sections.payment_refund.content') }}</p>
                    {{-- <br><br>
                    <p>We accept payments by Visa/MasterCard cards etc.</p>
                    <p>Online, WhatsApp, Instagram, Facebook, and phone booking are available credit card details and
                        personal identifiable information of the customer will not be shared or sold or rented to any
                        third party.</p> --}}
                </section>



                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.refunds.title') }}</h2>
                    <ul style="list-style-type: disc">
                        <li>
                            <p>{{ __('terms.sections.refunds.points.standard_refund') }}</p>
                        </li>
                        <li>
                            <p> {{ __('terms.sections.refunds.points.no_early_return_refund') }}</p>
                    </ul>

                </section>


                <section>
                    <h2 style="color: #ce933c;">{{ __('terms.sections.indemnification.title') }}</h2>
                    <p>{{ __('terms.sections.indemnification.points.no_company_liability') }}</p>
                    <p>{{ __('terms.sections.indemnification.points.customer_liability') }}</p>
                    <p>{{ __('terms.sections.indemnification.points.impounded_vehicle') }}</p>
                    <p>{{ __('terms.sections.indemnification.points.speed_fines') }}</p>

                </section>
            </main>
        </div>
    </section>
</div>
<!-- /CONTENT AREA -->
@endsection