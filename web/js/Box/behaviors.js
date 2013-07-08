var Behaviors=new(function(){
    this.set=function(){
        $('.box_controls a.add').click(function(){
            box=$(this).parent().parent().parent().prev()
            var new_box=box.clone(true)

            _ot = parseInt(new_box.children('.title')
                                  .children('span.text').html())
            new_box.children('.title').children('span.text').html(_ot+1)

            new_box.show().insertAfter(box)
            return false
        })
        $('.controls a.close').click(function(){
            box=$(this).parent()
                   .parent()
                   .parent()
                   .parent()
                   .parent()
            content=box.parent()
            if(content.children('.box').length>1){
                box.remove()
            }else{
                alert('Debe quedarse al menos un elemento')
            }
            return false
        })
        $('.controls a.restore').click(function(){
            $(this).parent()
                   .parent()
                   .parent()
                   .parent()
                   .parent()
                   .children('.content')
                   .show()
            return false
        })
        $('.controls a.shrink').click(function(){
            $(this).parent()
                   .parent()
                   .parent()
                   .parent()
                   .parent()
                   .children('.content')
                   .hide()
            return false
        })
    }
})()
