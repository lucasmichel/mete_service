<?php 
    header('Content-Type: text/html; charset=utf-8', true);
?>
<script type="text/javascript">
    
function GetTime(d) {
    var month = (d.getMonth() < 10) ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1);
    var day = (d.getDate() < 10) ? "0" + d.getMonth() : d.getMonth();
    var hour = (d.getHours() < 10) ? "0" + d.getHours() : d.getHours();
    var minute = (d.getMinutes() < 10) ? "0" + d.getMinutes() : d.getMinutes();
    var second = (d.getSeconds() < 10) ? "0" + d.getSeconds() : d.getSeconds();

    return d.getDate() + "." + month + "." + d.getFullYear() + " " + hour + ":" + minute + ":" + second;
}



function log(tempo1, tempo2){
        
        
        temp1 = tempo1.getFullYear()+'-'+ tempo1.getMonth()+'-'+tempo1.getDate()+' '+tempo1.getHours()+':'+tempo1.getMinutes()+':'+tempo1.getSeconds();
        temp2 = tempo2.getFullYear()+'-'+ tempo2.getMonth()+'-'+tempo2.getDate()+' '+tempo2.getHours()+':'+tempo2.getMinutes()+':'+tempo2.getSeconds();
        
        //alert(tempo1.toString());
        //alert(tempo2.toString());
        
        
        //"2011-11-10 11:05:12"
        
        $.ajax({
            url: "<?php echo BASE;?>/gravarLog",
            type: "POST",
            //data: {funcao:'logarAndroid', dataIncio:tempo1, dataFim:tempo2},
            
            data: 'funcao=listarServico&dataIncio='+ temp1 +'&dataFim='+ temp2,
            
            dataType: "html",
            async:false,
            success:function(data){                                
                alert(data);
                    /*if(retorno == 0){            
                            nomeOrgaoJaExiste = true;
                return true;
                    }else{            
                            nomeOrgaoJaExiste = false;
                return false; 
                    }*/
            }
        });
}//fim validarSeCNPJJaExisteEdicao;


    
    
    
    
    $(document).ready(function($){          
        /*
        tempo1  = new Date();
        tempo2  = new Date();
        tempo2.setMinutes(50);       
        
        log(tempo1, tempo2);
        
        return;*/
        
        
        

        $("#ok").click(function() {
            
            
        
        tempo_1 = new Date();
        //alert("inicio: "+tempo_1.toTimeString());
        
        //alert(event.timeStamp);
        var email = $.trim($("#email").val());    
        var senha = $.trim($("#senha").val());


        <?php
        for($i = 0; $i < 30; $i++){
            ?>

                $.ajax({
                    url: "<?php echo BASE;?>/testeListaServico",
                    type: "POST",
                    data: {email: email, senha:senha},
                    dataType: "html",
                    async:false,
                    success:function(data){                                
                        //alert(data);
                            /*if(retorno == 0){            
                                    nomeOrgaoJaExiste = true;
                        return true;
                            }else{            
                                    nomeOrgaoJaExiste = false;
                        return false; 
                            }*/
                    }
                });    


            <?php
        }
        ?>
                    
            // outras instruções
            tempo_2 = new Date();
            
            /*
            intervalo = tempo_2 - tempo_1;            
            
            fimTime = new Date(2000, 5, 5, 0, 0, 0, intervalo);
            
            alert("inicio: "+tempo_1.toTimeString()+" fim :"+tempo_2.toTimeString());
            alert("intervalo: "+intervalo);
            alert("Resultado :"+fimTime.toTimeString());*/
            
           log(tempo_1, tempo_2);
           
           
    });

});
</script>
<div id="user-login" class="border">
    <form method="post">
        <ul>
            <li>
                <h2>Lista servico</h2>
            </li>
            <li>
                <input type="button" value=" OK " name="ok" id="ok" />
            </li>
        </ul>
    </form>
</div>