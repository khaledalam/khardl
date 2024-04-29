import React, { Fragment, useCallback, useState } from "react";

const CategoryAlign = ({ label, defaultValue, onChange }) => {
  const [activeTab, setActiveTab] = useState(defaultValue);
  const btnList = [
    {
      id: "Stack",
      value: "stack",
      name: "Stack",
    },
    {
      id: "Grid",
      value: "grid",
      name: "Grid",
    },
  ];

  const handleActiveTab = useCallback((value) => {
    setActiveTab(value);
    onChange(value);
  }, []);

  return (
    <div className="">
      {label && (
        <label className="text-[14px] font-normal text-neutral-700">
          {label}
        </label>
      )}
      <div className="bg-neutral-100 p-2 w-[70%] mt-3 flex items-center justify-between rounded-2xl">
        {btnList.map((item, idx) => (
          <Fragment key={item.id}>
            <button
              className={`btn w-[42%] h-[30px]  ${
                item.value === activeTab
                  ? " bg-white hover:bg-white"
                  : "bg-neutral-100 hover:bg-neutral-100 text-neutral-300"
              }`}
              onClick={() => handleActiveTab(item.value)}
            >
              {item.name}
            </button>
            {idx === 0 && <div className="h-8 w-[2px] bg-neutral-400"></div>}
          </Fragment>
        ))}
      </div>
    </div>
  );
};

export default CategoryAlign;
