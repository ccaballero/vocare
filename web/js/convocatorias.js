var is_hidden=true

function showbox(selector){
    if(is_hidden){
        $(selector).show()
        is_hidden=false
    }else{
        $(selector).hide()
        is_hidden=true
    }}

function enumerate_checks(){
    var counter=1
    $('.draggable input[type="checkbox"]').each(function(){
        $(this).attr('value',counter++)
    })}

function add_row(selector){
    var last_row=$(selector+' tbody tr:last')
    var new_row=last_row.clone()
    new_row.show().insertAfter(last_row)
    $(selector+' tbody tr:last input').each(function(){
        $(this).attr('value','')
    })
    return false
}

function add_li(selector,clone_selector){
    $(selector).prev('ul.list')
               .append('<li>'+$(clone_selector).clone().html()+'</li>')
    return false
}

function remove_row(selector){
    if($(selector).parents('tbody').children('tr').length>1){
        $(selector).parents('tr:first').remove()
    }else{
        alert('no puede eliminarse la ultima fila, no te pases.')
    }
    return false
}

function remove_li(selector){
    $(selector).parents('li').remove()
    return false
}

$(document).ready(function(){
    jQuery.fn.exists = function(){return this.length>0;}

    $('input[type="text"].focus').focus()
    $('textarea.focus').focus()
    $('#signin_username').focus()

    $('.closeable').click(function(){
        $(this).parent().fadeOut()
        return false
    })
    $('input[class="groupall"]').click(function(){
        if($(this).is(':checked')){
            $('input[class="check"]').attr('checked',true)
        }else{
            $('input[class="check"]').attr('checked',false)
        }
    })

    $.datepicker.regional['es'] = {
        prevText: '<Previo',
        nextText: 'Siguiente>',
        monthNames: [
            'Enero', 'Febrero', 'Marzo', 'Abril',
            'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        monthNamesShort: [
            'Ene', 'Feb', 'Mar', 'Abr',
            'May', 'Jun', 'Jul', 'Ago',
            'Sep', 'Oct', 'Nov', 'Dic'
        ],
        weekHeader: 'Sm', weekStatus: '',
        dayNames: [
            'Domingo', 'Lunes', 'Martes', 'Miércoles',
            'Jueves', 'Viernes', 'Sabado'
        ],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        dateFormat: 'yy-mm-dd', firstDay: 1,
        changeMonth: true
    }

    $.datepicker.setDefaults($.datepicker.regional['es'])
    $('.datepicker').datepicker()

    // tabber section
//    $('.tab_contents').hide()
    $('#tabber ul#tabs li a').click(function(){
        var activeTab = $(this).attr('href')
        $('#tabber ul li a').removeClass('active')
        $(this).addClass('active')
        $('#tabber .tab_details .tab_contents').hide()
        $(activeTab).fadeIn()
    })
    if(window.location.hash!==''){
//        $('a[href="#'+window.location.hash+'"]').click()
        $(window.location.hash).fadeIn()
        $('#tabber .tab a[href="'+window.location.hash+'"]').addClass('active')
    }else{
        $('.tab_contents:first').fadeIn()
        $('#tabber .tab a[href="#preview"]').addClass('active')
    }
    // end tabber

    // this is the part when I copy redactions in convocatorias
    $('a.clipboard').click(function(){
        redaccion=$(this).attr('name')
        $('textarea[name=redaction]').html(redacciones[redaccion])
    })

    // this is the part for up and down signatures in notifications tab
    // http://stackoverflow.com/questions/1569889/jquery-move-table-row
    enumerate_checks()
    $('.up, .down').click(function(){
        var row=$(this).parents('tr:first');
        if($(this).is('.up')){
            row.insertBefore(row.prev())
        }else{
            row.insertAfter(row.next())
        }
        enumerate_checks()
    })

    // flash messenger close
    $('#messages .close a').click(function(){
        $(this).parents('#messages').fadeOut()
        return false
    })

    // documentation process
    $('#documentation_form').submit(function() {
        $('input[name="delete_docs"]').attr(
            'value', BoxManager.remove.join('|')
        )
        return true
    })
})
