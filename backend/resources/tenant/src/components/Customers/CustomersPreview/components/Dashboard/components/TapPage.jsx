import React from "react";

const TapPage = ({ icon, title }) => {
    return (
        <div className="flex justify-between items-center p-2">
            <a className="flex items-center justify-center">
                <div>{icon}</div>
                <span className="mx-3">{title}</span>
            </a>
        </div>
    );
};

export default TapPage;
