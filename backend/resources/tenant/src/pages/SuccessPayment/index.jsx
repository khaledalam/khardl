import React from "react";
import successBg from "../../assets/successBg.png";
import successbanner from "../../assets/successbanner.png";
import successText from "../../assets/success-text-bg.png";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";

const SuccessPayment = () => {
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
                <div className="grid ">
                  <div className="relative flex flex-col justify-center items-center max-[860px]:w-[85vw] space-y-14 shadow-lg bg-[#C0D123] p-8 max-[860px]:p-4 rounded-2xl ">
                    <div className="h-auto w-1/3 absolute bottom-124 right-75">
                      <img
                        src={successbanner}
                        alt="logo"
                        className="mx-auto md:w-[95%] w-[100%] success-page-icon"
                        
                      />
                    </div>
                    <div className="flex flex-col items-center  text-center z-[3]">
                      <h1 className="p-2 text-lg  mb-4 md:w-[80%] w-[100%] font-bold" style={{background: `url(${successText})`, backgroundRepeat: 'no-repeat',backgroundSize: 'cover'}}>
                        {t(
                          "Yeayy, Your food order payment has been successfully processed!"
                        )}
                      </h1>
                      <Link
                        to={'/'}
                        className={`flex items-center justify-center bg-[#ececec] cta-btn shadow-lg transition-all delay-100  py-2 px-6 text-[1rem] hover:bg-[#d6eb16] hover:text-black hover:bg-gray-50`}
                      >
                        {" "}
                        {t("Ok")}
                      </Link>
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

export default SuccessPayment;
