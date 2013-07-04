function Box(taxonomy){
    this.tpl_string='<p><label>{0}:</label>{1}</p>'
    this.tpl_input='<input type="text" value="{0}" />'
    this.tpl_box='\
<div class="box">\
    <div class="title">\
        <span class="text">#1</span>\
        <div class="controls">\
            <ul>\
                <li><a class="shrink" href="">_</a></li>\
                <li><a class="restore" href="">o</a></li>\
                <li><a class="close" href="">x</a></li>\
            </ul>\
        </div>\
    </div>\
    <div class="content">{0}</div>\
</div>\
<div class="box_controls">\
    <ul><li><a class="add" href="">+</a></li></ul>\
</div>'

    this.taxonomy=taxonomy
    this.render=function(){
        var render=''
        for(var key in this.taxonomy){
            var val=this.taxonomy[key]
            switch(Object.prototype.toString.call(val)){
                case '[object Array]':
                    for(i=0;i<val.length;i++){
                        box = new Box(val[i])
                        render+=this.tpl_string.format(key,box.render())
                    }
                    break
                default:
                    input=this.tpl_input.format(val)
                    render+=this.tpl_string.format(key,input)
            }
        }
        return this.tpl_box.format(render)
    }
    this.show=function(){
        $('#box').html(this.render())
    }
}
