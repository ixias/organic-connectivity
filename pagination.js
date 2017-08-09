jQuery(function($){

    if($('.pagination').length){
        $('.pagination li a').click(function(){
            $(this).blur();
            $('.pagination li').removeClass('active');
            $(this).parent().addClass('active');
            //$('section ul:first-child').load( $(this).attr('href')+' section ul:first-child');
            $('.itemlist .items').html('<div class="loading">Loading</div>');
            $('.itemlist .items').load('?page='+$(this).val()+' section.itemlist .items',function(){
                $('.itemlist .items').imagesLoaded(function(){
                    $('.itemlist .items').masonry('reloadItems');
                    $('.itemlist .items').masonry();
                });
            });
            return false;
        });
    }

    if($('#items-toolbar').length){
        $('#page-choice').change(function(){
            $(this).blur();
            $('.itemlist .items').html('<div class="loading">Loading</div>');
            $('.itemlist .items').load('?page='+$(this).val()+' section.itemlist .items',function(){
                $('.itemlist .items').imagesLoaded(function(){
                    $('.itemlist .items').masonry('reloadItems');
                    $('.itemlist .items').masonry();
                });
            });
        });
        $('#sorting-choice').change(function(){
            $(this).blur();
            //$('h2').html($(this).val());
            $('.itemlist .items').html('<div class="loading">Loading</div>');
            window.history.replaceState({foo:'bar'},'Items','items?sort='+$(this).val());
            $('.itemlist .items').load('?sort='+$(this).val()+' section.itemlist .items',function(){
                $('.itemlist .items').imagesLoaded(function(){
                    $('.itemlist .items').masonry('reloadItems');
                    $('.itemlist .items').masonry();
                });
            });
        });
        $('#display-choice').change(function(){
            $(this).blur();
            //$('h2').html($(this).val());
            $('.itemlist .items').html('<div class="loading">Loading</div>');
            window.history.replaceState({foo:'bar'},'Items','items?viewer='+$(this).val());
            viewer=$(this).val();
            $.get('?viewer='+viewer,function(data){
                var newContent=$(data).find('section.itemlist .items');
                $('section.itemlist .items').replaceWith(newContent);
                if(viewer=='blocks'){
                    $('.itemlist .items').imagesLoaded(function(){
                        //$('.itemlist .items').masonry('reloadItems');
                        $('.itemlist .items').masonry();
                    });
                }
                if(viewer=='cinema'){
                    initializeSlideshow();
                }
            });
        });
    }

});