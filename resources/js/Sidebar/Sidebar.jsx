import React from 'react'
import "./Sidebar.css"
import Category from './Category/Category'
import { BsCart4 } from "react-icons/bs";

function Sidebar() {
  return (
    <>
        <section className="sidebar">
            <div className="logo-container">
                <h1>
                    <BsCart4 className='sidebar-icon'/>
                </h1>
            </div>
            <Category />
        </section>
    </>
  )
}

export default Sidebar;
