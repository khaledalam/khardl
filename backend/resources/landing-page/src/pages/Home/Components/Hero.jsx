import React from "react";
import logo from "../../../assets/Logo.webp";
import HeroImg from '../../../assets/Hero.webp';
import HeroPitcure from '../../../assets/HeroPitcure.webp';
import { useTranslation } from "react-i18next";
import Button from '../../../components/Button';

const Hero = () => {
  const { t } = useTranslation();

  return (
    <section className="active text-center mx-[160px] max-[1250px]:mx-[20px]">
      <div className={`px-6 py-10 text-center md:text-right rounded-[30px]`}
        style={{
          backgroundImage: `url(${HeroImg})`,
          backgroundSize: "cover",
        }}>
        <div className="grid grid-cols-2 items-center max-[700px]:flex  max-[700px]:flex-wrap-reverse">
          <div className="flex flex-col items-center justify-center gap-4">
            <div className="mb-4 uppercase" >
              <img loading="lazy"  className="w-20 max-[500px]:w-16" src={logo} alt="logo" />
            </div>
            <div className="text-[34px] max-[1000px]:text-[30px] max-[500px]:text-[24px] font-bold flex justify-center gap-2 ">
              <h2 className="max-w-[500px] text-center">
                {t("more clients")}
                <span className="text-white">
                  {"\u00A0"}{t("commissions")}
                  <span className="text-black">{"\u00A0"}{t("or")}</span>
                  {"\u00A0"}{t("mandatory subscriptions")}
                </span>
              </h2>
            </div>
            <h2 className="max-w-[500px] text-center text-[18px] mb-4">
              {t("Create your website")}
            </h2>
            <Button title={t("Start Now")} link="/register" classContainer={`!bg-black !text-[var(--primary)] !border-none !px-[70px] !py-3`} />
          </div>
          <div className="mb-4 uppercase">
            <img loading="lazy"  className="w-full h-auto max-w-[100%]" src={HeroPitcure} alt="logo" />
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
