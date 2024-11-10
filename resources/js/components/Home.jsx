import React from "react";
import { createRoot } from "react-dom/client";
import Navigation from "../Navigation/Nav";
import Products from "../Products/Products";
import Recommended from "../Recommended/Recommended";
import Sidebar from "../Sidebar/Sidebar";
import OtpLogin from "./OtpLogin";



export default function Home(){
    
    return( 
        <>
            {/* <Sidebar />
            <Navigation/>
            <Recommended />
            <Products /> */}

            <OtpLogin />
        </>
    )
}

const root = createRoot(document.getElementById('app'));
root.render(<Home/>)