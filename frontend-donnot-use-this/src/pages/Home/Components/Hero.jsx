import React from "react";
import logo from "../../../assets/Logo.webp";
import HeroImg from '../../../assets/Hero.webp';
import HeroPitcureAr from '../../../assets/HeroPitcureAr.webp';
import HeroPitcureEn from '../../../assets/HeroPitcureEn.webp';
import { useTranslation } from "react-i18next";
import Button from '../../../components/Button';
import { Link } from "react-router-dom";
import { useSelector } from "react-redux";

const Hero = () => {
  const { t } = useTranslation();
  const Language = useSelector((state) => state.languageMode.languageMode);

  return (
    <section className="active text-center mx-[160px] max-[1250px]:mx-[20px]">
      <div className={`px-6 py-10 text-center md:text-right rounded-[30px]`}
        style={{
          backgroundImage: `url(${HeroImg})`,
          backgroundSize: "cover",
        }}>
        <div className="grid grid-cols-2 items-center flex-wrap md:gap-x-8 max-[700px]:flex md:px-4 max-[700px]:flex-wrap-reverse">
          <div className="flex flex-col items-center justify-center gap-4"
            data-aos='fade-down'
            data-aos-delay='400'>
            <div className="mb-4 uppercase transform transition-transform hover:-translate-y-2" >
              <Link to='/'>
                <img className="w-[100px] max-[100px]:w-[80px] max-[500px]:w-[60px]" src={logo} alt="logo" />
              </Link>
            </div>
            <div className="text-[34px] max-[1200px]:text-[22px] max-[500px]:text-[16px] font-bold flex justify-center gap-2 ">
              <h2 className="max-w-[500px] text-center">
                {t("more clients")}
                <span className="text-white">
                  {"\u00A0"}{t("commissions")}
                  <span className="text-black">{"\u00A0"}{t("or")}</span>
                  {"\u00A0"}{t("mandatory subscriptions")}
                </span>
              </h2>
            </div>
            <h2 className="max-w-[500px] text-center text-[18px] max-[500px]:text-[15px] mb-4 ">
              {t("Create your website")}
            </h2>
            <Button title={t("Start Now")} link="/register" classContainer={`!bg-black hover:!bg-[#00000099] !text-[var(--primary)] !border-none !px-[70px] !py-3`} />
          </div>
          <div className="mb-4 uppercase"
            data-aos='fade-up'
            data-aos-delay='400'>
            <img className="w-[100%] h-auto max-w-[100%]" src={Language === "en" ? HeroPitcureEn : HeroPitcureAr} alt="logo" />
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
