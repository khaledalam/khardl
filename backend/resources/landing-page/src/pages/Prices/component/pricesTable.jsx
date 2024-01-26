import React from 'react';
import Header from './header';
import Footer from './footer';
import RowTable from './rowTable';
import { useTranslation } from "react-i18next";
import { FaStarOfLife } from 'react-icons/fa';

function PricesTable() {
    const { t } = useTranslation();

    return (
        <div className='grid grid-cols-2 h-[100%]  my-[80px] w-[100%]'>
            <div
                data-aos='fade-up'
                data-aos-delay='400'
                className='flex flex-col items-center w-[100%]'>
                <div className="price-box">
                    <Header headerText={t("Location")} />
                    <RowTable points={t("Each Branch")} price={388} without />
                    <Footer FooterText={t("Includes VAT")} />
                </div>
            </div>
            <div
                data-aos='fade-up'
                data-aos-delay='400'
                className='flex flex-col items-center w-[100%]'>
                <div className="price-box">
                    <Header headerText={t("Applications")} />
                    <div className='content w-[100%] max-md:w-[100%]'>
                        <div className='flex flex-col items-center justify-start my-6'>
                            <p className='font-bold content'>
                                {t("Receive Requests")}
                            </p>
                            <div className="flex justify-start items-center gap-2 text-start mt-1">
                                <FaStarOfLife size={10} className="text-red-500" />
                                <h2 className="text-[16px]">{t("Devices")}</h2>
                            </div>
                            <div className='flex flex-col items-start justify-start text-start'>
                                <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                    <p>{t("Monthly")}</p>
                                    <p><span className='price'>{299}</span><span className='small'>{t("SAR")}</span></p>
                                </div>
                                <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                    <p>{t("3 months")}</p>
                                    <p><span className='price'>{499}</span><span className='small'>{t("SAR")}</span></p>
                                </div>
                                <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                    <p>{t("6 months")}</p>
                                    <p>
                                        <span className='price'>{799}</span><span className='small'>{t("SAR")}</span>
                                    </p>
                                </div>
                                <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                    <p>{t("12 months")}</p>
                                    <p>
                                        <span className='price'>{1299}</span><span className='small'>{t("SAR")}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className='content w-[100%] max-md:w-[100%]'>
                        <div className='flex flex-col items-center justify-start my-6'>
                            <p className='font-bold  content'>
                                {t("Receive Requests")}
                            </p>
                            <div className="flex justify-start items-center gap-2 text-start mt-1">
                                <FaStarOfLife size={10} className="text-red-500" />
                                <h2 className="text-[16px]">{t("Devices")}</h2>
                            </div>
                            <div className='flex flex-col items-start justify-start text-start'>
                                <p>{t("Free")}</p>
                            </div>
                        </div>
                    </div>
                    <div className='content w-[100%] max-md:w-[100%]'>
                        <div className='flex flex-col items-center justify-start my-6'>
                            <p className='font-bold  content'>
                                {t("Drivers App")}
                            </p>
                            <div className="flex justify-start items-center gap-2 text-start mt-1">
                                <FaStarOfLife size={10} className="text-red-500" />
                                <h2 className="text-[16px]">{t("Devices")}</h2>
                            </div>
                            <div className='flex flex-col items-start justify-start text-start'>
                                <p>{t("Free")}</p>
                            </div>
                        </div>
                    </div>
                    <Footer FooterText={t("Includes VAT")} />
                </div>
            </div>
        </div>
    )
}

export default PricesTable;
