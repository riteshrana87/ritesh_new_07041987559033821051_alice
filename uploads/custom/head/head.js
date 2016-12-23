$(document).ready(function(){
	
	     $(".box").hide();
	    var small={width: "80px",height: "80px"};
        var large={width: "126px",height: "117px"};
        var count=1; 
        $("#imgtab").css(small).on('click',function () { 
            $(this).animate((count==1)?large:small);
            count = 1-count;
            $(".box").animate({
                width: "toggle"
            },function() {
       // Animation complete.
           
  });
        });
	 
	   
        /*$(".slide-toggle").click(function(){
			 $(".slide-toggle").toggleClass("imagelarge");
            $(".box").animate({
                width: "toggle"
            },function() {
       // Animation complete.

      
       
              
  });
       
    });*/
});
