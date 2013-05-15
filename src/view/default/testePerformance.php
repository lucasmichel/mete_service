<?php 
    header('Content-Type: text/html; charset=utf-8', true);
    
?>
<script type="text/javascript">
    
    
    function displayTime() {
        var str = "";

        var currentTime = new Date()
        var hours = currentTime.getHours()
        var minutes = currentTime.getMinutes()
        var seconds = currentTime.getSeconds()

        if (minutes < 10) {
            minutes = "0" + minutes
        }
        if (seconds < 10) {
            seconds = "0" + seconds
        }
        str += hours + ":" + minutes + ":" + seconds + " ";
        if(hours > 11){
            str += "PM"
        } else {
            str += "AM"
        }
        return str;
    }
    
    
    $(document).ready(function($){          
        /*$.post("GetData.jsp",
          { name: "John", time: "2pm" },
              function(data){
                alert("Data Loaded: " + data);
              }
        );*/

        $("#ok").click(function() {
            
            
        
        tempo_1 = new Date();
        //alert("inicio: "+tempo_1.toTimeString());
        
        //alert(event.timeStamp);
        var email = $.trim($("#email").val());    
        var senha = $.trim($("#senha").val());


        <?php
        for($i = 0; $i < 200; $i++){
            ?>

                $.ajax({
                    url: "<?php echo BASE;?>/teste",
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
            
            //tempo_2.setMinutes(40);
            
            intervalo = tempo_2 - tempo_1;            
            
            
            //Date.UTC(nA, nM, nD [, nHora, nMin, nSeg, nMs])
            
            fimTime = new Date(2000, 5, 5, 0, 0, 0, intervalo);
            
            
            alert("inicio: "+tempo_1.toTimeString()+" fim :"+tempo_2.toTimeString());
            alert("intervalo: "+intervalo);
            alert("Resultado :"+fimTime.toTimeString());
            //alert("BYY :"+fimTime);
            /*
            alert("intervalo: "+intervalo);
            alert("fim: "+tempo_2.toTimeString());
            alert("Resultado :"+fimTime.toTimeString());
            */
    });

});
</script>
<div id="user-login" class="border">
    <form method="post">
        <ul>
            <li>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="" class="required" />
            </li>
            <li>
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" value="" class="required" /> 
                <input type="button" value=" OK " name="ok" id="ok" />
            </li>
        </ul>
    </form>
</div>