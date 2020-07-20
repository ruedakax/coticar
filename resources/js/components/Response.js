import React from 'react'
//import circlesImg from '../images/circles.png'
//import emptyImg from '../images/empty.png'
//import './styles/Card.css';
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader
import { Carousel } from 'react-responsive-carousel';

class Response extends React.Component{ 

   render(){      
      if(this.props.respuesta[0][0] !== null){
         return <Carousel showArrows={true} showThumbs={false}>
                  {this.props.respuesta.map((card,index) => (                  
                  <div className="card text-white bg-dark mb-3" key={index}>
                  <div className="card-header">Cotización</div>
                  <div className="card-body">
                     <h5 className="card-title">{card[0].title}</h5>                       
                        {card[0].body.map((item,ind) => (                           
                           <p className="card-text" key={ind}>{item}</p>
                        ))}                                                
                  </div>
                  </div>
               ))}      
               </Carousel> 
      } else{
         return <div className="card text-white bg-dark mb-3">
                  <div className="card-header"></div>
                  <div className="card-body">
                     <h5 className="card-title">¡Lo siento!</h5>
                     <p className="card-text">No hay resultados</p>
                  </div>
                  </div>
      }     
      
   }

}
export default Response