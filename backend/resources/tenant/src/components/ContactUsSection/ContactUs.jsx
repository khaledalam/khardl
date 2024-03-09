import React from "react";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";
import MainText from "../MainText";
import { toast } from "react-toastify";
import { useForm } from "react-hook-form";
// import { useApiContext } from '../../pages/context';
import Axios from "../../axios/axios";

function ContactUs() {
    const { t } = useTranslation();
    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
    } = useForm();

    // **API POST REQUEST**
    const onSubmit = async (credentials) => {
        try {
            const { data } = await Axios.post(
                "/contact-us",
                {
                    email: credentials?.email,
                    phone_number: credentials?.phone_number,
                    business_name: credentials?.business_name,
                    responsible_person_name:
                        credentials?.responsible_person_name,
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": window.csrfToken,
                    },
                },
            );
            if (data.response.ok) {
                toast.success(
                    `${t("Your contact information has been sent successfully")}`,
                );
                reset();
            } else {
                throw new Error(
                    `${t("Your contact information has not been sent")}`,
                );
            }
        } catch (error) {
            toast.error(`${t("Your contact information has not been sent")}`);
        }
    };

    //  **displayed content**
    return (
        <section className="mx-4 md:mx-[100px] max-w-full md:max-w-[1250px] flex flex-col items-center justify-center ">
            <div
                className="text-center w-[100%]"
                style={{
                    backgroundImage: `url(${ContactUsCover})`,
                    backgroundSize: "cover",
                }}
            >
                <div>
                    <div className="mx-32 mt-8 max-[1200px]:mx-0 p-16 max-[540px]:p-10 max-[900px]:mt-[30px]">
                        <div className="grid grid-cols-2 items-center max-[700px]:flex max-[700px]:flex-wrap-reverse">
                            <div
                                className="w-[100%]"
                                data-aos="fade-up"
                                data-aos-delay="400"
                            >
                                <div className="max-[900px]:text-center w-[100%]">
                                    <MainText
                                        classTitle="!mb-[20px]"
                                        classSubTitle="!leading-8"
                                        Title={t("ContactUs")}
                                    />
                                </div>
                                <div className="w-[100%] flex items-center justify-center">
                                    <form
                                        onSubmit={handleSubmit(onSubmit)}
                                        className="w-[100%] xl:w-[80%] flex flex-col gap-[22px] px-[15px]"
                                    >
                                        <div className="flex flex-col">
                                            <input
                                                type="email"
                                                className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                                placeholder={t("Email")}
                                                name="email"
                                                {...register("email", {
                                                    required: true,
                                                })}
                                            />
                                            {errors.email && (
                                                <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                                                    {t("Email Error")}
                                                </span>
                                            )}
                                        </div>

                                        <div className="flex flex-col">
                                            <input
                                                type="tel"
                                                className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
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
                                            <input
                                                type="text"
                                                className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
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
                                            <input
                                                type="text"
                                                className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                                placeholder={t(
                                                    "Responsible person name",
                                                )}
                                                name="ResponsiblePersonName"
                                                minLength={3}
                                                {...register(
                                                    "responsible_person_name",
                                                    {
                                                        required: true,
                                                    },
                                                )}
                                            />
                                            {errors.responsible_person_name && (
                                                <span className="text-red-500 text-xs mt-2 ms-2 text-start">
                                                    {t(
                                                        "Responsible person Error",
                                                    )}
                                                </span>
                                            )}
                                        </div>

                                        <div className="flex justify-center items-center flex-wrap gap-1">
                                            <h2>{t("create your website")}</h2>
                                            <Link to="/login">
                                                <h2 className="text-blue-500">
                                                    {t("from here")}
                                                </h2>
                                            </Link>
                                        </div>
                                        <div className="flex justify-center">
                                            <button
                                                type="submit"
                                                className={`w-fit font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px] hover:bg-[#d6eb16]`}
                                            >
                                                {t("Send")}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="400">
                                <div className="max-[900px]:text-center">
                                    <MainText
                                        classTitle="!mb-[30px]"
                                        classSubTitle="!leading-8"
                                        Title={t(
                                            "Let us help you get more clients with lower fees",
                                        )}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default ContactUs;
