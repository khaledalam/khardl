import React from "react";
import { Link } from "react-router-dom";
const Button = ({ title, classContainer, onClick, icon, link }) => {
  console.log(classContainer, icon, "icon");

  return (
    <Link to={link}>
      <button onClick={onClick} className={``}>
        {title} {icon ? <icon /> : null}
      </button>
    </Link>
  );
};

export default Button;
