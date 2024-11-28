function logout() { 
    window.location.href = 'cerrar.php';
}

function alta() { 
    window.location.href = 'Registro.php';
}
function agrega(id){
    var cantidad = $('#a'+id).val();
    
            $.ajax({
                url:'/Front/add.php?',
                type:'post',
                dataType:'text',
                data:'cantidad='+cantidad+'&'+'producto_id='+id,
                success:function(res){
                    if(res==1){
                const loader = document.getElementById('loader');
                loader.style.display = 'block';
                setTimeout(function() {
                loader.style.display = 'none';
                }, 5000);}

            },error:function(){
                alert('Error archivo no encontrado');
            }})
            
}

function LikeLugar(id){
    var tipo = 1;
    
    $.ajax({
        url:'/Front/add.php?',
        type:'post',
        dataType:'text',
        data:'tipo='+tipo+'&'+'lugar_id='+id,
        success:function(res){
            
                $('#'+id).html('Este email esta en uso');
            

    },error:function(){
        alert('Error archivo no encontrado');
    }})
}

function LikeComentario(id){
    var tipo = 2;
    
    $.ajax({
        url:'/Front/add.php?',
        type:'post',
        dataType:'text',
        data:'tipo='+tipo+'&'+'comentario_id='+id,
        success:function(res){
            
                $('#'+id).html('Este email esta en uso');
            

    },error:function(){
        alert('Error archivo no encontrado');
    }})
}