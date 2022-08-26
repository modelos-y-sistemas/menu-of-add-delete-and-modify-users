
function state(){
    var name=$('#name').val();
    var codcurso=$('#codcurso').val();
    var email=$('#email').val();
    var pathname = window.location.pathname;
    var parametros={
        "name" : name,
        "email" : email,
        "codcurso" : codcurso,
        "pathname" : pathname
    };
    $.ajax({
        url: "http://localhost/menu-of-add-delete-and-modify-users/class/user.php", 
        type: "post",
        data: parametros,
        success: function(data){
            var resp=JSON.parse(data);
            var r='Usuario agregado: <br>'+resp;
            $('div.resp').html(r);
        }
    });
    return false;
}
