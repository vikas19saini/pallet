@extends('layouts.app')


@section('content')

<section class="myaccount_section trems_section">
    <div class="container">
        <div class="row">
            <div class="myaccount_main">
                <div class="myaccount_left">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li class="active"><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/shipping-and-returns">Shipping & Returns</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li><a href="/faqs">FAQ's</a></li>
                    </ul>
                    <div class="select_mobile_section">
                        <select class="mob_select" onchange="window.location.href = this.value">
                            <option value="{{ url('/about-us') }}">About Us</option>
                            <option value="{{ url('/terms-and-conditions') }}">Terms & Conditions</option>
                            <option value="{{ url('/privacy-policy') }}">Privacy Policy </option>
                            <option value="{{ url('/shipping-and-returns') }}">Shipping & Returns</option>
                            <option value="{{ url('/cookie-policy') }}">Cookie Policy</option>
                            <option value="{{ url('/faqs') }}">FAQ's</option>
                        </select>
                    </div>
                </div>
                <div class="myaccount_right tab-content">
                    <div class="overview policy_tab tab-pane fade in active" id="myaccount1">
                        <h2>Privacy Policy</h2>
                        <p>
                            Welcome to Pallet store. This document is an electronic record in terms of Information Technology Act, 2000 and published in accordance with the provisions of Rule 3 ) of the Information Technology (Intermediaries guidelines) Rules, 2011 that require publishing the rules and regulations, privacy policy and Terms of Use for access or usage of Pallet store.
                        </p>
                        <br />
                        <p>At Pallet store we view protection of your privacy as a very important principle. We understand clearly that You & Your Personal Information is one of our most important assets. We store and process Your Information including any sensitive financial information collected as defined under the Information Technology Act, 2000 and Rules there under. </p>
                        <br />  
                        <p>We may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy respond to claims that an advertisement, posting or other content violates the rights of a third party or protect the rights, property or personal safety of our users or the general public.</p>

                        <br />

                        <strong> Trademark, Copyright & restriction </strong>
                        <p>
                            You may not copy, reproduce, republish, upload, post, transmit or distribute such material in any way, including by email or other electronic means and whether directly or indirectly and You must not assist any other person to do so. Without the prior written consent of Pallet store team, modification of the materials, use of the of the materials for any purpose other than personal, non-commercial use is a violation of the copyrights, trademarks and other proprietary rights, and is prohibited. 
                        </p>


                        <strong> Limitation of liability </strong>
                        <p>In no event The Pallet store shall be liable for any indirect, punitive, incidental, special, consequential damages or any other damages resulting from:
                        </p>
                        <ul>
                            <li>the use or the inability to use the Services or Products</li>
                            <li>unauthorized access to or alteration of the user's transmissions or data</li>
                            <li>any other matter relating to the services including, without limitation, damages for loss of use, data or profits, arising out of or in any way connected with the use or performance of the Platform or Service. The Pallet store shall not be held responsible for non-availability of the Pallet store during periodic maintenance operations or any unplanned suspension of access to the Pallet store. The User understands and agrees that any material and/or data downloaded at Pallet store is done entirely at the Users own discretion and risk and they will be solely responsible for any damage to their mobile or loss of data that results from the download of such material and/or data. To the maximum extent that is permissible under law, Pallet store’s liability shall be limited to an amount equal to the Products purchased value bought by You. Pallet store shall not be liable for any dispute or disagreement between Users.</li>
                        </ul>



                        <strong>Termination
                        </strong>
                        <p>Pallet Store may suspend or terminate your use of the Pallet store or any Service if it believes, in its sole and absolute discretion that you have infringed, breached, violated, abused, or unethically manipulated or exploited any term of these Terms of Service or otherwise acted unethically. Notwithstanding anything in this clause, these Terms of Service will survive indefinitely unless and until Pallet store chooses to terminate them.</p>
                        <ul>
                            <li>If you terminate your use of the Platform or any Service, Pallet store may delete any content or other materials relating to your use of the Service and the Pallet store will have no liability to you or any third party for doing so. However, your transactions details may be preserved by Pallet store for purposes of tax or regulatory compliance.</li>
                            <li>Pallet store may unilaterally terminate Your account on any event as mentioned in the Terms Of Use. You use any false e-mail address or use the portal for any unlawful and fraudulent purposes, which may cause annoyance and inconvenience and abuses any policy and rules of the company or mislead the pallet store by sharing multiple address and phone numbers or transacting with malafide intentions then the pallet store reserves the right to refuse access to the portal, terminate accounts including any linked accounts without notice to you.</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection 
