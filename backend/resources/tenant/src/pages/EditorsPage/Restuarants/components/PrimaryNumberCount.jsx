import React, { useCallback, useState } from "react";
import { GoChevronDown, GoChevronUp } from "react-icons/go";

const PrimaryNumberCount = ({ defaultValue, onChange }) => {
  const [number, setNumber] = useState(defaultValue);

  const increment = useCallback(() => {
    setNumber((prev) => prev + 1);
    onChange(number);
  }, [number]);

  const decrement = useCallback(() => {
    setNumber((prev) => prev - 1);
    onChange(number);
  }, [number]);

  return (
    <div className="w-[50%]">
      <div className="btn w-full h-[30px] flex items-center  cursor-pointer justify-between px-2  bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100">
        <span className="font-bold text-[1rem]">{number}</span>
        <span className="">
          <GoChevronUp size={22} onClick={increment} />
          <GoChevronDown size={22} onClick={decrement} />
        </span>
      </div>
    </div>
  );
};

export default PrimaryNumberCount;
