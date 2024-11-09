import React from 'react'

import { AiFillStar } from "react-icons/ai";
import { BsFillBagHeartFill } from "react-icons/bs";
const Appurl = 'http://127.0.0.1:8000';


function Cards({item}) {
  return (
    <>
      <section className="card" >
          <img src={`${Appurl}/storage/${item.thumbnail}`} alt="shoe" className="card-img" />
          <div className="card-detail">
            <h3 className="card-title">{item.name}</h3>
            <section className="card-reviews">
              
            </section>
            
            <section className="card-price">
              <div className="price">
                <del>${item.previous_price}</del> {item.active_price}
              </div>
              <div className="bag">
                <BsFillBagHeartFill className="bag-icon"/>
              </div>
            </section>
          </div>
        </section>
    </>
  )
}

export default Cards;