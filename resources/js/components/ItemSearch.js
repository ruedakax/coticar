import React from 'react'
import useFetch from '../hooks/useFetch'
import Items from './Items'
import {url} from '../config'
import Loading from '../components/Loading'
import FatalError from '../components/FatalError'

const ItemSearch = ({onAddItem,valores,index,campos,errorSubmit}) => {              

        const args = () => (campos.valores.slice(0,index + 1).join('|'))

        const vals = () => (valores.slice(0,index).join('|'))       

        if(errorSubmit){
                console.log(errorSubmit);
                return <FatalError error={errorSubmit}/>
        }
	
        
        const {data, loading, error} = useFetch(`${url}items/${args()}/${vals()}`);
        
        if(loading)
	        return <Loading />		
	if(error)
		return <FatalError 
                            error={error}    
                        />        
        return  <Items                
                items = {data}
                loading = {loading}               
                vdefault = "Seleccione..."
                onChange = {onAddItem}               
                valores = {valores}
                index = {index}
                campos = {campos}                              
        />        
}

export default ItemSearch;