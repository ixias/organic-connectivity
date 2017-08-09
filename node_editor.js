$(document).ready(function(){



    $('#add-attribute').click(function(){
        $.ajax({
            url:this.href,
            dataType:'html',
            success:function(res){
                attribute_id='attribute_'+$('#attributes-list fieldset').length;
                res=$.parseHTML(res);
                $(res).find('.connection_attribute').attr('id',attribute_id);
                $(res).find('.connection_attribute').attr('name',attribute_id);
                fieldset=$(res).find('fieldset').parent();
                $('#attributes-list').append(fieldset.html());
                init_editor_attribute_selectors();
            }
        });
        return false;
    });



    function init_editor_attribute_selectors(){
        $("select.connection_attribute").on('change',function(){
            $(this).parent().find('.stuff-typed-as-attribute').html('<span id="loading">Loading</span>');
            url="/?attributes-by-type="+$(this).val();
            $(this).parent().find('.stuff-typed-as-attribute').load(url,function(){
                attribute_id=$(this).parent().find('select').attr('id').replace(/^\D+/g,'');
                $(this).find('select').attr('id','attribute_response_'+attribute_id);
                $(this).find('select').attr('name','attribute_response_'+attribute_id);
                $(this).find('input').attr('id','attribute_response_weight_'+attribute_id);
                $(this).find('input').attr('name','attribute_response_weight_'+attribute_id);
            });

        });
    }



});