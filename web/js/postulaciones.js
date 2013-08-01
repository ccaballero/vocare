$(document).ready(function() {
    $("#postulante_estado option[value='Pendiente']").hide();
    $("input[type=submit][id=recivir]").click(function() {
        if (!confirm("Desea Guardar los cambios?")) {
            if (!confirm(" Desea salir de la edicion?")) {
                return false;
            } else {
                $(location).attr('href', "javascript:history.back(1)");
                return false;
            }
        }
    });

    $("input[type=submit][id=revisar]").click(function() {
        /*Contadores para Requisitos*/
        var countGR = 0;
        var countTR = 0;
        var countFR = 0;

        /*Contadores para documentos*/
        var countGD = 0;
        var countTD = 0;
        var countFD = 0;

        /*Contando los requisitos*/
        $("input[type=checkbox]").each(function() {
//            $("#postulante_estado option[value='Inscrito']").hide();
            var checkbox = $(this);
            if (checkbox.attr('name') == "postulante[requisito_list][]") {
                countGR = countGR + 1;
                if (checkbox.is(':checked')) {
                    countTR = countTR + 1;
                } else {
                    countFR = countFR + 1;
                }
            }
        });

        /*Contando los documentos*/
        $("input[type=checkbox]").each(function() {
            //alert(this.val());
            var checkbox = $(this);
            if (checkbox.attr('name') == "postulante[documento_list][]") {
                countGD = countGD + 1;
                if (checkbox.is(':checked')) {
                    countTD = countTD + 1;
                } else {
                    countFD = countFD + 1;
                }
            }
        });

        if ((countGR == countTR) && (countGD == countTD)) {
            $("#postulante_estado option[value='Habilitado']").attr("selected", "selected");
            if (!confirm("Desea Guardar los cambios?")) {

                if (!confirm(" Desea salir de la edicion?")) {
                    return false;
                } else {
                    $(location).attr('href', "javascript:history.back(1)");
                    return false;
                }
            }
        } else {
            $("#postulante_estado option[value='Inhabilitado']").attr("selected", "selected");
            if (countFR != 0 && countFD != 0) {
                if (!confirm("Desea guardar los cambios? \n no cumple con " + countFR +
                        " de los Requisitos \n y  falta " + countFD + " documentos \n se INHABILITARA al Postulante")) {


                    if (!confirm(" Desea salir de la edicion?")) {
                        return false;
                    } else {
                        $(location).attr('href', "javascript:history.back(1)");
                        return false;
                    }
                }
            } else {
                if (countFR != 0) {
                    if (!confirm("Desea guardar los cambios? \n no cumple con " + countFR + " de los Requisitos \n se INHABILITARA al Postulante")) {
                        if (!confirm(" Desea salir de la edicion?")) {
                            return false;
                        } else {
                            $(location).attr('href', "javascript:history.back(1)");
                            return false;
                        }
                    }

                } else {
                    if (!confirm("Desea guardar los cambios? \n no presento " + countFD + " de los Documentos \n se INHABILITARA al Postulante")) {
                        if (!confirm(" Desea salir de la edicion?")) {
                            return false;
                        } else {
                            $(location).attr('href', "javascript:history.back(1)");
                            return false;
                        }
                    }
                }
            }

        }
    });
    
    //Para reducir el trabajo de colocar observacion 
     $("textarea#postulante_observacion").click(function(){
         $("#postulante_estado option[value='Inscrito']").hide();
         var vacio = false;
       $("input[type=checkbox]").each(function() {
            var checkbox = $(this);
            var vaciar = "";
            
            if (checkbox.attr('name') === "postulante[requisito_list][]") {
                if (!checkbox.is(':checked')) {
                    $("textarea#postulante_observacion").val(vaciar);
                    vacio = true;
                    var test = $("label[for='" + $(this).attr('id') + "']").text();
                    $("textarea#postulante_observacion")[0].value += test;
                }
            }else
            
            if (checkbox.attr('name') === "postulante[documento_list][]") {
                if (!checkbox.is(':checked')) {
                    if (!vacio){
                      $("textarea#postulante_observacion").val(vaciar); 
                      vacio = true;
                    }
                    
                    var test = $("label[for='" + $(this).attr('id') + "']").text();
                    $("textarea#postulante_observacion")[0].value += test;
                }
            }
        });
        if(!vacio){
         var contenido = "Ninguna";
         $("textarea#postulante_observacion").val(contenido);   
        }
    });

    //Pestanas del Modulo de Postulaciones
    $(".el_contenido").hide();
    $("ul.pestañas li:first").addClass("active").show();
    $(".el_contenido:first").show();
    $("ul.pestañas li").click(function() {
        $("ul.pestañas li").removeClass("active");
        $(this).addClass("active");
        $(".el_contenido").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});