var BoxManager=new(function(){
    this.tpl_menu='\
<li>\
    <a onclick="return BoxManager.switch(\'{0}\',{1})">{2}</a>\
</li>'

    this.list=[]
    this.add=function(name,taxonomy){
        this.list.push(new Box(name,taxonomy))
    }
    this.renderAll=function(selector){
        var render=''
        for(i=0;i<this.list.length;i++){
            render+=this.list[i].render(false)
        }
        $(selector).html(render)
    }
    this.render=function(selector,count){
        $(selector).html(this.list[count].render(false))
    }
    this.render_menu=function(selector_menu,selector){
        var menu=''
        for(i=0;i<this.list.length;i++){
            menu+=this.tpl_menu.format(selector,i,this.list[i].name)
        }
        return $(selector_menu).html(menu)
    }
    this.switch=function(selector,box){
        BoxManager.render(selector,box)
        return false
    }
})()
