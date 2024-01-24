import React from 'react';
import { Link } from 'react-router-dom';

const Button = ({ title, classContainer, onClick, icon, link }) => {
  return (
    <Link to={link}>
      <button
        onClick={onClick}
        className={``}
      >
        {title}
        {icon}
      </button>
    </Link>
  )
}

export default Button;