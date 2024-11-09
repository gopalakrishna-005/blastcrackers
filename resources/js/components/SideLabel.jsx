import React from 'react'

function SideLabel(category) {
  return (
    <label className="sidebar-label-container">
          <input type="radio" name="test" />
          <span className='checkmark'></span> {category.item.name}
    </label>

  )
}


export default SideLabel;