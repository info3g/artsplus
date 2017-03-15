<?php

/* Template Name: Contact us */
get_header();
?>
<main id="content" class="main-content">
<div class="container">
<div id="wrapper" class="other1">
<div id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> page type-page status-publish hentry">
<div class="post-content">	<?php echo the_content(); ?>
</div>
</div>
</div>
</div>
	<div class="container">
<div class="head_text">
<h2>SUBMIT A REQUEST</h2>
	<p><strong>1300 Pennsylvania Avenue, N.W. STE 190-508, Washington, DC 20004</strong></p>
</div>
    <div>
	 <select class="contact_op">
            <option>Please Select</option>
            <option value="red">I am an Artist and have a question</option>
            <option value="green">I am an Collector and have a question</option>
          
        </select>
    </div>
    <div class="red box"><?php echo do_shortcode('[contact-form-7 id="1739" title="Contact us for artist"]');?></div>
    <div class="green box"><?php echo do_shortcode('[contact-form-7 id="1742" title="Contact us for collector"]');?></div>
	
	</div>
	</main>
	<style type="text/css">
    .box{		display: none;
        margin-top: 20px;
    }	.head_text h2 {    color: #000;    font-size: 25px;}	.head_text strong {    font-size: 13px;}	select {		width:80%;		border-color:#888;	}		select:hover {    border-color: #333;}.wpcf7-form label {    font-weight: bold;}.red {	border:none !important;}
  .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required {	  width:80%;  }    textarea {	  width:80%;  }    .wpcf7-form label {    line-height: 30px;}
  .contact-banner {width:100%;}
  .vc_row.wpb_row.vc_row-fluid.vc_row-has-fill.vc_general.vc_parallax.vc_parallax-content-moving{height: 350px;}
  
</style>
<!--script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    $(".contact_op").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="red"){
                $(".box").not(".red").hide();
                $(".red").show();
            }
            else if($(this).attr("value")=="green"){
                $(".box").not(".green").hide();
                $(".green").show();
            }
            else if($(this).attr("value")=="blue"){
                $(".box").not(".blue").hide();
                $(".blue").show();
            }
            else{
                $(".box").hide();
            }
        });
    }).change();
});
</scrip-->
<?php

get_footer();


?>