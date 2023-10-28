import React from 'react';
import Header from './header';
import Footer from './footer';
import RowTable from './rowTable';
import { useTranslation } from "react-i18next";
import { FaStarOfLife } from 'react-icons/fa';

function PricesTable() {
    const { t } = useTranslation();

    return (
        <div className='flex flex-col items-center w-[100%] gap-20'>
            <div 
            className='flex flex-col items-center w-[100%]'
            data-aos='fade-up'
            data-aos-delay='400'>
                <Header headerText={t("points")} />
                <RowTable points={90} price={116.1} />
                <RowTable points={300} price={387} />
                <RowTable points={550} price={654.5} />
                <RowTable points={750} price={742.50} />
                <RowTable points={990} price={950.4} />
                <RowTable points={1500} price={1395} />
                <RowTable points={3000} price={2640} />
                <RowTable points={5500} price={4400} />
                <RowTable points={7000} price={4550} />
                <RowTable points={t("Unlimited points")} price={4800} without />
                <Footer FooterText={t("Excludes VAT")} />
            </div>
            <div 
            data-aos='fade-up'
            data-aos-delay='400' 
            className='flex flex-col items-center w-[100%]'>
                <Header headerText={t("Location")} />
                <RowTable points={t("Each Branch")} price={388} without />
                <Footer FooterText={t("Includes VAT")} />
            </div>
            <div 
            data-aos='fade-up'
            data-aos-delay='400' 
            className='flex flex-col items-center w-[100%]'>
                <Header headerText={t("Applications")} />
                <div className='border-[0.5px] border-gray-300 border-t-0 w-[60%] max-md:w-[100%]'>
                    <div className='flex flex-col items-center justify-start my-6'>
                        <p className='font-bold'>
                            {t("Receive Requests")}
                        </p>
                        <div className="flex justify-start items-center gap-2 text-start mt-1">
                            <FaStarOfLife size={10} className="text-red-500" />
                            <h2 className="text-[16px]">{t("Devices")}</h2>
                        </div>
                        <div className='flex flex-col items-start justify-start text-start'>
                            <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                <p>{t("Monthly")}</p>
                                <p>{299} {t("SAR")}</p>
                            </div>
                            <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                <p>{t("3 months")}</p>
                                <p>{499} {t("SAR")}</p>
                            </div>
                            <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                <p>{t("6 months")}</p>
                                <p>
                                    {799} {t("SAR")}
                                </p>
                            </div>
                            <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                                <p>{t("12 months")}</p>
                                <p>
                                    {1299} {t("SAR")}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='border-[0.5px] border-gray-300 border-t-0 w-[60%] max-md:w-[100%]'>
                    <div className='flex flex-col items-center justify-start my-6'>
                        <p className='font-bold'>
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
                <div className='border-[0.5px] border-gray-300 border-t-0 w-[60%] max-md:w-[100%]'>
                    <div className='flex flex-col items-center justify-start my-6'>
                        <p className='font-bold'>
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
    )
}

export default PricesTable;
