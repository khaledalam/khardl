import React from "react";
import logo from "../../../assets/Logo_White.svg";
import HeroImg from "../../../assets/Hero.webp";
import HeroPitcureAr from "../../../assets/HeroPitcureAr.webp";
import HeroPitcureEn from "../../../assets/HeroPitcureEn.webp";
// import HomeBackground from "../../../assets/new-home.png";
import HomeBackground from "../../../assets/new-home_result.webp";
import Ellipse5 from "../../../assets/Ellipse5.png";
import { useTranslation } from "react-i18next";
import Button from "../../../components/Button";
import { Link } from "react-router-dom";
import { useSelector } from "react-redux";
import { HiChevronRight } from "react-icons/hi2";
import image60 from "../../../assets/image60.png";
import image62 from "../../../assets/image62.svg";
import {HiChevronLeft} from "react-icons/hi";

const Hero = () => {
  const { t } = useTranslation();
  const Language = useSelector((state) => state.languageMode.languageMode);
  const direction = localStorage.getItem("i18nextLng") === "en" ? "ltr" : "rtl";
  return (
    <section className="active ">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 items-center ">
        <div className="relative flex flex-col justify-start items-start md:items-center custom-round-bg">
          <div className="md:relative">
            <h3 className="leading-10 text-4xl text-[#000000] mt-5 home-heading">
              {t("Unlock a pathway to")}

              <span className="text-[#C0D123] ms-1">
                {t("commissions")}
              </span>{" "}
              {t("or")}
              <span className="text-[#C0D123] flex items-center">
                {t("mandatory subscriptions")}
                <span className="inline-block ml-2 mt-2">
                  <img src={image60} alt="background" />
                </span>
              </span>
            </h3>
            <h3 className="text-[#342828] text-base mt-4 text-medium mt-11">
              {t("Create your website")}
              <br />
              {t("start selling right away,")}{" "}
            </h3>
            <Link to="/register">
              <button
                type="button"
                className="flex cta-btn mt-11 items-center text-[#C0D123] bg-[#342828] rounded-md p-3 shadow-2xl shadow-[#C0D123] mt-4 hover:bg-[#C0D123] hover:text-black"
              >
                {t("Start Now")}
                <span className="ml-2">
                  {Language == 'en' ? <HiChevronRight /> : <HiChevronLeft />}
                </span>
              </button>
            </Link>
            <div className="md:ml-0 md:mt-2">
              <img
                className={`h-auto  curly-arrow ${direction == "rtl" ? "rtl" : ""}`}
                src={image62}
                alt="background"
              />
            </div>
          </div>
        </div>

        <div>
          <img
            className="w-full h-auto max-w-full"
            src={HomeBackground}
            alt="background"
          />
        </div>
      </div>
    </section>
  );
};

export default Hero;
