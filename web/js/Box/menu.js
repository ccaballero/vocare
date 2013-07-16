var Menu=new(function(){
    this.tpl_menu='\
<li>\
    <a onclick="return BoxManager.switch({0})">{1}</a>\
    {2}\
</li>'
    this.tpl_controls='\
<div class="right">\
    <a onclick="return BoxManager.removeDoc({0})">[eliminar]</a>\
&nbsp;</div>'
    this.render=function(boxes,selectorMenu){
        var menu=''
        for(i=0;i<boxes.length;i++){
            var box=boxes[i]
            if(typeof box !== 'undefined'){
                if(box.dropable){
                    menu+=this.tpl_menu.format(
                        box.id,box.title,this.tpl_controls.format(box.id))
                }else{
                    menu+=this.tpl_menu.format(
                        box.id,box.title,'')
                }
            }
        }
        return $(selectorMenu).html(menu)
    }
})()
