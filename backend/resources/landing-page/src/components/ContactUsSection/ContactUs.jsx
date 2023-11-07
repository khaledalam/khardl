import React, { lazy, Suspense } from 'react';
import ContactUsCover from '../../assets/ContactUsCover.webp';
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";
const LazyMainText = lazy(() => import('../MainText'));
const LazyButton = lazy(() => import('../Button'));
function ContactUs() {
    const { t } = useTranslation();

    return (
        <div className="text-center w-[100%]"
            style={{
                backgroundImage: `url(${ContactUsCover})`,
                backgroundSize: "cover",
            }}>
                      <Suspense fallback={<div>Loading...</div>}>

            <div className="mx-32 mt-8 max-[1200px]:mx-0 p-16 max-[540px]:p-10 max-[900px]:mt-[30px]">
                <div className="grid grid-cols-2 items-center max-[700px]:flex max-[700px]:flex-wrap-reverse">
                    <div className="w-[100%]">
                        <div className='max-[900px]:text-center w-[100%]'>
                            <LazyMainText
                                classTitle="!mb-[20px]"
                                classSubTitle="!leading-8"
                                Title={t("ContactUs")}
                            />
                        </div>
                        <div className="w-[100%] flex items-center justify-center">
                            <form className="w-[100%] xl:w-[80%] flex flex-col gap-[22px] px-[15px]">
                                <input className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                    placeholder={t("Email")} name="email" />
                                <input className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                    placeholder={t("Phone")} name="Phone" />
                                <input className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                    placeholder={t("Business name")} name="BusinessName" />
                                <input className="p-[16px] max-[540px]:py-[15px] boreder-none rounded-full bg-[var(--secondary)]"
                                    placeholder={t("Responsible person name")} name="ResponsiblePersonName" />
                                <Link to="/login" className="cursor-pointer flex gap-1">
                                    <h2>{t("create your website")}</h2>
                                    <h2 className="text-blue-500">{t("from here")}</h2>
                                </Link>
                                <div className="flex justify-center">
                                    <LazyButton title={t("Send")} classContainer="!border-none !py-2 !px-10 !w-fit text-[20px]" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div className='max-[900px]:text-center'>
                            <LazyMainText
                                classTitle="!mb-[30px]"
                                classSubTitle="!leading-8"
                                Title={t("Let us help you get more clients with lower fees")}
                            />
                        </div>
                    </div>
                </div>
            </div>
            </Suspense>

        </div>
    )
}

export default ContactUs
