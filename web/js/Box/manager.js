var BoxManager=new(function(){
    this.tpl_name='{0}_{1}'
    this.selector=''
    this.selectorMenu=''
    this.list=[]
    this.remove=[]
    this.counter=0
    this.create=function(edit,name,title,taxonomy,dropable){
        var id=this.counter++
        var box=new Box(id,edit,this.tpl_name.format(name,id),title,taxonomy,dropable)
        this.list.push(box)
    }
    this.render=function(id){
        var box=this.list[id]
        _box=$(BoxManager.selector+'>#box-'+box.id)
        if(_box.exists()){
            $(BoxManager.selector+'>.box:not(.hidden)').addClass('hidden')
            _box.removeClass('hidden')
        }else{
            var render=this.list[id].render(false,true)
            $(BoxManager.selector+'>.box').each(function(){
                $(this).addClass('hidden')
            })
            $(BoxManager.selector).append(render)
        }
    }
    this.switch=function(id){
        BoxManager.render(id)
        return false
    }
    this.menu=function(){
        Menu.render(this.list,BoxManager.selectorMenu)
    }
    this.addDoc=function(title){
        var taxonomy=this.list[0].taxonomy
        this.create('','new',title,taxonomy,true)
        this.menu()
        return false
    }
    this.removeDoc=function(index){
        this.remove.push(this.list[index].edit)
        delete this.list[index]
        this.menu()
        return false
    }
})()
