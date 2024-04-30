import React, { useEffect, useState } from "react";
import { Helmet } from "react-helmet";
import { useTranslation } from "react-i18next";
import Button from "../../components/Button";
import HeaderSection from "../../components/HeaderSection";
import MainText from "../../components/MainText";
import Cards from "./Components/Cards";
import ContactUs from "../../components/ContactUsSection/ContactUs";
import DeliveryAreaCard from "./Components/DeliveryAreaCard";
import { RiArrowDownDoubleFill } from "react-icons/ri";

function Advantages() {
  const { t } = useTranslation();
  const [Visible, setVisible] = useState(10);
  const showMoreItems = () => {
    setVisible((prevValue) => prevValue + 5);
  };
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    const isMobile = window.innerWidth <= 1000;
    setIsMobile(!isMobile);
  }, []);
  const DeliveryAreas = [
    { Area: `${t("Area 1")}` },
    { Area: `${t("Area 2")}` },
    { Area: `${t("Area 3")}` },
    { Area: `${t("Area 4")}` },
    { Area: `${t("Area 5")}` },
    { Area: `${t("Area 6")}` },
    { Area: `${t("Area 7")}` },
    { Area: `${t("Area 8")}` },
    { Area: `${t("Area 9")}` },
    { Area: `${t("Area 10")}` },
    { Area: `${t("Area 11")}` },
    { Area: `${t("Area 12")}` },
    { Area: `${t("Area 13")}` },
    { Area: `${t("Area 14")}` },
    { Area: `${t("Area 15")}` },
    { Area: `${t("Area 16")}` },
    { Area: `${t("Area 17")}` },
    { Area: `${t("Area 18")}` },
    { Area: `${t("Area 19")}` },
    { Area: `${t("Area 20")}` },
    { Area: `${t("Area 21")}` },
    { Area: `${t("Area 22")}` },
    { Area: `${t("Area 23")}` },
    { Area: `${t("Area 24")}` },
    { Area: `${t("Area 25")}` },
    { Area: `${t("Area 26")}` },
    { Area: `${t("Area 27")}` },
  ];

  return (
    <div>
      <Helmet>
        <title>khardl advantages</title>
        <meta name="description" content="khardl advantages" />
      </Helmet>

      <div className="pt-[80px]">
        <div
          className="  pt-[60px] max-md:px-[5px] max-md:py-[40px] max-w-full md:max-w-[1250px]"
          style={{ margin: "auto" }}
        >
          <HeaderSection title={t("Advantages")} details="" />
        </div>
        <div className="mt-6" data-aos="fade-up" data-aos-delay="400">
          <MainText SubTitle={t("features of Khardl")} />
        </div>
        <div className="flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <section className=" mx-4 md:mx-[100px] max-w-full md:max-w-[1250px] flex flex-col items-center justify-center ">
            <Cards />
          </section>
        </div>
        <div className="">
          {" "}
          <section
            className="max-w-full md:max-w-[1250px] md:mx-[100px] mx-auto"
            style={{ margin: "auto" }}
          >
            <div className="mt-[60px]">
              <div className="  relative">
                <div className="h-16 bg-[#C0D123] w-1/2  absolute right-0"></div>
                <div className="mt-6 pt-4">
                  <MainText Title={t("Geographical coverage areas")} />
                </div>
              </div>
              <div className=" max-[1250px]:mx-[20px]">
                <div className="grid items-center justify-center max-sm:grid-cols-2 max-sm:gap-4 max-md:grid-cols-2  max-lg:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-10 mx-4 mt-8 mb-[50px]">
                  {DeliveryAreas.slice(0, Visible).map((area, index) => (
                    <div
                      key={index}
                      className="flex flex-col items-center justify-center max-sm:gap-4"
                      data-aos="fade-up"
                      data-aos-delay="400"
                    >
                      <DeliveryAreaCard AreaName={area.Area} />
                    </div>
                  ))}
                </div>

                {DeliveryAreas.slice(0, Visible).length ===
                DeliveryAreas.length ? (
                  <div></div>
                ) : (
                  <div
                    className="flex flex-col items-center justify-center cta-btn-more"
                    data-aos="fade-up"
                    data-aos-delay="400"
                  >
                    <button
                      onClick={showMoreItems}
                      className={`flex gap-5 ${
                        !isMobile ? "w-[100%]" : "w-fit"
                      } justify-center cta-btn font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px] hover:bg-[#d6eb16]`}
                    >
                      {t("More")}
                      <RiArrowDownDoubleFill />
                    </button>
                  </div>
                )}
              </div>
            </div>
          </section>
        </div>

        <div className=" flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <ContactUs />
        </div>
      </div>
    </div>
  );
}

export default Advantages;
