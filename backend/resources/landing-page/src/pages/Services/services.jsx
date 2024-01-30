import React from "react";
import { useTranslation } from "react-i18next";
import { Helmet } from "react-helmet";
import MainText from "../../components/MainText";
import driversApp from "../../assets/driversApp.webp";
import Branches from "../../assets/Branches.webp";
import receiveRequests from "../../assets/receiveRequests.webp";
import HeaderSection from "../../components/HeaderSection";
import ContactUs from "../../components/ContactUsSection/ContactUs";
import Card from "../../components/FeaturesSection/Card";
import Button from "../../components/Button";
import service1 from "../../assets/services1.png";
import service2 from "../../assets/services2.png";
import service3 from "../../assets/services3.png";
import Rectangle from "../../assets/Rectangle.png";
function Services() {
  const { t } = useTranslation();
  const Features = [
    {
      image: receiveRequests,
      title: `${t("Receive Requests")}`,
      Price: `${t("Receive Requests Price")}`,
      Device: `${t("Devices")}`,
    },
    {
      image: driversApp,
      title: `${t("Drivers App")}`,
      Price: `${t("Drivers App Price")}`,
      Device: `${t("Devices")}`,
    },
    {
      image: Branches,
      title: `${t("Each Branch")}`,
      Price: 388,
    },
  ];
  const Fees = [
    {
      title: `${t("Monthly")}`,
      Price: 299,
    },
    {
      title: `${t("3 months")}`,
      Price: 499,
    },
    {
      title: `${t("6 months")}`,
      Price: 799,
    },
    {
      title: `${t("12 months")}`,
      Price: 1299,
    },
  ];
  return (
    <div>
      <Helmet>
        <title>Khardl Services</title>
        <meta name="description" content="khardl services" />
      </Helmet>

      <div className="pt-[80px]">
        <div className="flex items-center justify-center h-[120px]">
          <img src={Rectangle} className="absolute left-[40%]" alt=""></img>
          <h2 className="services-heading z-10 relative">{t("Services")}</h2>
          <img src={Rectangle} className="absolute right-[40%] mt-4" alt=""></img>
        </div>
        <div className="mt-22 mb-[130px]">
          <div className="mt-6" data-aos="fade-up" data-aos-delay="400">
            <MainText SubTitle={t("Khardl's services Details")} />
          </div>
          <div className="mx-[160px] max-[1250px]:mx-[20px]">
            <div data-aos="fade-up" data-aos-delay="400">
              <img src={service1} />
            </div>
            <div
              className="py-10 my-16"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <img src={service2} className="ml-auto" />
            </div>
            <div data-aos="fade-up" data-aos-delay="400">
              <img src={service3} />
            </div>
          </div>
          <div
            className="flex justify-center register-btn py-10 my-16"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <Button
              title={t("Register now")}
              classContainer="!w-fit !border-none px-12"
              link="/login"
            />
          </div>
          <hr className="w-[500px] register-hr" />
        </div>
        <div className=" flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <ContactUs />
        </div>
      </div>
    </div>
  );
}

export default Services;
