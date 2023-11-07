import React from 'react';
import { Link } from 'react-router-dom';

const Button = ({ title, classContainer, onClick, icon, link }) => {
  return (
    <Link to={link}>
      <button
        onClick={onClick}
        className={`font-bold border-[1px] border-black bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6 w-fit ${classContainer}`}
      >
        {title}
        {icon}
      </button>
    </Link>
  )
}

export default Button;