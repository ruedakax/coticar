import React from 'react' 
import QuotingForm from '../components/QuotingForm'
import Response from '../components/Response'
import {url} from '../config'

class QuotingContainer extends React.Component{
	state = {
		campos : {
			valores:['depto','marca','modelo','anio'],
			labels:['la Zona','la Marca','el Modelo','el Año'],
		},		
		valores:[],
		index:0,
		valor:'',
		respuesta:null
	}

	onAddItem = (e) => {				
		const { name, value } = e.target;						
		this.setState( state => {
		  const valores = state.index===state.campos.valores.length-1?[...state.valores.slice(0,state.index), value]:[...state.valores, value];
		  const indice = state.index===state.campos.valores.length-1?state.index:state.index + 1;	
		  return {
			valores:valores,
			index:indice
		  }
		});		
	}
	/*evento que controla el boton de volver*/
	onGoBack = (e) =>{		
		const { name, value } = e.target;
		this.setState( state => {
			const indice = state.index > 0 ? state.index - 1:0;
			const values = state.valores.slice(0,indice);
			return {
			  index:indice,
			  valores:values,
			  error:null,
			  respuesta:null
			}
		});		
	}

	handleSubmit = async e => {
		
		e.preventDefault();
				
		var columns = this.state.campos.valores;

		var rows = this.state.valores;
		
		//se construye el objeto para ser enviado en el request
		// con los valores de la consulta
		var query = rows.reduce(function(query, field, cont) {			
			query[columns[cont]] = field;
			return query;
		  }, {})	
		
		try{			
			let config = {
				method:'POST',
				headers: {
					'Accept':'application/json',
					'Content-Type':'application/json',
				},
				body:JSON.stringify(query)				
			}
			let res = await fetch(`https://coticar.herokuapp.com/api/quoting`,config);
			let data = await res.json();			
			if(!data.exception && !data.errors){
				this.setState({
					respuesta: data,					
				});
			}else{
				this.setState({
					error : new Error('La consulta falló: \nRevise los datos ingresados. \n Intente Volver.'),
			 })
			}			
		}catch(error){			 
			 this.setState({
				 error: new Error('La consulta falló: \n Revise los datos ingresados. \n Intente Volver.'),
			 })		
		}		
	}
		
	render(){
		//variable que carga el componente de la respuesta a la consulta
		let card_quote = this.state.respuesta?<Response respuesta = {this.state.respuesta}/>:''; 
	
		return <div className="container">
				<QuotingForm 
					valores = {this.state.valores}
					index = {this.state.index}
					onAddItem = {this.onAddItem}
					campos = {this.state.campos}
					onGoBack = {this.onGoBack}
					handleSubmit = {this.handleSubmit}
					errorSubmit = {this.state.error}
				/>
				{card_quote}				
			   </div>				
	}	
}

export default QuotingContainer