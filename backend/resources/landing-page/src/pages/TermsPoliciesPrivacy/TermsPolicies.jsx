import React from 'react';
import ContactUsCover from '../../assets/ContactUsCover.webp';
import "./style.css"

const TermsPolicies = () => {

    return (
        <div className="flex justify-center items-center px-[40px] max-[400px]:px-[20px]"
            style={{
                backgroundImage: `url(${ContactUsCover})`,
                backgroundSize: "cover",
            }}>
            <div className="relative flex flex-col justify-center items-center my-[80px] xl:max-w-[60%] max-[1200px]:w-[90%]  space-y-14 shadow-lg bg-white p-8 max-[860px]:p-4 rounded-lg">
               
            </div>
        </div>
    );
};

export default TermsPolicies;
