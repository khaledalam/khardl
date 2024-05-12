import React from "react";
import { useTranslation } from "react-i18next";

const RowTable = ({ points, price, without }) => {
  const { t } = useTranslation();

  return (
    <>
      <div className="w-[100%] content max-md:w-[100%]">
        <div className="text-center items-center  py-3">
          {/* <h1 className='content'>{points} {without ? "" : <>{t("point")}</> }</h1> */}
          <h1 className={"flex justify-center items-center"}>
            {" "}
            <span className="small">{t("SAR")}</span>
            <span className="price">{t("399")}</span>
            <span className="small">{t("/Branch")}</span>
            <span className="text-[#C0D123] ms-2 hover:text-[#C0D123]">
              {t("* Yearly")}
            </span>
          </h1>
        </div>
      </div>
      <div className="w-[100%] content max-md:w-[100%]">
        <div className="text-center items-center  py-3">
          {/* <h1 className='content'>{points} {without ? "" : <>{t("point")}</> }</h1> */}
          <h1 className={"flex justify-center items-center"}>
            {" "}
            <span className="small">{t("SAR")}</span>
            <span className="bold mx-1">{t("0,75")}</span>
            <span className="small">{t("/Order")}</span>
            <span className="text-[#C0D123]  hover:text-[#C0D123] ms-2">
              {t("* Flat")}
            </span>
          </h1>
        </div>
      </div>
    </>
  );
};

export default RowTable;
