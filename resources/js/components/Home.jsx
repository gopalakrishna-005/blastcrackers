import React from "react";
import { createRoot } from "react-dom/client";
import Navigation from "../Navigation/Nav";
import Products from "../Products/Products";
import Recommended from "../Recommended/Recommended";
import Sidebar from "../Sidebar/Sidebar";



export default function Home(){
    
    return( 
        <>
            <Sidebar />
            <Navigation/>
            <Recommended />
            <Products />
        </>
    )
}

const root = createRoot(document.getElementById('app'));
root.render(<Home/>)