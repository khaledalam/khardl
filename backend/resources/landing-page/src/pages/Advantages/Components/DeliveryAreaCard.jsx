import React from "react";
import OvalShape from '../../../assets/sa-logo.png';

const DeliveryAreaCard = ({ AreaName }) => {
    return (
        <div
            className={`relative new-delivery-card   bg-cover h-[150px] w-[100%] rounded-lg my-1  hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center`}
            style={{backgroundImage: `url(${OvalShape})`,backgroundRepeat: 'no-repeat', backgroundSize:'contain'}}>
            <div className="text-center flex flex-col items-center justify-center gap-3">
                <h2 className="font-bold">{AreaName}</h2>
            </div>
        </div>
    );
};

export default DeliveryAreaCard;
