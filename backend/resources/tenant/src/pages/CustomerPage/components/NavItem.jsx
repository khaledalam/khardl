import React from "react";

const NavItem = ({ active, imgUrl, activeImgUrl, title, onClick }) => {
    return (
        <div
            onClick={onClick}
            className={`${
                active ? "bg-[var(--customer)] w-full rounded-lg" : ""
            } cursor-pointer`}
        >
            <div className="flex items-center gap-3 p-3">
                <img
                    src={active ? activeImgUrl : imgUrl}
                    alt={title}
                    className=""
                />
                <h3
                    className={`text-lg ${
                        active ? "text-white" : "text-black"
                    } font-medium `}
                >
                    {title}
                </h3>
            </div>
        </div>
    );
};

export default NavItem;
