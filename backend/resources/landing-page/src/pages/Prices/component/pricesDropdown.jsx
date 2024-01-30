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
        border border-[#C0D123] shadow-sm px-4 py-2 bg-[#000000] text-sm font-medium text-[#C0D123] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        id="dropdown"
        aria-haspopup="true"
        aria-expanded="true"
      >
        Monthly
        <IoChevronDownSharp />
      </button>

      {isOpen && (
        <div
          className="origin-top-right absolute  mt-2 w-50 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none border border-solid border-[#C0D123]"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="options-menu"
        >
          <div className="py-1" role="none">
            <a
              href="#"
              className="block px-4  text-sm text-[#C0D123] hover:bg-[#000000] hover:text-[#C0D123] hover:border border-[#C0D123]"
              role="menuitem"
            >
              <div className="mt-2 flex justify-between items-start gap-4 min-w-[195px]">
                <p>{t("Monthly")}</p>
                <p>
                  <span className="text-[10px]">{t("SAR")}</span>
                  <span className="mt-2">{299}</span>
                </p>
              </div>
            </a>
            <a
              href="#"
              className="block px-4  text-sm text-[#C0D123] hover:bg-[#000000] hover:text-[#C0D123] hover:bg-[#0000] hover:border border-[#C0D123]"
              role="menuitem"
            >
              <div className="mt-2 flex justify-between items-start gap-6 min-w-[195px]">
                <p>{t("3 months")}</p>
                <p>
                  <span className="text-[10px]">{t("SAR")}</span>
                  <span className="mt-2">{499}</span>
                </p>
              </div>
            </a>
            <a
              href="#"
              className="block px-4 text-sm text-[#C0D123] hover:bg-[#000000] hover:text-[#C0D123] hover:bg-[#0000] hover:border border-[#C0D123]"
              role="menuitem"
            >
              <div className="mt-2 flex justify-between items-start gap-6 min-w-[195px]">
                <p>{t("6 months")}</p>
                <p>
                  <span className="text-[10px]">{t("SAR")}</span>
                  <span className="mt-2">{1299}</span>
                </p>
              </div>
            </a>
            <a
              href="#"
              className="block px-4  text-sm text-[#C0D123] hover:bg-[#000000] hover:text-[#C0D123] hover:bg-[#0000] hover:border border-[#C0D123]"
              role="menuitem"
            >
              <div className="mt-2 flex justify-between items-start gap-6 min-w-[195px]">
                <p>{t("12 months")}</p>
                <p>
                  <span className="text-[10px]">{t("SAR")}</span>
                  <span className="mt-2">{1299}</span>
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
