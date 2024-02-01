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
import Group11 from "../../assets/Group11.png";
import Group12 from "../../assets/Group12.png";
import Group13 from "../../assets/Group13.png";
import Rectangle from "../../assets/Rectangle.png";
import ServicesButton from "./ServicesButton";
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
  const direction = localStorage.getItem("i18nextLng") === "en" ? "ltr" : "rtl";
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
          <img
            src={Rectangle}
            className="absolute right-[40%] mt-4 md:right-[40%]"
            alt=""
          ></img>
        </div>
        <div className="mt-22 mb-[130px]">
          <div className="mt-6" data-aos="fade-up" data-aos-delay="400">
            <MainText SubTitle={t("Khardl's services Details")} />
          </div>
          {/* <div className="mx-[160px] max-[1250px]:mx-[20px]"> */}
          <div className="pt-[80px]">
            <section className="mx-auto max-w-full md:max-w-[1250px]">
              <div
                className="services-img"
                data-aos="fade-up"
                data-aos-delay="400"
                style={{
                  backgroundImage: `url(${Group12})`,
                  marginRight: direction == 'rtl' ? 'auto' : ''
                }}
              >
                <div className="services-content justify-center md:items-end items-end">
                  <p className="text-[#000000] md:mt-[18%] mt-0 md:text-center text-left">
                    {t("Receive Requests")} <br />
                    {/* <ServicesButton text={t("Free")}  /> */}
                  </p>
                </div>
              </div>

              <div
                className="ml-auto mr-0 services-img"
                data-aos="fade-up"
                data-aos-delay="400"
                style={{
                  backgroundImage: `url(${Group11})`,
                 
                }}
              >
                <div className="services-content justify-center items-end md:items-center mt-3">
                  <p className="text-[#000000] md:mt-8 mt-0 md:text-center text-left">
                  {t("Drivers App")} <br />
                    {/* <ServicesButton text={t("Free")}  /> */}
                  </p>
                </div>
              </div>
              <div
                className="services-img"
                data-aos="fade-up"
                data-aos-delay="400"
                style={{
                  backgroundImage: `url(${Group13})`,
                  
                  marginRight: direction == 'rtl' ? 'auto' : ''
                }}
              >
                <div className="services-content justify-center items-end md:items-center">
                  <p className="text-[#000000] md:mt-14 mt-0 md:text-center text-left">
                    {t("Each Branch")} <br />
                    {/* <ServicesButton text={t("Free")} /> */}
                  </p>
                </div>
              </div>
            </section>
          </div>
          <div
            className="flex justify-center register-btn py-10 my-16"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <Button
              title={t("Register now")}
              classContainer="!w-fit !border-none px-12"
              link="/register"
            />
          </div>
          <hr className="w-[500px] register-hr max-[1200px]:w-[90%]" />
        </div>
        <div className=" flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <ContactUs />
        </div>
      </div>
    </div>
  );
}

export default Services;
