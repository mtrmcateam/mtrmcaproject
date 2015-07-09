@if(!(Auth::check()))
{{ HTML::script('js/components/accordion.min.js') }}
<aside class="uk-accordion uk-margin-large-top" data-uk-accordion="">

    <h3 class="uk-accordion-title">Why Register?</h3>
    <div data-wrapper="true" style="height: 0px; position: relative; overflow: hidden;" aria-expanded="false"><div class="uk-accordion-content">
        <p>Register to view seller details or post your ad on mycollegeadda for free.</p>
    </div></div>

    <h3 class="uk-accordion-title">Buy Here</h3>
    <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
        <p>Here you can buy used books, notes, electronic items posted by your college-mates and find flatmates or carpool.</p>
    </div></div>

    <h3 class="uk-accordion-title">Sell Here</h3>
    <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
        <p>Here you can sell used books, notes, electronic items posted by your college-mates and find flatmates or carpool.</p>
    </div></div>

</aside>
@endif