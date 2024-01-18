import React from "react";
import logo from "../../../assets/Logo.webp";
import HeroImg from "../../../assets/Hero.webp";
import HeroPitcureAr from "../../../assets/HeroPitcureAr.webp";
import HeroPitcureEn from "../../../assets/HeroPitcureEn.webp";
import HomeBackground from "../../../assets/HomeBackground.png";
import Ellipse5 from "../../../assets/Ellipse5.png";
import { useTranslation } from "react-i18next";
import Button from "../../../components/Button";
import { Link } from "react-router-dom";
import { useSelector } from "react-redux";
import { HiChevronRight } from "react-icons/hi2";
import image60 from "../../../assets/image60.png";
import image62 from "../../../assets/image62.svg";

const Hero = () => {
  const { t } = useTranslation();
  const Language = useSelector((state) => state.languageMode.languageMode);

  return (
    <section className="active">
      <div class="grid grid-cols-2 gap-4">
        <div className="relative flex flex-col justify-start items-start ms-5">
          <img
            className="w-[20%] h-auto max-w-[20%]"
            src={Ellipse5}
            alt="background"
          />
          <div className="absolute">
            <h3 className="leading-10 text-4xl text-[#000000] mt-5 home-heading">
              Unlock a pathway to attracting more clients without paying
              <span className="text-[#C0D123] ms-1">commissions</span> or
              <span className="text-[#C0D123] flex items-center">
                mandatory subscriptions
                <span className="inline-block ml-2 mt-2">
                  <img src={image60} alt="background" />
                </span>
              </span>
            </h3>
            <h3 className="text-[#342828] text-base mt-4 text-medium">
              Create your website and app with Khardl in minutes,
              <br />
              start selling right away, and pay based on your orders only
            </h3>
            <button
              type="button"
              className="flex items-center text-[#C0D123] bg-[#342828] rounded-md p-3 shadow shadow-[#C0D123] mt-4"
            >
              Start Now
              <span className="ml-2">
                <HiChevronRight />
              </span>
            </button>
            <div className="ml-[20%] mt-2">   <img
            className="w-[8%] h-auto max-w-[5%]"
            src={image62}
            alt="background"
          /></div>
         
          </div>
        </div>

        <div>
          <img
            className="w-[100%] h-auto max-w-[100%]"
            src={HomeBackground}
            alt="background"
          />
        </div>
      </div>
      {/* <div
        className={`px-6 py-10 text-center md:text-right rounded-[30px]`}
        style={{
          backgroundImage: `url(${HeroImg})`,
          backgroundSize: "cover",
        }}
      >
        <div className="grid grid-cols-2 items-center flex-wrap md:gap-x-8 max-[700px]:flex md:px-4 max-[700px]:flex-wrap-reverse">
          <div
            className="flex flex-col items-center justify-center gap-4"
            data-aos="fade-down"
            data-aos-delay="400"
          >
            <div className="mb-4 uppercase transform transition-transform hover:-translate-y-2">
              <Link to="/">
                <img
                  className="w-[100px] max-[100px]:w-[80px] max-[500px]:w-[60px]"
                  src={logo}
                  alt="logo"
                />
              </Link>
            </div>
            <div className="text-[34px] max-[1200px]:text-[22px] max-[500px]:text-[16px] font-bold flex justify-center gap-2 ">
              <h2 className="max-w-[500px] text-center">
                {t("more clients")}
                <span className="text-white">
                  {"\u00A0"}
                  {t("commissions")}
                  <span className="text-black">
                    {"\u00A0"}
                    {t("or")}
                  </span>
                  {"\u00A0"}
                  {t("mandatory subscriptions")}
                </span>
              </h2>
            </div>
            <h2 className="max-w-[500px] text-center text-[18px] max-[500px]:text-[15px] mb-4 ">
              {t("Create your website")}
            </h2>
            <Button
              title={t("Start Now")}
              link="/register"
              classContainer={`!bg-black hover:!bg-[#00000099] !text-[var(--primary)] !border-none !px-[70px] !py-3`}
            />
          </div>
          <div
            className="mb-4 uppercase"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <img
              className="w-[100%] h-auto max-w-[100%]"
              src={Language === "en" ? HeroPitcureEn : HeroPitcureAr}
              alt="logo"
            />
          </div>
        </div>
      </div> */}
    </section>
  );
};

export default Hero;
