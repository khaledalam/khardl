import React from "react";
import {
  HiOutlineArrowTrendingUp,
  HiOutlineArrowTrendingDown,
} from "react-icons/hi2";
import { useSelector } from "react-redux";

const StatsCard = ({ title, Stats, ShowIcons, IsUp }) => {
  const GlobalColor = useSelector((state) => state.button.GlobalColor);
  const GlobalShape = useSelector((state) => state.button.GlobalShape);

  return (
    <div className="flex flex-col justify-between max-w-sm py-2 bg-white rounded-md shadow-md">
      <h5 className="mb-2 text-md tracking-tight text-[var(--Forth)] px-4">
        {title}
      </h5>
      <hr />
      <div className="flex justify-between items-center flex-wrap  px-4 py-2">
        <p className="text-center text-gray-700 font-bold text-[27px]">
          {Stats}
        </p>
        {/* {ShowIcons && (
          <div>
            {IsUp ? (
              <HiOutlineArrowTrendingUp
                className={`text-2xl mx-1`}
                style={{ color: "green" }}
              />
            ) : (
              <HiOutlineArrowTrendingDown
                className={`text-2xl mx-1`}
                style={{ color: "red" }}
              />
            )}
          </div>
        )} */}
      </div>
    </div>
  );
};

export default StatsCard;
