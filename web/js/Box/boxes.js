function Box(id,name,taxonomy,dropable){
    this.tpl_div='<p><label>{0}:</label>&nbsp;</p>{1}'
    this.tpl_string='<p><label>{0}:</label>{1}</p>'
    this.tpl_input='<input type="text" name="{0}" value="{1}" />'
    this.tpl_box='\
<div class="box"{0}>\
    <div class="title">\
        <span class="text">{1}</span>\
        <div class="controls">\
            <ul>\
                <li><a class="shrink"\
                       onclick="return Behaviors.shrink(this)">_</a></li>\
                <li><a class="restore"\
                       onclick="return Behaviors.restore(this)">o</a></li>\
                <li><a class="close"\
                       onclick="return Behaviors.close(this)">x</a></li>\
            </ul>\
        </div>\
    </div>\
    <div class="content">{2}</div>\
</div>'
    this.tpl_add='\
<div class="box_controls">\
    <ul>\
        <li><a class="add" onclick="return Behaviors.add(this)">+</a></li>\
    </ul>\
</div>'
    this.id=id
    this.name=name
    this.taxonomy=taxonomy
    this.dropable=dropable
    this.render=function(flag_add,flag_root){
        return this._render(this.id,flag_add,flag_root)
    }
    this._render=function(name,flag_add,flag_root){
        var render=''
        for(var key in this.taxonomy){
            var val=this.taxonomy[key]
            switch(Object.prototype.toString.call(val)){
                case '[object Array]':
                    boxes=''
                    for(i=0;i<val.length;i++){
                        box=new Box(name+'['+key+'][]',i,val[i],false)
                        flag=false
                        if((i+1)===val.length){
                            flag=true
                        }
                        boxes+=box.render(flag,false)
                    }
                    render+=this.tpl_div.format(key,boxes)
                    break
                default:
                    _name=name+'['+key+']'
                    input=this.tpl_input.format(_name,val)
                    render+=this.tpl_string.format(key,input)
            }
        }
        var id_root=''
        if(flag_root){
            id_root=' id="box-'+this.id+'"'
        }
        render=this.tpl_box.format(id_root,this.name,render)
        if(flag_add){
            render+=this.tpl_add
        }
        return render
    }
}
