import React from 'react'

function Button(category) {
  return (
    <button className="btns">{category.item.name}</button>

  )
}


export default Button;