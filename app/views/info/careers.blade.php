@extends('layout.default')

@section('head')
@parent
<title>Careers | Mycollegeadda</title>
@stop
      
@section('content')
<section class="uk-container uk-container-center uk-text-justify uk-margin-large-top">
<h2>Careers</h2>
<hr>
<h3>Current Openings:</h3>
<div class="uk-grid">
    <div class="uk-width-medium-1-2"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
    	<h3 class="uk-panel-title">College Management Intern (CMI)</h3>
    	<a href="#cmi" data-uk-modal><img src="images/cmi.jpg"></a>
    </div></div>
    <div class="uk-width-medium-1-2"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
    	<h3 class="uk-panel-title">College Tech Intern (CTI)</h3>
    	<a href="#cti" data-uk-modal><img src="images/cti.jpg"></a>
    </div></div>
</div>
<p>*To apply for the above jobs forward your resume to careers@mycollegeadda.com</p>
</section>

<div id="cmi" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
    <div class="uk-modal-dialog uk-text-justify">
        <a href="" class="uk-modal-close uk-close"></a>
        <h1>College Management Intern (CMI)</h1>
        <h3 class="uk-text-danger">Skills &amp; Qualifications</h3>
        <ul>
        <li>“First Attitude and then Aptitude, will determine your Altitude” and to develop the right attitude, one should be good at public facing, presenting and connecting skills. And no one is better teacher than experience itself.</li>
		<li>The candidate must know the tricks and traits of public communication, social media marketing and connecting with peers. And no opportunity can be better than learning just before you are ready to move into corporate world.</li>
		</ul>
        <h3 class="uk-text-danger">Job Description</h3>
        <p>The selected intern(s) will work on following during the internship: </p>
        <ol>
        	<li>Manage the social media marketing for Mycollegeadda.com</li>
        	<li>Develop and Execute content marketing for Mycollegeadda.com by managing the company’s social page and participation in related forums.</li>
        	<li>Branding and Marketing of Mycollegeadda.com in Regional Universities and colleges.</li>
        	<li>Identifying ‘Mycollegeadda College Brand Ambassdor’ for each college in the region.</li>
        </ol>
        <p>*To apply for the above job forward your resume to <b>careers@mycollegeadda.com</b></p>
    </div>
</div>

<div id="cti" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
    <div class="uk-modal-dialog uk-text-justify">
        <a href="" class="uk-modal-close uk-close"></a>
        <h1>College Tech Intern (CTI)</h1>
        <h3 class="uk-text-danger">Tech Gurus wanted at Mycollegeadda.com</h3>
        <p>Mycollegeadda, India’s first online college marketplace for college students, is looking to take on board a front-end ninja as an intern. No matter who you are a college student, fresher or dropout, you should be tech-maniac, just need to be crazy about below technologies:</p>
        <ol>
        	<li>HTML5 &amp; CSS3</li>
        	<li>Javascript &amp; Jquery</li>
        	<li>Php5</li>
        	<li>Laravel</li>
        	<li>MySql</li>
        	<li>Android/ios</li>
        	<li>Angular Js</li>
        	<li>Adobe Photoshop/Illustrator</li>
        	<li>Search Engine Optimization (seo)</li>
        </ol>
        <p>If you know any of the above technologies you are at right place.</p>
        <p>*To apply for the above job forward your resume to <b>careers@mycollegeadda.com</b></p>
    </div>
</div>
@stop