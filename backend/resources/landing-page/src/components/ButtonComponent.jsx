import React from "react";
import { Link } from "react-router-dom";

const Button = ({ title, classContainer, onClick, icon, link, className }) => {
  console.log(classContainer, icon, "icon");

  return (
    <Link className={className} to={link}>
      <button onClick={onClick}>
        {title} {icon ? <icon /> : null}
      </button>
    </Link>
  );
};

export default Button;
