import React from "react";
import { Link } from "react-router-dom";

const Li = ({ link, handleLinkClick, close, title, activeLink, className }) => {
  return (
    <li className="nav-link">
      <Link
        to={link}
        className={`transition-all delay-200 ${activeLink === link ? "active font-bold text-black" : ""} ${className}`}
        onClick={() => {
          handleLinkClick(link);
          close();
        }}
      >
        {title}
      </Link>
    </li>
  );
};

export default Li;
