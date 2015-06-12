$(document).ready(function(){
    $('body').on('click','.js_modal',function(e){
        e.preventDefault();
        if($('#modal').size()){
            $('#modal').remove();
        }
        var href = $(this).attr('href');
        $(document).trigger('progress_start');
        $.ajax({
            url:href,
            success:function(response){
                $('body').append(response);
                $('#modal').modal('show');
                $('#modal').on('hidden.bs.modal', function (e) {
                    $('#modal').remove();
                });
            },
            complete:function(){
                $(document).trigger('progress_stop');
            }
        });
    });
    
    $('body').on('click','.js_submit',function(e){
        e.preventDefault();
        var form = $($(this).attr('data-target'));
        if(form.size()){
            form.submit();
        }
    });
    
    $('body').on('submit','.js_generate_form',function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $(document).trigger('progress_start');
        $.ajax({
            type:'post',
            url:url,
            data:form.serialize(),
            success:function(response){
                $('.js_search').val('');
                $('.js_replace_list').replaceWith(response);
                $('#modal').modal('hide');
            },
            complete:function(){
                $(document).trigger('progress_stop');
            }
        });
    });
    
    $('body').on('click','.js_request, .js_pagination a',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        if($(this).closest('.js_pagination').size()){
            window.history.replaceState({},$('title').html(),url);
        }
        $(document).trigger('progress_start');
        $.ajax({
            type:'post',
            url:url,
            data:$('.js_search').serialize(),
            success:function(response){
                $('.js_replace_list').replaceWith(response);
            },
            complete:function(){
                $(document).trigger('progress_stop');
            }
        });
    });
    
    var globalTimer = null;
    $('body').on('change keyup blur','.js_search',function(e){
        e.preventDefault();
        window.clearTimeout(globalTimer);
        globalTimer = window.setTimeout(function(){ // prevent ajax flood
            $(document).trigger('progress_start');
            $.ajax({
                type:'post',
                url:window.location.href,
                data:$('.js_search').serialize(),
                success:function(response){
                    $('.js_replace_list').replaceWith(response);
                },
                complete:function(){
                    $(document).trigger('progress_stop');
                }
            });
        },300);
    });
    
});

$(document).on('ready ajaxreload',function(){
    $('.js_datepicker').datepicker({format:'yyyy-mm-dd'});
    $('.js_reset').on('click',function(e){
        e.preventDefault();
        $(this).parent().prev().val('').change();
    });
});

$(document).on('progress_start',function(){
    var loading = $('#loading');
    if(!loading.size()){
        $('<div id="loading"><span class="glyphicon glyphicon-refresh"></span></div>').appendTo('body');
    }
});
$(document).on('progress_stop',function(){
    var loading = $('#loading');
    if(loading.size()){
        loading.remove();
    }
});



