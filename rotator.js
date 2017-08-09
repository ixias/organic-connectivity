//jQuery(function($){
//$(document).ready(function(){


    /*if($("#creations_rotator").length){

        setInterval(function(){

            //Check if mouse is over the rotator
            if(!$('#creations_rotator').is(":hover")){

                elem = $("#creations_rotator li.selected");
                elemIndex = $('#creations_rotator li').index(elem);
                elem = $('#creations_rotator li').get(elemIndex+1);
                //if at end of list go back to beginning:
                if( !elem ) elem = $('#creations_rotator li').get(0);
                $("#creations_rotator li").removeClass("selected");
                $(elem).addClass("selected");
                $("#creations_rotator .rotator_full").hide();
                $(elem).find(".rotator_full").show();

            }

        }, 6000);

        $("#creations_rotator li .rotator_tab a").mouseover(function(){
            $("#creations_rotator li").removeClass("selected");
            $(this).parent().parent().addClass("selected");
            $("#creations_rotator .rotator_full").hide();
            $(this).parent().parent().find(".rotator_full").show();
            return false;
        });

    }*/



    function processSlideshow( nextElem ){

        //discover current place
        currentElem=$("#creations_rotator li.selected");

        //fade out current
        $(currentElem).removeClass("selected");

        //setTimeout(function(){
        //$(currentElem).find(".rotator_full").css('display','none');
        //},100);

        //$(currentElem).find(".rotator_full").css('opacity','0');
        //$(currentElem).find(".rotator_full").css("left","-800px");

        //already prepare for it to slide in again
        /*setTimeout(function(){
            $(currentElem).find(".rotator_full").css("z-index","-2");
            $(currentElem).find(".rotator_full").css("left","800px");
        }, 700);*/

        //discover next place
        if( !nextElem ){

            currentElemIndex=$("#creations_rotator li").index(currentElem);

            if(currentElemIndex+1>=$('#creations_rotator li').length)
                nextElem=$("#creations_rotator li").get(0);
            else
                nextElem=$('#creations_rotator li').get(currentElemIndex+1);

        }

        //fade in next
        //$(nextElem).find(".rotator_full").css('display','block');
        $(nextElem).addClass("selected");
        stretchbackground=$(nextElem).find('.rotator_full a:first-child .images img').attr('src');
        $(nextElem).find('.rotator_full').css('background','transparent url('+stretchbackground+') scroll no-repeat center center');
        $(nextElem).find('.rotator_full').css('background-size','cover');
        $(nextElem).find('.rotator_full').css('-webkit-background-size','cover');
        $(nextElem).find('.rotator_full').css('-moz-background-size','cover');
        $(nextElem).find('.rotator_full').css('-o-background-size','cover');

        $(nextElem).find('.rotator_full a:first-child img').css('opacity','.9');

        //$(nextElem).find(".rotator_full").css('opacity','1');
        /*$(nextElem).find(".rotator_full").css("z-index","-1");
        $(nextElem).find(".rotator_full").css("left","0");*/

    }



    function initializeSlideshow(){

        //Check for rotator element
        if($("#creations_rotator").length){

            //Kickstart:
            processSlideshow($('#creations_rotator li').get(0));
            myTimer=setInterval(function(){
                //Check if mouse is over the rotator
                if(!$('#creations_rotator').is(":hover")){
                    processSlideshow();
                }
            },6000);
            //

            //Attach event to user leaving the slideshow zone
            $('#creations_rotator').mouseout(function(){
                //$(this).stop();
                clearInterval(myTimer);
                myTimer=setInterval(function(){
                    //Check if mouse is over the rotator
                    if(!$('#creations_rotator').is(":hover")){
                        processSlideshow();
                    }
                },6000);
            });
            //

            //Attach event to tab
            $('#creations_rotator li .rotator_tab a').mouseover(function(){
                //$('#creations_rotator').stop();
                clearInterval(myTimer);
                processSlideshow($(this).parent().parent());
            });
            //

        }
        //

    }//end initializeSlideshow()

    //initializeSlideshow();


	/*$('.page-rotator .projects li a').mouseover(
		function(){
			$(this).blur();
			$(".page-rotator .projects li a").removeClass( "active" );
			$(this).addClass( "active" );
			$("#project_details_slider").stop();
			new_project_slider_location = this.title.substring(5,7) * 473;
			$("#project_details_slider").animate(
				{ left: "-"+new_project_slider_location+"px" },
				200
			);
			return false;
		}
	);*/

//});