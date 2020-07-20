import React from 'react'
import ItemSearch from './ItemSearch'
import Arrow from './Arrow'
import BreadCrum from './BreadCrum'

const QuotingForm = ({ valores,index,onGoBack,onAddItem,campos,handleSubmit,errorSubmit }) =>{
  // De acuerdo al index se muestra la flecha de volver, la miga de pan y el boton de enviar
  let flecha = index?<Arrow onClick={onGoBack}/>:<span></span>; 
  let migapan = index?<BreadCrum items = {valores} />:''; 
  let boton = index  === campos.valores.length - 1 && !errorSubmit ?<button type="submit" className="btn btn-primary">Consultar</button>:<span></span>;  
  
  return 	<div className="card">
        <div className="card-header">
          {flecha}    
          Seleccione {campos.labels[index]}
        </div>
        <div className="card-body">
          {migapan}
          <form className="form-inline" onSubmit={handleSubmit}>
            <ItemSearch              
              onAddItem={onAddItem}
              valores = {valores}              
              index = {index}
              campos = {campos}
              errorSubmit = {errorSubmit}                  
            />                    
            {boton}
          </form>
        </div>        
     </div>		
}

export default QuotingForm 