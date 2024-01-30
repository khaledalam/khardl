
import React from 'react';
import { Link } from 'react-router-dom';

const Li = ({ link, handleLinkClick, close, title, activeLink, className }) => {
  return (
    <li className="nav-link">
      <Link to={link}
        className={`transition-all delay-200 header-link ${activeLink === link ? 'active text-[#C0D123] border-b-2 border-[#C0D123]' : ''} ${className}` }
        onClick={() => { handleLinkClick(link); close(); }}>
        {title}
      </Link>
    </li>
  );
}

export default Li;
