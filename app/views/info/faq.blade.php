@extends('layout.default')

@section('head')
@parent
<title>FAQ | Mycollegeadda</title>
{{ HTML::script('js/components/accordion.min.js') }}
@stop
      
@section('content')
<section class="uk-container uk-container-center uk-text-justify uk-margin-large-top">
    <h2>FAQs</h2>
    <hr>
    <article>
        <div class="uk-accordion" data-uk-accordion="">

            <h3 class="uk-accordion-title uk-active">How does mycollegeadda work?</h3>
            <div data-wrapper="true" style="height: auto; position: relative;" aria-expanded="true"><div class="uk-accordion-content">
                <p>Sellers list their used items (Books/Notes and Electronics)  or place available in carpool/flat mentioning all details on mycollegeadda website. Post remains active of 60 days.</p>
                <p>Buyers search required items.</p>
                <p>Buyers then contact sellers to arrange to transact. There are two ways to transact:</p>
                <ul>
                <li>meet at your college campus or</li>
                <li>meet in your city at pre-decided place</li>
                </ul>
                <p>The site doesn't handle books or money and takes no commission.</p>
            </div></div>

            <h3 class="uk-accordion-title">Is there any fees I need to pay mycollegeadda for using its services?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>No. All services on mycollegeadda.com are free.</p>
            </div></div>

            <h3 class="uk-accordion-title">Sellers: At what selling price I should list the items?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>Sellers to list items at fair price. We recommend listing such a price which is win-win situation for both seller and buyer.</p>
            </div></div>

            <h3 class="uk-accordion-title">Buyers: How much will I save on purchasing used items from mycollegeadda?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>A college student uses every item in a responsible way. So any item listed by your college peers is worth looking through and one can easily save near about 50% of the MRP.</p>
            </div></div>

            <h3 class="uk-accordion-title">Smart search tips...</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>
                    <ul>
                        <li>
                            Select by category specific requirement within your college.<br>
                            For eg. Search by the book's ISBN number as it is unique for every book edition. If book ISBN number is not known, search by book name or author.
                        </li>
                        <li>Create Alerts if you are not able to find your item. We will send you the mail as soon as someone post it for sale on mycollegeadda.com</li>
                    </ul>
                </p>
            </div></div>

            <h3 class="uk-accordion-title">Is it safe to meet people in person?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>You can best answer that. You are the judge. If you're not entirely comfortable, don't.</p>
                <p>It is probably best to meet during the day in a public place like college campus, a cafe or market and maybe take a friend along.</p>
            </div></div>

            <h3 class="uk-accordion-title">What happens when my used items are sold?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>Login to the site and delete your post. This way no one will further contact you wanting to buy it. As a marketplace, keeping the database up-to-date is good.</p>
            </div></div>

            <h3 class="uk-accordion-title">I've already registered but can't log in?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>
                    <ul>
                    <li>Click on "forgot password" and get your login and password emailed to you.<br>
                        If you don't receive the email within a few minutes, you may have mistyped your email address when first registering. In this case you will need to register again with the correct email.</li>
                    <li>Got the right login and email and still having problems: Empty the "cache" in your browser preferences. Try again</li>
                    <li>Even now if you are not able to login, mail us at support@mycollegeadda.com with details (Name, Contact number and College name) and we will sort that out for you.</li>
                    </ul>
                </p>
            </div></div>

            <h3 class="uk-accordion-title">I think the site is great - How can I help?</h3>
            <div data-wrapper="true" style="overflow: hidden; height: 0px; position: relative;" aria-expanded="false"><div class="uk-accordion-content">
                <p>If you think this is great idea which will make your life easier, here is how you can contribute back:<br>
Send an email to us on support@mycollegeadda.com and volunteer to put up some mycollegeadda posters at your campus - include your address. We will send you the posters. The site's success is built on the users who volunteer to help. You will be taken on Mycollegeadda’s Board as ‘Mycollegeadda College Brand Ambassdor’ representing your college. Mycollegeadda will reach out to you in case any information or feedback is required from your college.
</p>
            </div></div>

        </div>
    </article>
</section>
@stop