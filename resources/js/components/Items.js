import React from 'react';


const Items = ({items,vdefault,onChange,campos,index}) =>{    

    return <select className="custom-select my-1 mr-sm-2 bg-secondary" id={campos[index]} name={campos[index]} defaultValue={vdefault} onChange={onChange}>        
        <option value={vdefault}>{vdefault}</option>
        {items.map((item) => (
            <option 
                value={item.valor}
                key={item.valor}          
            >
                {item.valor}
            </option>
		))}    
    </select>           
}

export default Items;