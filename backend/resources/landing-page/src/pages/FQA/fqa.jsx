import React from "react";
import { useTranslation } from "react-i18next";
import { Helmet } from "react-helmet";
import SectionAsk from "../../components/FrequentlyAsk/SectionAsk";
import HeaderSection from "../../components/HeaderSection";
import MainText from "../../components/MainText";
import ContactUs from "../../components/ContactUsSection/ContactUs";

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
    },
  ];
  return (
    <div>
      <Helmet>
        <title>Khardl FAQ</title>
        <meta name="description" content="Khardl FAQ" />
      </Helmet>

      <div className="pt-[80px]">
        <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">
          {/* <HeaderSection title={t("FQA")} details={`${t("Home")} / ${t("FQA")}`} /> */}
          <h1 className="faq-header">
            FAQ <span>(Frequently Asked Question)</span>
          </h1>
        </div>
        <div className="mt-6" data-aos="fade-up" data-aos-delay="400">
          <MainText SubTitle={t("FQA Details")} />
        </div>
        <div className="flex justify-center pb-16 max-sm:pb-4">
          <SectionAsk data={faqsGeneral} />
        </div>
        <div className="flex flex-col justify-start items-center gap-[150px] pt-[80px]">
          <ContactUs />
        </div>
      </div>
    </div>
  );
};

export default FQA;
