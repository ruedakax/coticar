import React from 'react'
import ReactTooltip from "react-tooltip"

const Arrow = ({onClick}) => {    
   return  <div>
    <ReactTooltip id="registerTip" place="top" effect="float" type="info" backgroundColor="#f88102">Volver</ReactTooltip>
   <button type="button" className="btn bg-dark" onClick={onClick} data-for="registerTip" data-tip>
    <svg className='bi bi-arrow-left-circle' width='1.7em' height='1.7em' viewBox='0 0 16 16' fill='#f88102' xmlns='http://www.w3.org/2000/svg'> <path fillRule='evenodd' d='M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/><path fillRule='evenodd' d='M8.354 11.354a.5.5 0 0 0 0-.708L5.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z'/><path fillRule='evenodd' d='M11.5 8a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z'/></svg>
   </button>  
  </div>
}
	
export default Arrow