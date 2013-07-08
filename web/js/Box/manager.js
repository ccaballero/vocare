var BoxManager=new(function(){
    this.tpl_menu = '<li><a href="" onclick="">{0}</a></li>'
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
    this.render_menu=function(selector){
        var menu = ''
        for(i=0;i<this.list.length;i++){
            menu+=this.tpl_menu.format(this.list[i].name)
        }
        return $(selector).html(menu)
    }
    this.switch=function(box){
        BoxManager.render('#box',box)
    }
})()
