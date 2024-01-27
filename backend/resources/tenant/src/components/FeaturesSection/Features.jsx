import React from "react";
import MainText from '../MainText';
import { useTranslation } from "react-i18next";
import driversApp from '../../assets/driversApp.webp';
import receiveRequests from '../../assets/receiveRequests.webp';
import KhardlDelivery from '../../assets/KhardlDelivery.webp';
import ElectronicPayments from '../../assets/ElectronicPayments.webp';
import WebsiteAndApplication from '../../assets/WebsiteAndApplication.webp';
import Card from "./Card";

function FeaturesSection() {
 
  const { t } = useTranslation();
  const Features = [
    {
      image: WebsiteAndApplication,
      title: `${t("Website and application design")}`,
      details:  `${t("Website and application design Details")}`,
    },
    {
      image: driversApp,
      title: `${t("Drivers App")}`,
      details: `${t("Drivers App Details")}`,
    },
    {
      image: KhardlDelivery,
      title: `${t("Khardl delivery")}`,
      details:  `${t("Khardl delivery Details")}`,
    },
    {
      image: receiveRequests,
      title: `${t("Receive Requests")}`,
      details: `${t("Receive Requests Details")}`,
    },
    {
      image: ElectronicPayments,
      title: `${t("Electronic payments")}`,
      details: `${t("Electronic payments Details")}`,
    },
  ];
  return (
    <section 
    className='mx-[160px] max-[1250px]:mx-[20px] flex flex-col items-center justify-center '
    data-aos='fade-up'
    data-aos-delay='400' >
        <MainText Title={t("Khardl's services")} SubTitle={t("Khardl's services Details")} />
      <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mx-4 mt-8 mb-[50px]">
        {Features.map((Feature, index) => (
          <Card
            key={index}
            FeatureImage={Feature.image}
            FeatureTitle={Feature.title}
            FeatureDetails={Feature.details}
          />
        ))}
      </div>
    </section>
  )
}

export default FeaturesSection
