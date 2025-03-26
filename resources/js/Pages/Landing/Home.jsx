import { useState } from "react";
import Navbar from "@/Components/Navbar";
import Welcome from "./HomeSection/Welcome";
import Experience from "./HomeSection/Experience";
import Skills from "./HomeSection/Skills";
import Portfolio from "./HomeSection/Portfolio";


const Home = ()=>{
    return (
    <div className="" style={{backgroundColor:"#F7F5F3"}}>
        <div>
            <Navbar></Navbar>
        </div>
        <div>
            <Welcome></Welcome>
            <Experience></Experience>
            <Skills></Skills>
            <Portfolio></Portfolio>
        </div>
    </div>
)
}

export default Home;
