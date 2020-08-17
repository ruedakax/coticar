import React from 'react'

const BreadCrumb = ({items}) => {    
   return  <nav aria-label="breadcrumb" className="bg-secondary">
   <ol className="breadcrumb" >
   {items.map((item,index) => (
      <li className="breadcrumb-item active" aria-current="page" key={index}>{item}</li>
	))}    
   </ol>
 </nav>
    
}
	
export default BreadCrumb