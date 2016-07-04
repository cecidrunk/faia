<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title> IA</title>
   <link rel="stylesheet" href="<?php echo site_url('faia/stylesheets/style.css');?>" type="text/css">
    <script src='<?php echo base_url('/faia/javascripts/jquery-1.8.0.min.js');?>' type="text/javascript"></script>
   <script type="text/javascript">
     $(document).ready(function (){
      $("input:checkbox").click(function(){
        $("[name="+$(this).prop('name')+"]").prop("checked", false);
        $(this).prop("checked", true);
      });
     });
   </script>
     
<script type="text/javascript">
var ray={
ajax:function(st)
  {
    this.show('loading');
  },
show:function(el)
  {
    this.getID(el).style.display='';
  },
getID:function(el)
  {
    return document.getElementById(el);
  }
}
</script>
<style type="text/css">
#loading {
   width: 100%;
   height: 100%;
   top: 0px;
   left: 0px;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-image {
  padding-top: 150px;
  top: 100px;
  left: 240px;
  z-index: 100;
}</style>
   </head>
   <body id="principal" >
    <div id="loading" style="display:none;">
  <img id="loading-image" src="<?php echo base_url('/faia/images/');?>/loader.gif"  />
</div>
   <p align="center"  style="padding: 00px 0px 20px 0px"><font color="WHITE"  >Cripto-aritmetica</font></p>
	

<form  action="mostrarResul" method="POST" accept-charset="utf-8" onsubmit="return ray.ajax()">

    <label>Número de iteraciones</label>
    <input type="number" name="cant_iteraciones" min="1" style="width: 60px" value="10" /><br/>

      <label>Número de luciernagas</label>
    <input type="number" name="poblacion" min="2" style="width: 60px" value="100" /><br/>

    <label >Suma</label>
      <input type="radio" name="prop" id="suma" value="+" checked/><br/>
    
    <label >Resta</label>
      <input type="radio" name="prop" id="resta" value="-" /><br/>

    
    <label>Primer operador</label>
    <input type="text" name="op1" id="field" pattern="[a-z]{5,10}" title="Mínimo 5 caracteres en minusculas"  placeholder="5 letras mínimo" required title="5 Caracteres mínimo" required="required"/><br/>

    <label>Segundo operador</label>
    <input type="text" name="op2" id="field" pattern="[a-z]{5,10}" title="Mínimo 5 caracteres en minusculas"  placeholder="5 letras mínimo" required title="5 Caracteres mínimo" required="required"/><br/>

    <label>Resultado</label>
    <input type="text" name="res"  pattern=".{4,10}" required title="Mínimo caracteres en minusculas" required="required"/><br/>

    <span  class="form-field-no-caption"><input type="submit" value="Resolver" style="color:white;
background-color:#555555; "/></span>
</form>

	</body>
	</html>