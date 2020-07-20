import React from 'react'

const FatalError = ({error}) => (  
	<div className="alert alert-danger" role="alert">
       <span className="glyphicon glyphicon-exclamation-sign" aria-hidden="true"><small>{error.message}</small></span> 
    </div>
)

export default FatalError