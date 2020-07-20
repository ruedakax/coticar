import {useState,useEffect} from 'react'

const useFetch = url => {
	
	const [data, setData] = useState([]) // se declara la variable y la funcion que llenará esa variable
	const [loading,setLoading] = useState(true)
	const [error,setError] = useState(null)
	
	useEffect(()=>{
		const fetchResource = async () => {
			try{
				let res = await fetch(url)
				let data = await res.json()
				if(res.ok) {				
					setData(data)
					setLoading(false)		
				}else {
					error = new Error('El servicio presenta dificultades: intente recargar la página');
					setError(error)
					setLoading(false)
				}						
				//console.log(data)			
			}catch (error) {
				error = new Error('El servicio presenta dificultades: intente recargar la página');
				setError(error)
				setLoading(false)
			}
		}
		fetchResource()		
	},[url])
	
	return {data, loading, error}
}

export default useFetch