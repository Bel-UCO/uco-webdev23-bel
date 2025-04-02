import { useState } from "react";
import '../../css/home.css';



const Nav = ({selectedIndex,setSelectedIndex,scrollToWelcome,scrollToExperience, scrollToEducation, scrollToSkills, scrollToPortfolio})=>{

    return (
    <div className='navbar flex md:flex-row'>
        <button onClick={()=>{setSelectedIndex(0);scrollToWelcome();}} className={selectedIndex === 0 ? "button-selected" : "button-unselected"}>INTRODUCTION</button>
        <button onClick={()=>{setSelectedIndex(1); scrollToExperience()}} className={selectedIndex === 1 ? "button-selected" : "button-unselected"}>EXPERIENCE</button>
        <button onClick={()=>{setSelectedIndex(2); scrollToEducation()}} className={selectedIndex === 2 ? "button-selected" : "button-unselected"}>EDUCATION</button>
        <button onClick={()=>{setSelectedIndex(3); scrollToSkills()}} className={selectedIndex === 3 ? "button-selected" : "button-unselected"}>SKILL</button>
        <button onClick={()=>{setSelectedIndex(4); scrollToPortfolio()}} className={selectedIndex === 4 ? "button-selected" : "button-unselected"}>PORTFOLIO</button>
    </div>
)
}

export default Nav;
