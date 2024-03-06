import React from "react";
import { useTranslation } from "react-i18next";
import { Helmet } from "react-helmet";
import MainText from "../../components/MainText";
import HeaderSection from "../../components/HeaderSection";
import ContactUs from "../../components/ContactUsSection/ContactUs";
import PricesTable from "./component/pricesTable";

function Prices() {
  const { t } = useTranslation();

  return (
    <div>
      <Helmet>
        <title>khardl Prices</title>
        <meta name="description" content="khardl Prices" />
      </Helmet>

      <div className="pt-[80px]">
        <div className="pt-[60px] max-md:px-[5px] max-md:py-[40px] max-w-full md:max-w-[1250px]" style={{margin:'auto'}}>
          <HeaderSection
            title={t("Prices")}
            details=""
          />
        </div>
        <div className="mt-22 mb-[130px]">
          <div className="mt-6" data-aos="fade-up" data-aos-delay="400">
            <MainText SubTitle={t("Khardl's services Details")} />
          </div>
          <div className="mx-[160px] max-[1250px]:mx-[20px] mt-[30px] max-w-full md:max-w-[1250px] " style={{margin:'auto'}}>
            <PricesTable />
          </div>
        </div>
        <div className=" flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <ContactUs />
        </div>
      </div>
    </div>
  );
}

export default Prices;
