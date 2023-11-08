import React, { lazy, Suspense } from 'react';
import { useTranslation } from "react-i18next";
import MainText from '../../components/MainText';
import driversApp from '../../assets/driversApp.webp';
import Branches from '../../assets/Branches.webp';
import receiveRequests from '../../assets/receiveRequests.webp';
const HeaderSection = lazy(() => import('../../components/HeaderSection'));
const ContactUs = lazy(() => import('../../components/ContactUsSection/ContactUs'));
const Card = lazy(() => import('../../components/FeaturesSection/Card'));
const Button = lazy(() => import('../../components/Button'));
const Loading = lazy(() => import('../Loading'));

function Services() {
  const { t } = useTranslation();
  const Features = [
    {
      image: receiveRequests,
      title: `${t("Receive Receive")}`,
      Price: `${t("Receive Requests Price")}`,
      Device: `${t("Devices")}`,
    },
    {
      image: driversApp,
      title: `${t("Drivers App")}`,
      Price: `${t("Drivers App Price")}`,
      Device: `${t("Devices")}`,
    },
    {
      image: Branches,
      title: `${t("Each Branch")}`,
      Price: 388,
    }
  ];
  const Fees = [
    {
      title: `${t("Monthly")}`,
      Price: 299,
    },
    {
      title: `${t("3 months")}`,
      Price: 499,
    },
    {
      title: `${t("6 months")}`,
      Price: 799,
    },
    {
      title: `${t("12 months")}`,
      Price: 1299,
    }
  ];
  return (
    <div className='pt-[80px]'>
      <Suspense fallback={<Loading />}>
        <div className='p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
          <HeaderSection title={t("Services")} details={`${t("Home")} / ${t("Services")}`} />
        </div>
        <div className='mt-22 mb-[130px]'>
          <div className='mt-6'>
            <MainText SubTitle={t("Khardl's services Details")} />
          </div>
          <div className='mx-[160px] max-[1250px]:mx-[20px]'>
            <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-10 mx-4 mt-8 mb-[50px]">
              {Features.map((Feature, index) => (
                <Card
                  key={index}
                  FeatureImage={Feature.image}
                  FeatureTitle={Feature.title}
                  FeaturePrice={Feature.Price}
                  FeatureDevice={Feature.Device}
                />
              ))}
            </div>
            <div className='mt-6'>
              <MainText SubTitle={t("Application for your site")} />
            </div>
            <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-10 mx-4 mt-8 mb-[50px]">
              {Fees.map((Feature, index) => (
                <Card
                  key={index}
                  FeatureTitle={Feature.title}
                  FeaturePrice={Feature.Price}
                />
              ))}
            </div>
          </div>
          <div className='flex justify-center'>
            <Button title={t("Register now")} classContainer="!w-fit !border-none px-12" link="/login" />
          </div>
        </div>
        <ContactUs />
      </Suspense>

    </div>
  )
}

export default Services
