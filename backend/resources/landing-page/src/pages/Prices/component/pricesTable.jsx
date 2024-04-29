import React from "react";
import Header from "./header";
import Footer from "./footer";
import RowTable from "./rowTable";
import { useTranslation } from "react-i18next";
import { FaStarOfLife } from "react-icons/fa";
import PricesDropdown from "./pricesDropdown";
import checkboxImg from "../../../assets/checkboxImg.png";
import Ellipse from "../../../assets/Ellipse.png";
import { Link } from "react-router-dom";

function PricesTable() {
  const { t } = useTranslation();

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 h-[100%]  my-[80px] w-[100%]">
      <div className="flex flex-col items-center w-[100%] flex-grow">
        <div className="price-box h-[100%] hover:bg-[#000] mt-10">
          <Header headerText={t("Website")} />
          <div className="flex flex-col items-center justify-start my-6">
            <RowTable without />
          </div>
          <div className="flex justify-start items-center ms-2 gap-2 text-start mt-1">
            {/* <img src={checkboxImg} alt=""></img>
            <h2 className="text-[16px] text-[#8B8B8B]">{t("Includes VAT")}</h2> */}
          </div>
          <Footer FooterText={t("Includes VAT")} />
          <div
            style={{
              display: "flex",
              justifyContent: "center",
              marginTop: "85px",
            }}
          >
            <Link to="/register">
              <button className="p-[10px] flex px-[30px] bg-[#C0D123] text-[#000000] rounded-lg">
                {t("Get Started")}
              </button>
            </Link>
          </div>
        </div>
      </div>
      <div className="flex flex-col items-center w-[100%] flex-grow h-[100%]">
        <div className="price-box h-[100%]  hover:bg-[#000] mt-10">
          <Header headerText={t("Applications")} />
          <div className="content w-[100%] max-md:w-[100%]">
            <div className="flex flex-col items-center justify-start my-6">
              <p className="font-bold content text-[16px]">
                {t("Customer Application")}
              </p>
              <div className="flex justify-start items-center gap-2 text-start mt-1">
                <FaStarOfLife size={10} className="text-[#8AD123]" />
                <h3 className="text-[12px] text-[#8AD123]">{t("Devices")}</h3>
              </div>
              <div className="flex flex-col items-start justify-start text-start">
                <div className="mt-4 flex justify-between items-start gap-4 min-w-[150px]">
                  <p>
                    <span className="small">{t("SAR")}</span>
                    <span className="price">{1399}</span>
                  </p>
                  <span className="text-[#C0D123] ms-2 hover:text-[#C0D123]">
                    {t("* Yearly")}
                  </span>
                  {/*<PricesDropdown />*/}
                </div>
              </div>
            </div>
          </div>
          <div className="content w-[100%] max-md:w-[100%]">
            <div className="flex flex-col items-center justify-start my-6">
              <div className="flex justify-start items-center gap-2 text-start mt-1">
                {/* <img src={checkboxImg} alt=""></img>
                <h2 className="text-[16px] text-[#8B8B8B]">{t("Devices2")}</h2> */}
              </div>
              <div>
                <div className="flex justify-start items-center gap-2 text-start mt-1">
                  <img src={Ellipse} alt=""></img>
                  <h3 className="text-[#C0D123]">
                    {t("Free for Orders Application")}
                  </h3>
                </div>
                <div className="flex justify-start items-center gap-2 text-start mt-1">
                  <img src={Ellipse} alt=""></img>
                  <h3 className="text-[#C0D123]">
                    {t("Free for Driver's Application")}
                  </h3>
                </div>
              </div>
              <div className="ms-4">
                <div className="flex justify-start items-center gap-2 text-start mt-1">
                  {/* <img src={checkboxImg} alt=""></img>
                  <h2 className="text-[16px] text-[#8B8B8B]">{t("Includes VAT")}</h2> */}
                </div>
              </div>
            </div>
          </div>

          <Footer FooterText={t("Includes VAT")} />
          <div style={{ display: "flex", justifyContent: "center" }}>
            <Link to="/register">
              <button className="p-[10px] flex px-[30px] bg-[#C0D123] hover:shadow text-[#000000] rounded-lg">
                {t("Get Started")}
              </button>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}

export default PricesTable;
