import React from "react";
import successBg from "../../assets/successBg.png";
import failedbanner from "../../assets/failedBanner.png";
import arrowright from "../../assets/arrowright.svg";
import { useTranslation } from "react-i18next";

const FailedPayment = () => {
  const { t } = useTranslation();

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
                <div className="grid  h-[10%] max-[860px]:flex max-[860px]:flex-col-reverse py-[80px] max-md:py-[60px] xl:max-w-[100%] max-[1200px]:w-[100%]">
                  <div className="relative flex flex-col justify-center items-center max-[860px]:w-[85vw] space-y-14 shadow-lg bg-[#C0D123] p-8 max-[860px]:p-4 rounded-2xl ">
                    <div className="absolute bottom-124 right-75">
                      <img
                        src={failedbanner}
                        alt="logo"
                        className=""
                        style={{ transform: "translate(0px, -60%)" }}
                      />
                    </div>
                    <div className="flex flex-col items-center mt-[-137px] md:mt-[-100px] lg:mt-[-50px] text-center z-[3]">
                      <h1 className="p-2 text-2xl font-bold">
                        {t("Oops! Payment Failed. Please try again.")}
                      </h1>
                      <button
                        onClick={() => console.log("failed", Math.random())}
                        className={`flex items-center justify-center bg-[#ececec] cta-btn transition-all delay-100  py-2 px-6 text-[1.5rem] hover:bg-[#d6eb16] hover:text-black hover:bg-gray-50`}
                      >
                        {t("Home Page")}
                        <img src={arrowright} alt="" className="ml-2 h-4" />
                      </button>
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

export default FailedPayment;
