import React, { useState } from "react";
import OvalShape from "../../../assets/sa-logo.png";
import OvalShapeHover from "../../../assets/OvalShapeHover.png";

const DeliveryAreaCard = ({ AreaName }) => {
  const [isHovered, setIsHovered] = useState(false);

  return (
    <div
      className={`relative new-delivery-card bg-cover h-[150px] w-[100%] rounded-lg my-1  hover:translate-y-2 ease-in duration-200 flex flex-col items-center pt-10`}
      style={{
        backgroundImage: `url(${isHovered ? OvalShapeHover : OvalShape})`,
        backgroundRepeat: "no-repeat",
        backgroundSize: "contain",
        backgroundPosition: "center",
      }}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      <div className="text-center flex flex-col items-center justify-center gap-3">
        <h2 className="font-bold w-[75%] mt-6">{AreaName}</h2>
      </div>
    </div>
  );
};

export default DeliveryAreaCard;
