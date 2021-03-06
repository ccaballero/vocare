function Box(id,edit,name,title,taxonomy,dropable){
    this.tpl_div='<p><label>{0}:</label>&nbsp;</p>{1}'
    this.tpl_string='<p><label>{0}:</label>{1}</p>'
    this.tpl_input='<input type="text" name="{0}" value="{1}" />'
    this.tpl_hidden='<input type="hidden" name="{0}" value="{1}" />'
    this.tpl_box='\
<div class="box"{0}>\
    <div class="title">\
        {1}\
        <span class="text">{2}</span>\
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
    <div class="content">{3}</div>\
</div>'
    this.tpl_add='\
<div class="box_controls">\
    <ul>\
        <li><a class="add" onclick="return Behaviors.add(this,{0})">+</a></li>\
    </ul>\
</div>'
    this.id=id // generate in creation
    this.edit=edit
    this.name=name
    this.title=title
    this.taxonomy=taxonomy
    this.dropable=dropable
    this.render=function(flag_add,flag_root,level){
        return this._render(this.name,flag_add,flag_root,level)
    }
    this._render=function(name,flag_add,flag_root,level){
        var render=''
        for(var key in this.taxonomy){
            var val=this.taxonomy[key]
            switch(Object.prototype.toString.call(val)){
                case '[object Array]':
                    boxes=''
                    for(i=0;i<val.length;i++){
                        box=new Box(i,'',name+'['+key+']['+i+']',i,val[i],false)
                        flag=false
                        if((i+1)===val.length){
                            flag=true
                        }
                        boxes+=box.render(flag,false,level+1)
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
        var hidden=''
        if(flag_root){
            id_root=' id="box-'+this.id+'"'
            hidden=this.tpl_hidden.format(name+'[_doc]',this.edit)
        }
        render=this.tpl_box.format(id_root,hidden,this.title,render)
        if(flag_add){
            render+=this.tpl_add.format(level);
        }
        return render
    }
}
