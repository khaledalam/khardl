// Dropdown.js

import { t } from "i18next";
import React, { useState } from "react";
import { IoChevronDownSharp } from "react-icons/io5";

const PricesDropdown = () => {
  const [isOpen, setIsOpen] = useState(false);

  const toggleDropdown = () => {
    setIsOpen(!isOpen);
  };

  return (
    <div className="relative inline-block text-left">
      <button
        type="button"
        onClick={toggleDropdown}
        className="inline-flex justify-center w-[100%] rounded-full
        border border-gray-300 shadow-sm px-4 py-2 bg-[#000000] text-sm font-medium text-[#C0D123] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        id="dropdown"
        aria-haspopup="true"
        aria-expanded="true"
      >
        Monthly
        <IoChevronDownSharp />
      </button>

      {isOpen && (
        <div
          className="origin-top-right absolute  mt-2 w-50 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="options-menu"
        >
          <div className="py-1" role="none">
            <a
              href="#"
              className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
              role="menuitem"
            >
              Option 1
            </a>
            <a
              href="#"
              className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
              role="menuitem"
            >
              Option 2
            </a>
            <a
              href="#"
              className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
              role="menuitem"
            >
              <div className="mt-2 flex justify-between items-start gap-6 min-w-[250px]">
                <p>{t("12 months")}</p>
                <p>
                  <span className="price">{1299}</span>
                  <span className="small">{t("SAR")}</span>
                </p>
              </div>
            </a>
          </div>
        </div>
      )}
    </div>
  );
};

export default PricesDropdown;
