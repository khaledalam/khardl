import React from "react";
import { useDispatch, useSelector } from "react-redux";
import { FiEye } from "react-icons/fi";
import { setIdOrder } from "../../../../../../redux/editor/idOrderSlice";
import { setOrderShow } from "../../../../../../redux/editor/orderShowSlice";
import { setActiveTab } from "../../../../../../redux/editor/dashboardTabSlice";

function Statusbutton({ id }) {
    const dispatch = useDispatch();
    const GlobalColor = useSelector((state) => state.button.GlobalColor);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);
    const handleOrderClick = (stutes) => {
        dispatch(setOrderShow(stutes));
    };

    const handleIdOrderClick = (IdOrder) => {
        dispatch(setIdOrder(IdOrder));
    };

    const handleTabClick = (tabName) => {
        dispatch(setActiveTab(tabName));
    };
    return (
        <div className="w-[100%]">
            <button
                style={{
                    color: GlobalColor,
                    border: `1px solid ${GlobalColor}`,
                    borderRadius: GlobalShape,
                }}
                className="bg-[var(--secondary)] flex items-center justify-center text-center w-fit text-[var(--primary)] border border-[var(--primary)] cursor-pointer rounded-full p-2"
                onClick={() => {
                    handleOrderClick(true);
                    handleIdOrderClick(id);
                    handleTabClick("Orders");
                }}
            >
                <FiEye size={14} />
            </button>
        </div>
    );
}

export default Statusbutton;
