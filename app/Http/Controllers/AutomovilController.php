<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Automovil;

class AutomovilController extends Controller{
    public function inicio(){
		return view('inicio');
	}

	public function getValues($column,$vals=null){
		$codigo = 201;
		if($column !='undefined' ){
			try{
				$params = isset($column)?explode('|', $column):array('marca');
				$vals = isset($vals)?explode('|',$vals):array();

				//$tales = new Automovil(array_combine(array_slice($params,1,count($vals)),$vals));
				
				$fase = count($params);
				$fase_val = count($vals);				

				$campo = $params[$fase-1];			
				$salida = DB::table('vehiculo')
							->select("$campo as valor")
							->groupBy('valor');
		
				//el order solo cambia para el año			
				if($campo ==='anio')
					$salida->orderBy(\DB::raw('valor'), 'ASC');
				else
					$salida->orderBy(\DB::raw("count($campo)"), 'DESC');
				//se agregan los condicionales
				if($fase > 1 && $fase_val > 0){//si es la primera fase no van condicionales				
					for($i=0;$i<$fase_val;$i++){						
						$salida->where($params[$i],$vals[$i]);
					}									
				}
				//dd($salida);				
				$salida = $salida->get();				
				
			}catch(Exception $e){
				$salida = ['error'=>'page not found'];
				$codigo = 500;
			}
		}else{
			$salida = ['error'=>'page not found'];
			$codigo = 500;
		}
		return response()->json($salida,$codigo);
	}	
	
	public function quote(){
		$codigo = 201;
		$data = request()->validate([
			'depto' => 'required',
			'marca'=>['required',],
			'modelo' =>['required'],
			'anio' =>['required','numeric']
		],[
			'depto.required' => 'El campo departamento es obligatorio',
			'marca.required' => 'El campo marca es obligatorio.',
			'modelo.required' => 'El campo modelo es obligatorio.',
			'anio.numeric' => 'El campo año debe ser numérico',
			'anio.required' => 'El campo año es obligatorio'
		]);		
		
		//consulta principal
		$quote = Automovil::quote($data);
		//consulta color más comun	
		$quote_color = Automovil::getMainByColumn($data,'color',array('!=',' '));
		//consulta departamento que ofrece una alternativa con las mismas caracteristicas					
		$quote_depto = Automovil::getMainByColumn($data,'depto',array('!=',$data['depto']),TRUE);		
		//se cambian los valores para consultar la alternativa
		$data['depto'] = $quote_depto->depto;
		$data['anio'] = $quote_depto->anio;
		//alternativa a la consulta principal
		$quote_other_depto = Automovil::quote($data);
		
		$principal = $quote?$quote:NULL;
		$alternativa = $quote_other_depto?array($quote_depto,$quote_other_depto):NULL;		
		$color = $quote_color?$quote_color:NULL;

		$total_quote = $this->buildCards(array(
			'principal'=> $principal,
			'color'=>$color,
			'otro_dep'=>$alternativa,
		));
		
		//dd($total_quote);
		return response()->json($total_quote,$codigo);
	}

	private function buildCards($cards){	
		setlocale(LC_MONETARY, 'es_CO'); 

		$res = array();

		foreach($cards as $key => $card){
			$a_card = array();			
			if(!is_null($card)){
				switch ($key) {
					case 'principal':																
							$a_card[] = [
								"title" => "Cotización",
								"body" => array("Kms promedio : ".number_format($card->kilometros),
										   "Precio promedio : $ ".number_format($card->precio),
										   "Kms mínimo : ".number_format($card->min_kilometros),
										   "Precio mínimo : $ ".number_format($card->min_precio),
										   "Kms máximo : ".number_format($card->max_kilometros),
										   "Precio máximo : $ ".number_format($card->max_precio)
										  )
							];											
						break;
					case 'color':						
							$a_card[] = [
								"title" => "Color",
								"body" => array("El más usado: ".strtoupper($card->color))
							];											
					break;
					case 'otro_dep':							
							$a_card[] = [
								"title" => "Mismo vehículo otra zona (".ucwords($card[0]->depto).")",
								"body" => array("Kms promedio : ".number_format($card[1]->kilometros),
											"Precio promedio : $ ".number_format($card[1]->precio),
											"Kms mínimo : ".number_format($card[1]->min_kilometros),
											"Precio mínimo : $ ".number_format($card[1]->min_precio),
											"Kms máximo :  ".number_format($card[1]->max_kilometros),
											"Precio máximo : $ ".number_format($card[1]->max_precio)
										 )
							];						
					break;
				}
				array_push($res,$a_card);
			}		
			
		}
		return $res;
	}
}



