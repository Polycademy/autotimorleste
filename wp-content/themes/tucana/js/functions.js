  jQuery(document).ready(function($) {
  
  /* for top navigation */
	$(" #menu ul ").css({display: "none"}); // Opera Fix
	$(" #menu li").hover(function(){
	$(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400);
	},function(){
	   $(this).find('ul:first').css({visibility: "hidden"});
	});
  
  //for scroll box
    $('#scroll-box').cycle({
      timeout: 0,  // milliseconds between slide transitions (0 to disable auto advance)
      fx:     'scrollHorz', // choose your transition type, ex: fade, scrollUp, shuffle, etc...     
    	prev:   '#arrowprev', // selector for element to use as click trigger for next slide  
    	next:   '#arrownext', // selector for element to use as click trigger for previous slide 
    	cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
    	height:         150, // container height 
      pauseOnPagerHover: 0 // true to pause when hovering over pager link
    });
    
  $('#fade-box').cycle({
    timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
    fx:'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...                        
    pause:0,	  // true to enable "pause on hover"
		pager:'#fade-nav',
		cleartypeNoBg:   true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides) 
    pauseOnPagerHover: 0 // true to pause when hovering over pager link
  });
    
  /* initialize prettyphoto */
    $("a[rel^='prettyPhoto']").prettyPhoto({
  		theme: 'light_rounded',
      social_tools: false
    });
    
    
  $(".toggle_title").toggle(
	function(){
		$(this).addClass('toggle_active');
		$(this).siblings('.toggle_content').slideDown("fast");
	},
	function(){
		$(this).removeClass('toggle_active');
		$(this).siblings('.toggle_content').slideUp("fast");
	}
	);

	$(".tabs_container").each(function(){
		$("ul.tabs",this).tabs("div.panes > div", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
	});
	$(".mini_tabs_container").each(function(){
		$("ul.mini_tabs",this).tabs("div.panes > div", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
	});
	$.tools.tabs.addEffect("slide", function(i, done) {
		this.getPanes().slideUp();
		this.getPanes().eq(i).slideDown(function()  {
			done.call();
		});
	});
  
  /* Contact Form Processing */  
  $('#buttonsend').click( function() {
	
    var name    = $('#contactname').val();
		var subject = $('#contactsubject').val();
		var email   = $('#contactemail').val();
		var message = $('#contactmessage').val();
		var siteurl = $('#siteurl').val();
		var sendto =  $('#sendto').val();		
		
		$('.loading').fadeIn('fast');
		
		if (name != "" && subject != "" && email != "" && message != "")
			{

				$.ajax(
					{
						url: siteurl+'/sendemail.php',
						type: 'POST',
						data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message+ "&sendto=" + sendto,
						success: function(result) 
						{
							$('.loading').fadeOut('fast');
							if(result == "email_error") {
								$('#contactemail').css({"border":"1px solid #FF8C8C"}).next('.require').text(' !');
							} else {
								$('#contactname, #contactsubject, #contactemail, #contactmessage').val("");
								$('.success-contact').show().fadeOut(8000, function(){ $(this).remove(); });		
							}
						}
					}
				);
				return false;
				
			} 
		else 
			{
				$('.loading').fadeOut('fast');
				if( name == "") $('#contactname').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
				if(subject == "") $('#contactsubject').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
				if(email == "" ) $('#contactemail').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
				if(message == "") $('#contactmessage').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
				return false;
			}
	});
	
	$('#contactname, #contactsubject, #contactemail,#contactmessage').focus(function(){
		$(this).css({"background-color":"#f5f5f5","border":"1px solid #cfcfcf"});
	});
        
	});	
	
