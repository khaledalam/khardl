import React from "react";
import { useTranslation } from "react-i18next";
import { BsSearch } from "react-icons/bs";

const PrimaryOrderSearch = ({ value, onChange }) => {
  const { t } = useTranslation();
  return (
    <div className="group w-full p-4 mx-auto flex flex-row h-10 bg-neutral-100 rounded-2xl border border-neutral-700 items-center cursor-pointer ">
      <div className="flex items-center rounded-full">
        <BsSearch />
      </div>
      <input
        placeholder={t("Search by shipping address")}
        id="search-input"
        name="search-input"
        value={value}
        onChange={onChange}
        className="input w-full bg-transparent border-none hover:border-none outline-none focus-visible:border-none focus-visible:outline-none p-2 text-sm placeholder:text-neutral-500 h-fit text-neutral-900"
      />
    </div>
  );
};

export default PrimaryOrderSearch;
