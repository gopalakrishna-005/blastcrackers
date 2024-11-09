import React, { useEffect, useState } from 'react';

import './Category.css'
import SideLabel from "../../components/SideLabel";

const Appurl = 'http://127.0.0.1:8000/';


function Category() {

  const [categories, setCategories] = useState([]);
  const [categoryError, setCategoryError] = useState(null);

  useEffect(() => {
    let url = Appurl + 'category/all';
    axios.get(url)
      .then(response => {
          console.log(response.data);
          setCategories(response.data);
      })
      .catch(error => {
          setCategoryError(error.message);
      });
  }, []);


  return (
    <>
      <div>
        <h1 className="sidebar-title">

        </h1>

        {categories && categories.length > 0 && categories.map((category) => (

          <SideLabel key={category.id} item={category}/>

        ))}

      

      </div>
    </>
  )
}

export default Category;