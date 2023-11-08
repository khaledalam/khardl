import React, { lazy, Suspense } from 'react';
import { useTranslation } from "react-i18next";
const SectionAsk = lazy(() => import('../../components/FrequentlyAsk/SectionAsk'));
const HeaderSection = lazy(() => import('../../components/HeaderSection'));
const MainText = lazy(() => import('../../components/MainText'));
const ContactUs = lazy(() => import('../../components/ContactUsSection/ContactUs'));
const Loading = lazy(() => import('../Loading'));

const FQA = () => {
    const { t } = useTranslation();

    const faqsGeneral = [
        {
            question: `${t("Question 1")}`,
            answer: `${t("Answer 1")}`,
        },
        {
            question: `${t("Question 2")}`,
            answer: `${t("Answer 2")}`,
        },
        {
            question: `${t("Question 3")}`,
            answer: `${t("Answer 3")}`,
        },
        {
            question: `${t("Question 4")}`,
            answer: `${t("Answer 4")}`,
        },
        {
            question: `${t("Question 5")}`,
            answer: `${t("Answer 5")}`,
        },
        {
            question: `${t("Question 6")}`,
            answer: `${t("Answer 6")}`,
        }
    ];
    return (
        <Suspense fallback={<Loading />}>
        <div className='pt-[80px]'>
                <div className='p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
                    <HeaderSection title={t("FQA")} details={`${t("Home")} / ${t("FQA")}`} />
                </div>
                <div className='mt-6'>
                    <MainText SubTitle={t("Default Text")} />
                </div>
                <div className='flex justify-center pb-16'>
                    <SectionAsk data={faqsGeneral} />
                </div>
                <ContactUs />
        </div>
        </Suspense>
    )
}

export default FQA;