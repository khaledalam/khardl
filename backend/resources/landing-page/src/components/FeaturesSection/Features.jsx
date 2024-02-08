import React, { useEffect, useState } from "react";
import MainText from "../MainText";
import { useTranslation } from "react-i18next";
import driversApp from "../../assets/image8.svg";
import receiveRequests from "../../assets/image10.svg";
import KhardlDelivery from "../../assets/image9.svg";
import ElectronicPayments from "../../assets/image11.svg";
import WebsiteAndApplication from "../../assets/image7.svg";
import Card from "./Card";
import { HiChevronRight } from "react-icons/hi";
import Group9 from "../../assets/Group9.png";
import Group7 from "../../assets/Group7.png";
import Line1 from "../../assets/Line1.png";
import { Link } from "react-router-dom";

function FeaturesSection() {
  const { t } = useTranslation();
  const Features = [
    {
      image: WebsiteAndApplication,
      title: `${t("Website and application design")}`,
      details: `${t("Website and application design Details")}`,
    },
    {
      image: driversApp,
      title: `${t("Drivers App")}`,
      details: `${t("Drivers App Details")}`,
    },
    {
      image: KhardlDelivery,
      title: `${t("Khardl delivery")}`,
      details: `${t("Khardl delivery Details")}`,
    },
    {
      image: receiveRequests,
      title: `${t("Receive Requests")}`,
      details: `${t("Receive Requests Details")}`,
    },
    {
      image: ElectronicPayments,
      title: `${t("Electronic payments")}`,
      details: `${t("Electronic payments Details")}`,
    },
  ];
  const [isMobile, setIsMobile] = useState(false);
  useEffect(() => {
    const isMobile = window.innerWidth <= 1000;
    setIsMobile(!isMobile);
  }, []);
  return (
    <>
      <section className="mx-4 md:mx-[100px] max-w-full md:max-w-[1250px] flex flex-col items-center justify-center ">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div className="flex flex-col justify-start items-start">
            <div className="flex items-center">
              <img
                className="h-6 md:h-[30%] m-2"
                src={Line1}
                alt="background"
              />
              <h3 className="feature-heading text-2xl md:text-4xl">
                {t("Learn about")} <span>{t("Khardl's services")}</span>
              </h3>
            </div>

            <h3 className="text-[#342828] mt-4 text-md md:text-lg feature-description mr-11">
              {t("Khardl's services Details")}
            </h3>
            <img
              className="w-full h-auto max-w-full md:max-w-[90%] mt-11 hide-on-mobile"
              src={Group9}
              alt="background"
            />
          </div>

          <div className="mt-5 max-w-full ">
            {Features.map((card) => (
              <div
                key={card.id}
                className="feature-list-box p-4 w-full md:w-[1/2] lg:w-[1/3] xl:w-[1/4] lg:ml-[20%] mb-11 flex flex-col md:flex-row items-center"
              >
                <div className="w-full md:w-[50%] mb-4 md:mb-0 flex items-center justify-center">
                  <img
                    className="w-[20%] h-auto max-w-[20%]"
                    // style={{ width: "20%" }}
                    src={card.image}
                    alt="background"
                  />
                </div>
                <div className="ml-0 " style={{ width: "300px" }}>
                  <h3 className="text-[#000000] card-heading">{card.title}</h3>
                  <h3 className="text-[#342828] text-medium">{card.details}</h3>
                </div>
              </div>
            ))}
          </div>
        </div>
        <div className={`relative ${!isMobile ? "hidden" : "block"} `}>
          <img
            className="w-[100%] h-auto max-w-[100%]"
            src={Group7}
            alt="background"
          />
          <div className="absolute flex items-center flex-col feature-section-green top-1/2 left-1/2 transform -translate-x-1/2 text-center justify-center">
            <h3 className="text-[#000000] mb-5">
              {t(
                "You can design your website or application independently, with no requirement for communication"
              )}
            </h3>

            <Link
              to="/register"
              className="cta-btn w-[50%]  flex items-center justify-center text-[#C0D123] bg-[#342828] rounded-md p-3 shadow shadow-[#C0D123] mt-2 hover:bg-[#C0D123] hover:text-black"
            >
              {t("From Here")}
              <span className="ml-2">
                <HiChevronRight />
              </span>
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}

export default FeaturesSection;
