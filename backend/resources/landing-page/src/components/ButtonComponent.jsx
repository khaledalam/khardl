import React from "react";
import { useNavigate } from "react-router-dom";

const Button = ({ title, classContainer, onClick, icon, link, className }) => {
  const navigate = useNavigate();

  return (
    <button
      onClick={(e) => {
        onClick(e);
        navigate(link);
      }}
      className={className}
    >
      {title} {icon ? <icon /> : null}
    </button>
  );
};

export default Button;
