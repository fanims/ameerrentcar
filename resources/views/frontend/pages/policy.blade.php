@extends('frontend.layout.layout')

@section('meta_title')
    Ameer RAC | Privacy Policy
@endsection


@section('content')
<!-- CONTENT AREA -->
<section class="page-section rc-policy">
    <div class="container">
        <div class="col-12">
            <div class="content-area">
                <h1>{{ __('policy.privacy_policy') }}</h1>
                <p>{{ __('policy.latest_update') }}</p>
                <p>{{ __('policy.description') }}</p>
                <p>{{ __('policy.we_user_personal_data') }} <a href="https://www.termsfeed.com/privacy-policy-generator/" target="_blank">{{ __('policy.policy_generator') }}</a>.</p>
                <h2>{{ __('policy.interpretation_and_definitions') }}</h2>
                <p>{{ __('policy.interpretation') }}</p>
                <p>{{ __('policy.interpretations_define') }}</p>
                <p>{{ __('policy.defination') }}</p>
                <p>{{ __('policy.for_purposed') }}</p>
                <ul>
                    <li>
                        <p><strong>{{ __('policy.account') }}</strong> {{ __('policy.account_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.affiliate') }}</strong> {{ __('policy.affiliate_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.company') }}</strong> {{ __('policy.company_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.cookies') }}</strong> {{ __('policy.cookies_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.country') }}</strong> {{ __('policy.country_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.device') }}</strong> {{ __('policy.device_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.personal_data') }}</strong> {{ __('policy.personal_data_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.service') }}</strong> {{ __('policy.service_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.service_provider') }}</strong> {{ __('policy.service_provider_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.data_usage') }}</strong> {{ __('policy.data_usage_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.website') }}</strong> {{ __('policy.website_defination') }} <a href="ameerluxury.com" rel="external nofollow noopener" target="_blank">ameerluxury.com</a></p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.you') }}</strong>{{ __('policy.you_defination') }}</p>
                    </li>
                </ul>
                <h2>{{ __('policy.collecting_personal_data') }}</h2>
                <p>{{ __('policy.type_of_data') }}</p>
                <p>{{ __('policy.personal_data') }}</p>
                <p>{{ __('policy.while_our_service') }}</p>
                <ul>
                    <li>
                        <p>{{ __('policy.email_address') }}</p>
                    </li>
                    <li>
                        <p>{{ __('policy.first_last_name') }}</p>
                    </li>
                    <li>
                        <p>{{ __('policy.phone') }}</p>
                    </li>
                    <li>
                        <p>{{ __('policy.address') }}</p>
                    </li>
                    <li>
                        <p>{{ __('policy.usage_data') }}</p>
                    </li>
                </ul>
                <p>{{ __('policy.usage_data') }}</p>
                <p>{{ __('policy.usage_data_defination') }}</p>
                <p>{{ __('policy.usage_data_may_include_information') }}</p>
                <p>{{ __('policy.when_you_access_service') }}</p>
                <p>{{ __('policy.we_may_collection_information') }}</p>
                <p>{{ __('policy.tracking_technologies') }}</p>
                <p>{{ __('policy.we_use_cookies') }}</p>
                <ul>
                    <li><strong>{{ __('policy.cookies_or_browser') }}</strong>{{ __('policy.cookies_or_browser_defination') }}</li>
                    <li><strong>{{ __('policy.web_beacons') }}</strong> {{ __('policy.web_beacons_defination') }}</li>
                </ul>
                <p>{{ __('policy.cookies_can_be_persistent') }} <a href="https://www.termsfeed.com/blog/cookies/#What_Are_Cookies" target="_blank">TermsFeed website</a> article.</p>
                <p>{{ __('policy.we_use_both_session') }}</p>
                <h2>{{ __('policy.necessary_and_assential') }}</h2>
                <ul>
                    <li>
                        <p>{{ __('policy.type_session_cookies') }}</p>
                        <p>{{ __('policy.administered_by_us') }}</p>
                        <p>{{ __('policy.purpose_session_cookies') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.cookie_policy') }}</strong></p>
                        <p>{{ __('policy.type_psersistent_cookie') }}</p>
                        <p>{{ __('policy.administered_by_us') }}</p>
                        <p>{{ __('policy.purose_cookie_policy') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.functionality_cookies') }}</strong></p>
                        <p>{{ __('policy.type_persistent_cookies') }}</p>
                        <p>{{ __('policy.administered_by_us') }}</p>
                        <p>{{ __('policy.purpose_of_functionality_cookies') }}</p>
                    </li>
                </ul>
                <p>{{ __('policy.for_more_information') }}</p>
                <p>{{ __('policy.use_of_your_personal_data') }}</p>
                <p>{{ __('policy.the_company_may_use') }}</p>
                <ul>
                    <li>
                        <p><strong>{{ __('policy.provide_and_maintain_service') }}</strong></p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.to_manage_account') }}</strong> {{ __('policy.manage_account_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.for_performance') }}</strong> {{ __('policy.for_performance_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.to_contact_you') }}</strong> {{ __('policy.to_contact_you_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.to_provide_you') }}</strong> {{ __('policy.to_provide_you_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.to_manage_your_request') }}</strong> {{ __('policy.to_manage_your_request_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.for_business_transfers') }}</strong> {{ __('policy.for_business_transfers_defination') }}</p>
                    </li>
                    <li>
                        <p><strong>{{ __('policy.for_other_purposes') }}</strong>: {{ __('policy.for_other_purposes_defination') }}</p>
                    </li>
                </ul>
                <p>{{ __('policy.we_may_share_personal_information') }}</p>
                <ul>
                    <li><strong>{{ __('policy.with_our_service_provider') }}</strong> {{ __('policy.service_provider_defination') }}</li>
                    <li><strong>{{ __('policy.for_personal_details_business_transfer') }}</strong> {{ __('policy.for_personal_details_business_transfer_defination') }}</li>
                    <li><strong>{{ __('policy.for_personal_details_with_affiliates') }}</strong> {{ __('policy.for_personal_details_with_affiliates_defination') }}</li>
                    <li><strong>{{ __('policy.for_personal_details_with_business_partners') }}</strong> {{ __('policy.for_personal_details_with_business_partners_defination') }}</li>
                    <li><strong>{{ __('policy.for_personal_details_with_other_users') }}</strong> {{ __('policy.for_personal_details_with_other_users_defination') }}</li>
                    <li><strong>{{ __('policy.for_personal_details_with_your_consent') }}</strong>: {{ __('policy.for_personal_details_with_your_consent_defination') }}</li>
                </ul>
                <h2>{{ __('policy.retention_of_your_personal_data') }}</h2>
                <p>{{ __('policy.company_with_retain_your_personal_data') }}</p>
                <p>{{ __('policy.company_will_retain_internal_analysis') }}</p>
                <h2>{{ __('policy.transfer_your_personal_data') }}</h2>
                <p>{{ __('policy.your_information_includes') }}</p>
                <p>{{ __('policy.your_consent') }}</p>
                <p>{{ __('policy.company_will_take_all_steps') }}</p>
                <h2>{{ __('policy.delete_your_personal_data') }}</h2>
                <p>{{ __('policy.you_have_rights') }}</p>
                <p>{{ __('policy.our_services_give_you') }}</p>
                <p>{{ __('policy.you_may_update') }}</p>
                <p>{{ __('policy.please_note') }}</p>
                <h2>{{ __('policy.disclosure_personal_data') }}</h2>
                <p>{{ __('policy.business_transactions') }}</p>
                <p>{{ __('policy.if_the_company_involved') }}</p>
                <p>{{ __('policy.law_enforcement') }}</p>
                <p>{{ __('policy.under_cetain_cirsumstances') }}</p>
                <h2>{{ __('policy.other_legal_requirements') }}</h2>
                <p>{{ __('policy.other_legal_personal_data') }}</p>
                <ul>
                    <li>{{ __('policy.comply_with_legal_obligation') }}</li>
                    <li>{{ __('policy.protect_and_defend') }}</li>
                    <li>{{ __('policy.prevent_fraud') }}</li>
                    <li>{{ __('policy.protect_rights') }}</li>
                    <li>{{ __('policy.protect_against') }}</li>
                </ul>
                <h2>{{ __('policy.security_of_personal_data') }}</h2>
                <p>{{ __('policy.security_of_personal_data_define') }}</p>
                <h2>{{ __('policy.children_privacy') }}</h2>
                <p>{{ __('policy.our_service_does_not_address') }}</p>
                <p>{{ __('policy.if_we_need_to_rely') }}</p>
                <h2>{{ __('policy.link_to_other_websites') }}</h2>
                <p>{{ __('policy.link_other_website_service') }}</p>
                <p>{{ __('policy.we_have_no_control') }}</p>
                <h2>{{ __('policy.changes_to_privacy_policy') }}</h2>
                <p>{{ __('policy.we_may_update') }}</p>
                <p>{{ __('policy.we_may_let_you_know') }}</p>
                <p>{{ __('policy.you_are_adviced') }}</p>
                <h2>{{ __('policy.contact_us') }}</h2>
                <p>{{ __('policy.any_question') }}</p>
                <ul>
                    <li>{{ __('policy.by_visiting_website') }} <a href="ameerluxury.com" rel="external nofollow noopener" target="_blank">ameerluxury.com</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /CONTENT AREA -->
@endsection