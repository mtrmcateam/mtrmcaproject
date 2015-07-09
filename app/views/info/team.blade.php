@extends('layout.default')

@section('head')
@parent
<title>Our Team | Mycollegeadda</title>
@stop      
@section('content')
<div class="uk-cover-background" style="height: 300px;margin-top:-5%; background-image: url(images/ourteam.jpg);"></div>
<section class="uk-container uk-container-center uk-text-justify uk-margin-large-top">
<h1>Our Team</h1>
<hr>
<h2>Co Founders</h2>
<div class="uk-grid">
    <div class="uk-width-medium-1-3">
    <a href="https://www.linkedin.com/profile/view?id=328391536" target="_blank">
      <div class="uk-thumbnail">
        <figure class="uk-overlay uk-overlay-hover">
            <img class="uk-overlay-scale" src="images/team/nancy.jpg" width="275" height="500" alt="Image">
            <figcaption class="uk-overlay-panel uk-overlay-background  uk-overlay-bottom uk-overlay-slide-bottom">
                <p>Co Founder of mycollegeadda.com</p>
            </figcaption>
        </figure>
      <div class="uk-thumbnail-caption">Nancy Agrawal</div>
      </div></a>
    </div>
    <div class="uk-width-medium-1-3">
    <a href="https://www.linkedin.com/profile/view?id=77004332" target="_blank">
      <div class="uk-thumbnail">
        <figure class="uk-overlay uk-overlay-hover">
            <img class="uk-overlay-scale" src="images/team/prachi.jpg" width="275" height="500" alt="Image">
            <figcaption class="uk-overlay-panel uk-overlay-background  uk-overlay-bottom uk-overlay-slide-bottom">
                <p>Co Founder of mycollegeadda.com</p>
            </figcaption>
        </figure>
      <div class="uk-thumbnail-caption">Prachi Agrawal</div>
      </div></a>
    </div>
</div>
<h2>Advisory Board</h2>
<dl class="uk-description-list-line">
    <dt>Saurabh Jain</dt>
    <dd>IIM-B graduate with over 10 years of experience.</dd>
    <dt>Priyanka Agrawal</dt>
    <dd>HR Management Professional from MDI-Gurgaon</dd>
    <dt>Yatinder Agrawal</dt>
    <dd>Management Graduate with extensive experience in Social Media Marketing</dd>
    <dt>Naman Agrawal</dt>
    <dd>Supply Chain Management graduate from NITIE-Mumbai</dd>
</dl>
</section>
@stop