import React from "react";
import OvalShape from '../../../assets/OvalShape.webp';

const DeliveryAreaCard = ({ AreaName }) => {
    return (
        <div
            className={`relative max-sm:h-[145px] max-sm:w-[135px] bg-cover h-[220px] w-[210px] rounded-lg my-1 px-4 py-8 max-[600px]:py-12 hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center`}
            style={{backgroundImage: `url(${OvalShape})`}}>
            <div className="text-center flex flex-col items-center justify-center gap-3">
                <h2 className="font-bold max-sm:text-[14px]">{AreaName}</h2>
            </div>
        </div>
    );
};

export default DeliveryAreaCard;
