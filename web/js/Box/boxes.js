function Box(name,taxonomy,dropable){
    this.tpl_div='<p><label>{0}:</label>&nbsp;</p>{1}'
    this.tpl_string='<p><label>{0}:</label>{1}</p>'
    this.tpl_input='<input type="text" value="{0}" />'
    this.tpl_box='\
<div class="box">\
    <div class="title">\
        <span class="text">{0}</span>\
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
    <div class="content">{1}</div>\
</div>'
    this.tpl_add='\
<div class="box_controls">\
    <ul>\
        <li><a class="add" onclick="return Behaviors.add(this)">+</a></li>\
    </ul>\
</div>'
    this.name=name
    this.taxonomy=taxonomy
    this.dropable=dropable
    this.render=function(flag_add){
        var render=''
        for(var key in this.taxonomy){
            var val=this.taxonomy[key]
            switch(Object.prototype.toString.call(val)){
                case '[object Array]':
                    for(i=0;i<val.length;i++){
                        box = new Box(i,val[i])
                        render+=this.tpl_div.format(key,box.render(true))
                    }
                    break
                default:
                    input=this.tpl_input.format(val)
                    render+=this.tpl_string.format(key,input)
            }
        }
        if(flag_add){
            return this.tpl_box.format(this.name,render)+this.tpl_add
        }else{
            return this.tpl_box.format(this.name,render)
        }
    }
}
