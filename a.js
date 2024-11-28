function logout() { 
    window.location.href = 'cerrar.php';
}

function alta() { 
    window.location.href = 'Registro.php';
}
function agrega(id){
    var cantidad = $('#a'+id).val();
    
            $.ajax({
                url:'./countL.php',
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
        url:'./countL.php',
        type:'post',
        dataType:'text',
        data:'tipo='+tipo+'&'+'id='+id,
        success:function(res){
            
                $('#'+id).html(res);
            

    },error:function(){
        alert('Error archivo no encontrado');
    }})
}

function LikeComentario(id){
    var tipo = 2;
    
    $.ajax({
        url:'./countL.php',
        type:'post',
        dataType:'text',
        data:'tipo='+tipo+'&'+'id='+id,
        success:function(res){
            
                $('#com'+id).html('Este email esta en uso');
            

    },error:function(){
        alert('Error archivo no encontrado');
    }})
}
//function LikeComentario(id) { 
//    var tipo = 2; 
//    $.ajax({ url: './countL.php',
//        type: 'post',
//        dataType: 'json', 
//        data: { tipo: tipo, id: id },
//        success: function(res) { 
//            if (res.success) { 
//                $('#likes-' + id).html(res.total_likes + ' 👍');
//             } 
//             else { 
//                alert('Error al actualizar el like'); 
//            } }, error: function() { 
//    alert('Error archivo no encontrado'); 
//} 
//}); 
//}