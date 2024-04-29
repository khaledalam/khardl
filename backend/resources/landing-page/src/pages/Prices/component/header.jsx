import React from "react";
import { useTranslation } from "react-i18next";

const Header = ({ headerText }) => {
  const { t } = useTranslation();

  return (
    <div className="w-[100%] header max-md:w-[100%]">
      <h1 className="text-center  py-3 rounded-t-2xl font-bold">
        {headerText}
      </h1>
    </div>
  );
};

export default Header;
