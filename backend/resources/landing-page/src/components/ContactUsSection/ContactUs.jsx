import React, { useEffect, useState } from "react";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";
import { toast } from "react-toastify";
import { useForm } from "react-hook-form";
import Axios from "../../axios/axios";
import mail from "../../assets/mail.png";
import { HiChevronRight } from "react-icons/hi2";
import { useSelector } from "react-redux";

function ContactUs() {
  const { t } = useTranslation();
  const {
    register,
    handleSubmit,
    formState: { errors },
    reset,
  } = useForm();
  const language = useSelector((state) => state.languageMode.languageMode);

  // **API POST REQUEST**
  const onSubmit = async (credentials) => {
    try {
      const { data } = await Axios.post(
        "/contact-us",
        {
          email: credentials?.email,
          phone_number: credentials?.phone_number,
          business_name: credentials?.business_name,
          responsible_person_name: credentials?.responsible_person_name,
        },
        {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": window.csrfToken,
          },
        },
      );
      console.log(data);
      if (data.success) {
        // const responseData = await response.json()
        toast.success(
          `${t("Your contact information has been sent successfully")}`,
        );
        reset();
      } else {
        throw new Error(`${t("Your contact information has not been sent")}`);
      }
    } catch (error) {
      toast.error(`${t("Your contact information has not been sent")}`);
    }
  };
  const [isMobile, setIsMobile] = useState(false);

  useEffect(() => {
    const isMobile = window.innerWidth <= 1000;
    setIsMobile(!isMobile);
  }, []);

  console.log("ContactUs");
  //  **displayed content**
  return (
    <>
      <section className="mx-4 md:mx-[100px] max-w-full md:max-w-[1250px] flex flex-col items-center justify-center ">
        <h3 className="home-heading">{t("Contact Us")}</h3>
        <h3 className="text-medium mb-11">
          {t("Let us assist you in acquiring more clients at reduced rates")}.
        </h3>
        <div className={`${!isMobile ? "w-[100%]" : "grid grid-cols-2 gap-4"}`}>
          <div
            className={`relative ${!isMobile ? "hidden" : "block"} `}
            style={{
              background:
                "radial-gradient(50% 50% at 50% 50%, #E6FF00 0%, #E6FF00 42.26%, rgba(230, 255, 0, 0.30) 48.28%, rgba(230, 255, 0, 0.00) 100%)",
            }}
          >
            <div className="contact-footer-section">
              {/* <h3 className="contact-heading text-left mt-2 mb-5"> */}
              {/* className={language === "en" ? "text-left" : " header-ar"} */}
              <h3
                className={`${language === "en" ? "text-left" : "header-ar"} mt-2 mb-5 contact-heading `}
              >
                {t("Contact Information")}
              </h3>

              <h3 className="contact-text">{t("Footer")}</h3>
              {/* <div className="contact-details"><span><img src={call}/>
              </span>(+966)121-212-121</div> */}
              <div className="contact-details">
                <span>
                  <img src={mail} />
                </span>
                <a href={"mailto:contact-us@khardl.com"}>
                  contact-us@khardl.com
                </a>
              </div>
              {/* <div className="contact-details"><span><img src={location}/>

              </span>e.g.Saudi Arabia</div> */}
              {/* <div className="flex gap-3 mt-7">
                <img src={facebook} width="24px" height={'24px'} className="social-ic"/>
                <img src={xlogo} width="24px" height={'24px'} className="social-ic"/>
                <img src={insta} width="24px" height={'24px'} className="social-ic invert"/>
                <img src={youtube} width="24px" height={'24px'} className="social-ic"/>
                <img src={linkedin} width="24px" height={'24px'} className="social-ic"/>
              </div> */}
            </div>
          </div>

          <div className="w-[100%] flex items-center justify-center">
            <form
              onSubmit={handleSubmit(onSubmit)}
              className="w-[100%]  flex flex-col gap-[22px] px-[15px] custom-form-design"
            >
              <div className="flex flex-col">
                <label htmlFor="">{t("Email")}</label>
                <input
                  type="email"
                  className=" max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                  placeholder={t("Email")}
                  name="email"
                  {...register("email", { required: true })}
                />
                {errors.email && (
                  <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                    {t("Email Error")}
                  </span>
                )}
              </div>

              <div className="flex flex-col">
                <label htmlFor="">{t("Phone Number")}</label>

                <input
                  type="text"
                  className=" max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                  placeholder={t("Phone")}
                  name="Phone"
                  {...register("phone_number", {
                    required: true,
                  })}
                  minLength={10}
                />
                {errors.phone_number && (
                  <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                    {t("Phone Error")}
                  </span>
                )}
              </div>

              <div className="flex flex-col">
                <label htmlFor="">{t("Business name")}</label>

                <input
                  type="text"
                  className=" max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                  placeholder={t("Business name")}
                  name="BusinessName"
                  minLength={5}
                  {...register("business_name", {
                    required: true,
                  })}
                />
                {errors.business_name && (
                  <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                    {t("Business name Error")}
                  </span>
                )}
              </div>

              <div className="flex flex-col">
                <label htmlFor="">{t("Responsible person Name")}</label>
                <input
                  type="text"
                  className=" max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                  placeholder={t("Responsible person name")}
                  name="ResponsiblePersonName"
                  minLength={3}
                  {...register("responsible_person_name", {
                    required: true,
                  })}
                />
                {errors.responsible_person_name && (
                  <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                    {t("Responsible person Error")}
                  </span>
                )}
              </div>

              <div className="flex justify-center items-center flex-wrap gap-1  hidden">
                <h2>{t("create your website")}</h2>
                <Link to="/login">
                  <h2 className="text-blue-500">{t("from here")}</h2>
                </Link>
              </div>
              <div className="flex justify-end ">
                <button
                  type="submit"
                  className={`flex gap-5 ${
                    !isMobile ? "w-[100%]" : "w-fit"
                  } justify-center cta-btn font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px] hover:bg-[#d6eb16] hover:text-black`}
                >
                  {language === "en" ? (
                    <>
                      {t("Send")} <HiChevronRight />
                    </>
                  ) : (
                    <>
                      <HiChevronRight /> {t("Send")}
                    </>
                  )}
                  {/* {t("Send")}
                  <HiChevronRight /> */}
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </>
  );
}

export default ContactUs;
