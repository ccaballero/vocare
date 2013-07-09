var Behaviors=new(function(){
    this.add=function(element){
        box=$(element).parent().parent().parent().prev()
        var new_box=box.clone(true)
        _ot = parseInt(new_box.children('.title')
                              .children('span.text').html())
        new_box.children('.title').children('span.text').html(_ot+1)
        new_box.show().insertAfter(box)
        return false
    }
    this.close=function(element){
        box=$(element)
            .parent()
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
    }
    this.restore=function(element){
        $(element).parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .children('.content')
            .show()
        return false
    }
    this.shrink=function(element){
        $(element).parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .children('.content')
            .hide()
        return false
    }
})()
