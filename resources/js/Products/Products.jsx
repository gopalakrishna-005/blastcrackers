import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './Products.css';
import Cards from "../components/Cards";
import data from "../../db/data.json";
const Appurl = 'http://127.0.0.1:8000/';


function Products() {
  console.log('afalsfj')
  // return (
  //   <>
  //     <section className="card-container">
  //     {data.map((item) => (

  //       <Cards key={item.id} item={item}/>

  //     ))}
  //     </section>
  //   </>
  // )

  const [data, setData] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    let url = Appurl + 'product/all';
    axios.get(url)
      .then(response => {
        console.log(response.data);
        setData(response.data);
      })
      .catch(error => {
        setError(error.message);
      });
  }, []);

  return (
    <>
      <section className="card-container">
      {data.map((item) => (

        <Cards key={item.id} item={item}/>

      ))}
      </section>
    </>
  );
}

export default Products;
