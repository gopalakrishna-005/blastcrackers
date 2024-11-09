import React, { useEffect, useState } from 'react';


import './Recommended.css'
import Button from "../components/Button";

const Appurl = 'http://127.0.0.1:8000/';


function Recommended() {

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
      <div className="recommended-title">Recommended</div>
      <div className="recommended-flex">
        {categories && categories.length > 0 && categories.map((category) => (

          <Button key={category.id} item={category}/>

        ))}

      </div>
    </>
  )
}

export default Recommended;
