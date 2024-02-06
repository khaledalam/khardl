import React, { lazy, Suspense } from "react";
import { Helmet } from "react-helmet";
import { useTranslation } from "react-i18next";
import successBg from "../assets/successBg.png";
import failedbanner from "../assets/restaurant-not-live.png";
import arrowright from "../assets/arrowright.svg";
import { Link } from "react-router-dom";
import { useSelector } from "react-redux";
import LogoPattern from "../assets/LogoPattern.webp";
import logo from "../assets/Logo.webp";
const RestaurantNotLive = () => {
  const url_central = "https://khardl.com";
  const { t } = useTranslation();
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  return (
    <div className="flex flex-col items-stretch justify-center ">
      <div
        className="flex justify-center items-center px-[40px] max-md:px-[0px] login-background min-h-[100vh]"
        style={{
          backgroundImage: `url(${successBg})`,
          backgroundSize: "cover",
        }}
      >
        <div className="flex flex-col items-center justify-center gap-4">
          <div>
            <div className="mb-4 uppercase transform transition-transform hover:-translate-y-2"></div>
            <div className="py-[20px] flex justify-center items-center">
              <div className="flex justify-center items-center flex-wrap  mt-[20px] gap-[15px]">
                <div className="grid ">
                  <div className="relative flex flex-col justify-center items-center w-[100vw] space-y-14 shadow-lg bg-[#C0D123] p-8 max-[860px]:p-4 ">
                    <div className="h-auto w-1/3 absolute bottom-124 right-75">
                      <img
                        src={failedbanner}
                        alt="logo"
                        className="mx-auto lg:w-[40%] md:w-[50%] w-[80%] res-failed-page-icon"
                      />
                    </div>
                    <div className="flex flex-col items-center  text-center z-[3]">
                      <h1 className="p-2 text-lg  mb-4  font-bold md:min-w-[700px] text-red-600">
                        {t("This restaurant is not active yet")}
                      </h1>
                      <div className="flex gap-5">
                        <Link
                          to={"/"}
                          className={`flex items-center justify-center bg-[#ececec] cta-btn shadow-lg transition-all delay-100  py-2 px-6 text-[1rem] hover:bg-[#d6eb16] hover:text-black hover:bg-gray-50`}
                        >
                          {" "}
                          {t("Restaurant Login Page")}
                          <img src={arrowright} alt="" className="ml-2 h-4" />
                        </Link>
                        <a
                          href={url_central}
                          className={`flex items-center justify-center bg-[#ececec] cta-btn shadow-lg transition-all delay-100  py-2 px-6 text-[1rem] hover:bg-[#d6eb16] hover:text-black hover:bg-gray-50`}
                        >
                          {" "}
                          {t("Main Khardl Website")}
                          <img src={arrowright} alt="" className="ml-2 h-4" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default RestaurantNotLive;
