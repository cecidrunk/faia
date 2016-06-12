<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_marce extends CI_Controller {

	public function index(){
		
	}
	public function ingresar(){
		$this->load->view('ingresarDatos');
	}
	 public function do_alert(){
        echo '<script type="text/javascript">alert("' . "Ha excedido el número de caracteres permitidos" . '"); </script>';
    }

	public function ingresarDatos(){

		//Este vector contiene todos los elementos ingresado, sin eliminar los repetidos
		$vecCompleto;
        //Este vector contiene todos los elementos pero sin repetir
		$vectorInicio;
		//Obtener los datos ingresados por pantalla
		$operando1 = $this->input->post('op1');
		$operando2 = $this->input->post('op2');
		$resultado = $this->input->post('res');

		//la funcion str_split divide en elementos y lo pone en un arreglo
		//la funcion array_reverse da vuelta el array
		$operando1 = str_split($operando1);
		$operando1 = array_reverse($operando1);
		$operando2 = str_split($operando2);
		$operando2 = array_reverse($operando2);
		$resultado = str_split($resultado);
		$resultado = array_reverse($resultado);
		$vecCompleto=$this->acomodarVectorInicio($operando1,$operando2,$resultado);
          $this->acomodarArray($vecCompleto);
         

		

		//Elimna los elementos repetidos
		$vectorInicio = array_unique($vecCompleto);
		//Elimina las posiciones vacias
		$vectorInicio = array_values( $vectorInicio );
		if (count($vectorInicio)<= 10){

			  //rellenar con guiones las demas posiciones del array hasta completar 10.
				$posiciones = count($vectorInicio);
				//var_dump($posiciones);
				$posFaltantes= 10 - $posiciones;
				//var_dump($posFaltantes);
			  for ($i= 1; $i <= $posFaltantes; $i++) { 
			  	array_push($vectorInicio, '-');
			  }
			  echo "<br> Vector Inicio: ";
			  var_dump(count($vectorInicio));

			  $this->acomodarArray($vectorInicio);
	   		  $this->crearMatrizInicial($operando1,$operando2, $resultado, $vectorInicio, $vecCompleto);
		   	 }else{		 
		 	$this->do_alert();
		 	return;  
		 }
	}
	
	public function acomodarVectorInicio($operando1,$operando2,$resultado){
		     $vectorInicio=array();
			$totalElementos = count(array_merge($resultado,$operando2,$operando1));
            $index=max(count($operando1),count($operando2),count($resultado));
            for ($i=0; $i < $index; $i++) { 
            	if(isset($operando1[$i])){
            		$vectorInicio[]=$operando1[$i];	
            	}            	          	
            	if(isset($operando2[$i])){
            		$vectorInicio[]=$operando2[$i];	
            		            	}
            	if(isset($resultado[$i])){
            		$vectorInicio[]=$resultado[$i];	
            	}
            }
          return $vectorInicio;
		}

	public function crearMatrizInicial($op1, $op2, $resul,$vecInicio, $vecCompleto)
	{
	
        $a = 'vector'; 
        $vector6 = array(2,5,6,0,1,8,7,9,3,4);
		 for($i=1; $i < 6; $i++){
		     ${$a.$i}=array('0','1', '2','3','4','5','6','7','8','9'); 
		   	 shuffle(${$a.$i});
		     echo "<br> -------------- <br>";
		     echo "vector".$i.": ";
			 echo implode('', (${$a.$i}));
			   
			 $valor_op1= $this->extraerValoresPorOperando(${$a.$i}, $op1,$vecInicio);
			 $valor_op2= $this->extraerValoresPorOperando(${$a.$i}, $op2,$vecInicio);
			 $valor_resul= $this->extraerValoresPorOperando(${$a.$i}, $resul,$vecInicio);
			 
			 echo "Op 1: ";		 
			 $this->acomodarArray($valor_op1);
			 //echo "<br>";
			 echo "Op 2: ";
			  $this->acomodarArray($valor_op2);
			 //echo "<br>";
			 echo "Resultado";
			 $this->acomodarArray($valor_resul);
			 //echo "<br>";
			 $suma = implode('',$valor_op1) + implode('',$valor_op2);
			 echo "suma: ". $suma.'</br>';
			 $brilloInicial = $this->obtenerBrillo($valor_resul,  $suma);
			 echo "Brillo inicial: ".$brilloInicial."</br>";
			 
		 }

		$this->aplicarAlgoritmo($vector1, $vector2, $vector3, $vector4, $vector5, $vector6, $op1, $op2, $resul, $vecInicio, $vecCompleto);
	}
	
	public function aplicarAlgoritmo($vector1, $vector2, $vector3, $vector4, $vector5,$vector6, $op1, $op2, $resul, $vecInicio, $vecCompleto)
	{
		//empezar con 5 iteraciones
		$vector= 'vector'; 

		$vector6 = array(2,5,6,0,1,8,7,9,3,4);
		 
		$i=0;
		$brillo=0;
		while ($brillo < count($resul) and $i<=50) { 
			$i = $i +1;
			$j = 0;
			//comparar vectores
			while (($brillo < count($resul)) and ($j < 5)) { 
				$j = $j +1;
				//comparar elemento A con todos los demas elementos
				$valor_op1_A= $this->extraerValoresPorOperando(${$vector.$j}, $op1, $vecInicio);
				$valor_op2_A= $this->extraerValoresPorOperando(${$vector.$j}, $op2, $vecInicio);
				$valor_resul_A= $this->extraerValoresPorOperando(${$vector.$j}, $resul,$vecInicio);
				$sumaA = implode('', $valor_op1_A) + implode('', $valor_op2_A);
				$brillo = $this->obtenerBrillo($valor_resul_A,  $sumaA);
				echo "</br";
				echo "Brillo de ".$vector.$j.": ".$brillo;	

				$k = 0;
				while (($brillo < count($resul)) and ($k < 5)) { 
					$k = $k +1;
					$valor_op1_B= $this->extraerValoresPorOperando(${$vector.$k}, $op1,$vecInicio);
					$valor_op2_B= $this->extraerValoresPorOperando(${$vector.$k}, $op2,$vecInicio);
					$valor_resul_B= $this->extraerValoresPorOperando(${$vector.$k}, $resul,$vecInicio);
					$sumaB = implode('', $valor_op1_B) + implode('', $valor_op2_B);
					$brilloB = $this->obtenerBrillo($valor_resul_B,  $sumaB);
					
					echo "Brillo de: ".$vector.$k.": ".$brilloB;

					if ($brillo <= $brilloB) {					
						//se calcula la distancia entre A y B y el resultado
						$distancia = $this->distancia($valor_resul_A, $valor_resul_B, $resul);
						$pos = $this->buscarPosicion($brillo, $vecCompleto);


						$valor_Anterior = ${$vector.$j}[$pos];
						$vector_letras = 0;
						$operando1 = 0;
						$operando2 = 0;
						$resultado = 0;

						$atractividad= $this->atractividad ($vector_letras, $operando1, $operando2, $resultado);

						//se mueve el menos brilloso hacia el mas brilloso
						${$vector.$j} = $this->movimiento(${$vector.$j}, ${$vector.$k}, $distancia, $pos, $atractividad,$brillo);				

						$valor_op1 = $this->extraerValoresPorOperando(${$vector.$j}, $op1, $vecInicio);
						$valor_op2 = $this->extraerValoresPorOperando(${$vector.$j}, $op2, $vecInicio);
						$valor_resul = $this->extraerValoresPorOperando(${$vector.$j}, $resul,$vecInicio);
						$suma = implode('',$valor_op1) + implode('',$valor_op2);
						//se recalcula el brillo del elemento que se movio.
						$brillo = $this->obtenerBrillo($valor_resul,  $suma);
						echo "Vector".$j.": ";
						$this->acomodarArray(${$vector.$j});
						echo "suma: ". $suma.'</br>';
						echo "Resultado: ";
			 			$this->acomodarArray($valor_resul);
			 			echo "Nuevo brillo de: ".$vector.$i.": ".$brillo." </br>--------------</br>";	 			
									}
					
				}
			}
		} //fin comparacion vectores

		if ($brillo >= count($resul)) {
			echo "SOLUCION";
			return "Se ha encontrado una solucion";
		}	
	}
	//DEYNROSM es el nuevo vector
	//DEY corresponde a la unidad entonces devuelve 3 (puedo cambiar desde la posicion 0 a 2)
	//NR corresponde a la decena, ya no toma en cuenta la E, entonces devuelve 2 (puedo cambiar desde la posicion 3 a 4)
	//O corresponde a la decena,  E y N ya se repiten, entonces deuelve 1 (Puedo cambiar la posicion 5)
	//SM corresponde a la centena, la O ya no toma encuenta, entonces devuelve 2 (puedo cambiar la posicion 6 a 7)
	//Y asi recorre todo el vector DEYNROSM; esto es lo que devuelve calcularPosicion.
	//falta ver como manejamos esos valores para movernos sobre el vector
	public function buscarPosicion($brillo, $vecCompleto)
	{
		$unidad = $this -> calcularPosicion(2, $vecCompleto);
		$decena = $this -> calcularPosicion(5, $vecCompleto);
		$centena = $this -> calcularPosicion(8, $vecCompleto);
		$udemil = $this -> calcularPosicion(11, $vecCompleto);
		$ddemil = $this -> calcularPosicion(14, $vecCompleto);
		switch ($brillo) {
		case  0:
			$max = $this -> calcularPosicion(2, $vecCompleto);
			if (($unidad-1)<>0) {
				$pos = rand(0,$unidad-1);
			} else {
				$pos = 0;
			}
			
			return $pos;
			break;

		case 1:
			
			$pos = $this -> calcularPosicion(5, $vecCompleto);
			if (($decena-1)<>0) {
				$pos = rand($unidad, $decena-1);
			} else {
				$pos = $unidad;
			}
			
			
			return $pos;
			break;

		case 2:
			
			$pos = $this -> calcularPosicion(8, $vecCompleto);
			if (($centena-1)<>0) {
				$pos = rand($decena, $centena-1);
			} else {
				$pos = $decena;
			}
						
			return $pos;
			break;

		case 3:
		 
			$pos = $this -> calcularPosicion(11, $vecCompleto);
			if (($udemil-1)<>0) {
				$pos = rand($centena, $udemil-1);
			} else {
				$pos = $centena;
			}
			
			
			return $pos;
			break;

		case 4:
			
			$pos = $this -> calcularPosicion(14, $vecCompleto);
			if (($ddemil-1)<>0) {
				$pos = rand($udemil,$ddemil-1);
			} else {
				$pos = $udemil;
			}
			
			
			return $pos;
			break;

		default:
			$pos = 8;
			return $pos;
			break;
		}
	}

	public function calcularPosicion ($cotaSuperior, $vecComp) {
           $maxPos=$cotaSuperior;
           $vecCompleto=$vecComp;
           $pos=3;
           for ($i=0 ; $i < 3 ; $i++ ) { 
           	  for ($j=0; $j <= $maxPos; $j++) {
           	  	echo "este es maxpos ".$maxPos;
           	  	if (isset($vecCompleto[$maxPos])) {
           	  	    if ($vecCompleto[$j]=$vecCompleto[$maxPos]) {
           	      	$pos=$pos-1;
           	      	break;
           	      } 
           	  	 }
           	  }
           	 $maxPos = $maxPos - 1;
           }
           echo "esto devuelve calcularPosicion ".$pos." ";
           return $pos;
	}

	public function intToArray( $x){
			$arr = array();
		    $arr = array_map('intval', str_split($x));
			return $arr;
		}
	
	public function obtenerBrillo( $suma,  $resultado){
		
		$res=$this->intToArray($resultado);
		
		$sum=0;
		$i=(sizeof($res)-1);
		$j=(sizeof($suma)-1);
		$counter=0;
		if(sizeof($res)<sizeof($suma)){
			$counter=sizeof($res);
		}else{
			$counter=sizeof($suma);
		}

		for ($k = ($counter-1); $k >=0; $k--) {
		    if($res[($i)]==$suma[($j)]){			 
			    $i--;
			    $j--;
		      
			    $sum++;
			}
		}
		return $sum;	
	}
	
	//Funcion para mostrar como matriz.
	public function acomodarArray(array $id){
	   $output = array();
           foreach ($id as $vectorInicio =>$a) {
           foreach ((array)$a as $key => $value) {
             $output[$key][] = $value; 
           }
      }
       foreach ($output as $o) {
            echo '<tr><td>' . implode('</td><td>', $o) . '</td></tr>'."<br/>";
	        }
	}

	public function extraerValoresPorOperando($vector, $operando, $vecInicio)	
	{

		$operando = array_reverse($operando);
		$op1_val = array();
		for ($i=0; $i < count($operando) ; $i++) { 
			$pos = array_search($operando[$i], $vecInicio, true);			
			//extrae los valores del vector pasado como "vector" y que coincidan 
			//con el operador 1.
			$operando_val[] = $vector[$pos];

		}
			return $operando_val;
	}
	//Funcion tentativa
	public function distancia($X1, $X2, $resultado){
		$d1 = abs(implode('', $resultado) - implode('', $X1));
		$d2 = abs(implode('', $resultado) - implode('', $X2));
		$d=abs($d1-$d2);
		return $d;
	}

	public function beta(){
		$valor_beta = 1;
		return $valor_beta;
	}

 // esta función se utiliza por elemento del vector luciernaga
	public function movimiento($X1, $X2, $distancia, $pos, $atractividad,$brillo){
		//epsilon es un número aleatorio que varía de -1 a 1
		//$epsilon = -1;

		/* alfa es un número que con el tiempo debería tender a 0, si es que nos acercamos a la solución, 
		o ser un número alto si estamos lejos de la solución */
		$alfa = rand(0,9);

		//función de movimiento
		$beta = $this->beta();
		$distancia = 3;
		$valor = $X1[$pos];
		//var_dump($X1);
		echo "valor a cambiar: ".$valor.", ";
		
		//$valor_nuevo = $valor + $beta * $distancia + $alfa*$epsilon;
		$valor_nuevo = $valor + $alfa;
		$valor_nuevo = fmod($valor_nuevo, 10);
		$posicion = array_search($valor_nuevo, $X1);
		if ($brillo<4) {
			while($atractividad[$posicion]<=$brillo){
				//$valor_nuevo = $valor + $beta * $distancia + $alfa*$epsilon;
				
					$alfa = rand(0,9);
					$valor_nuevo=$valor + $alfa;
					$valor_nuevo = fmod($valor_nuevo, 10);
					$posicion = array_search($valor_nuevo, $X1);			
			}
		}else{
				$alfa = rand(0,1);
				$valor_nuevo=$alfa;
				$posicion = array_search($valor_nuevo, $X1);
			}

		
		
		
		echo "valor cambiado: ".$valor_nuevo;
		echo "</br>";


		$X1=$this->controlarRepetidos($X1, $valor_nuevo,$X1[$pos]);

		$X1[$pos]=$valor_nuevo;
		//var_dump($X1);
		return $X1;

	}

	// Se busca los repetidos y se modifican
	public function controlarRepetidos($vectorEntrada, $valor_a_buscar, $valor_nuevo)
	{
		echo "VECTOR DE ENTRADA: ";
		$this->acomodarArray($vectorEntrada);
		
		echo "valor a buscar: ".$valor_a_buscar;
		$posicion = array_search($valor_a_buscar, $vectorEntrada);
		echo "posicion: ".$posicion;
		echo ", valor nuevo: ".$valor_nuevo."</br>";
		$vectorEntrada[$posicion] = $valor_nuevo;
		echo " Array arreglado: ";
		$this->acomodarArray($vectorEntrada);
		return $vectorEntrada;
	}

	
	public function atractividad ($vector_letras, $operando1, $operando2, $resultado){
		$atractividad= array(1,1,2,3,4,2,1,4,100,100);
		return $atractividad;
	}

	public function explorar ($luciernaga, $brillo, $atractividad){

	}

}

/* End of file CI_Principal.php */
/* Location: ./application/controllers/CI_Principal.php */