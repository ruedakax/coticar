<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automovil extends Model{

	protected $fillable = ['depto','marca','modelo','anio'];
	protected $table = 'vehiculo';
	
	public static function getMainByColumn($data,$column,$array_cond,$traer_anio=FALSE){
		$data['depto'] =  $column==='depto'?$array_cond[1]:$data['depto'];
		$oper_depto = $column==='depto'?$array_cond[0]:'=';

		$oper_color = $column==='color'?$array_cond[0]:'=';
		$color = $column==='color'?$array_cond[1]:'1';

		$agrupador = $traer_anio?"$column,anio":$column;
		$data['anio'] = $traer_anio?1:$data['anio'];
		$oper_anio = $traer_anio?'!=':'=';

		$main = Automovil::selectRaw("$agrupador,count(*) as cantidad")
						->where('depto',$oper_depto,$data['depto'])
						->where('marca','=',$data['marca'])
						->where('modelo','=',$data['modelo'])
						->where('anio',$oper_anio,$data['anio'])
						->where('color','!=',$color)
						//->where($column,$array_cond[0],$array_cond[1])
						->groupByRaw($agrupador)
						->orderBy('cantidad','DESC')
						->first();

		return $main;
	}

    public static function quote($data){		

		$sub = Automovil::selectRaw('depto,kilometros,precio,NTILE(28) OVER (ORDER BY kilometros) AS Buckets')
						->where('depto','=',$data['depto'])
						->where('marca','=',$data['marca'])
						->where('modelo','=',$data['modelo'])
						->where('anio','=',$data['anio'])						
						->getQuery();
		
		$quote =  Automovil::selectRaw('COUNT(*) AS Count,ceil(AVG(kilometros)) AS kilometros,ceil(AVG(precio)) as precio,ceil(Max(kilometros)) AS max_kilometros,ceil(Max(precio)) max_precio,ceil(Min(kilometros)) AS min_kilometros,ceil(min(precio)) as min_precio')							
						->fromSub($sub,'t')
						->where('Buckets','>','2')							
						->groupBy('depto')
						->first();
		//si no llega nada relajamos el condicional de buckets
		if(!$quote){		
			$quote =  Automovil::selectRaw('COUNT(*) AS Count,ceil(AVG(kilometros)) AS kilometros,ceil(AVG(precio)) as precio,ceil(Max(kilometros)) AS max_kilometros,ceil(Max(precio)) max_precio,ceil(Min(kilometros)) AS min_kilometros,ceil(min(precio)) as min_precio')							
						->fromSub($sub,'t')												
						->groupBy('depto')
						->first();
		}	
		return $quote;
	}
}
