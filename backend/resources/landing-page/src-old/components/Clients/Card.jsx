import React, { useState } from "react";
import { Link } from "react-router-dom";

const Card = ({ ClientImage, ClientLink }) => {
  const [, setIsHover] = useState(false);

  const handleMouseEnter = () => {
    setIsHover(true);
  };
  const handleMouseLeave = () => {
    setIsHover(false);
  };

  return (
    <div 
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
      className={`bg-white rounded-lg shadow-[0_-1px_8px_rgba(0,0,0,0.09)] hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center`}>
     <a href={ClientLink}>
      <div className="flex flex-col items-center p-4 px-6">
        <img loading="lazy"  className={`mb-2 w-[100%] h-auto`} src={ClientImage} alt="Bonnieimage"  />
      </div>
      </a>
    </div>
  );
};

export default Card;
