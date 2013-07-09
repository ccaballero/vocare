var BoxManager=new(function(){
    this.list=[]
    this.selector=''
    this.selectorMenu=''
    this.create=function(id,name,taxonomy,dropable){
        var box=new Box(id,name,taxonomy,dropable)
        this.list.push(box)
    }
    this.render=function(count){
        $(BoxManager.selector).html(this.list[count].render(false))
    }
    this.switch=function(box){
        BoxManager.render(box)
        return false
    }
    this.menu=function(){
        Menu.render(this.list,BoxManager.selectorMenu)
    }
    this.addDoc=function(title){
        var taxonomy=this.list[0].taxonomy
        var title=title+(this.list.length-2)
        this.create(title,taxonomy,true)
        this.menu()
        return false
    }
    this.removeDoc=function(index){
        this.list.splice(index,1)
        this.menu()
        return false
    }
})()