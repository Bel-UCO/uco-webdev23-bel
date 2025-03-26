import { useState } from "react";
import '../../css/home.css';



const Nav = ()=>{

    const [selectedIndex, setSelectedIndex] = useState(0);

    return (
        <div className="w-screen flex flex-row justify-content-center">
            <div className='navbar'>
                <button onClick={()=>{setSelectedIndex(0)}} className={selectedIndex === 0 ? "button-selected" : "button-unselected"}>INTRODUCTION</button>
                <button onClick={()=>{setSelectedIndex(1)}} className={selectedIndex === 1 ? "button-selected" : "button-unselected"}>EXPERIENCE</button>
                <button onClick={()=>{setSelectedIndex(2)}} className={selectedIndex === 2 ? "button-selected" : "button-unselected"}>EDUCATION</button>
                <button onClick={()=>{setSelectedIndex(3)}} className={selectedIndex === 3 ? "button-selected" : "button-unselected"}>SKILL</button>
                <button onClick={()=>{setSelectedIndex(4)}} className={selectedIndex === 4 ? "button-selected" : "button-unselected"}>PORTFOLIO</button>
            </div>
        </div>
)
}

export default Nav;
