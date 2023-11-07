import React, { lazy , Suspense, useState } from 'react'
import { useTranslation } from "react-i18next";
import Button from '../../components/Button';
const HeaderSection = lazy(() => import('../../components/HeaderSection'));
const MainText = lazy(() => import('../../components/MainText'));
const Cards = lazy(() => import('./Components/Cards'));
const ContactUs = lazy(() => import('../../components/ContactUsSection/ContactUs'));
const DeliveryAreaCard = lazy(() => import('./Components/DeliveryAreaCard'));
const Loading = lazy(() => import('../Loading'));

function Advantages() {
  const { t } = useTranslation();
  const [Visible, setVisible] = useState(10);
  const showMoreItems = () => {
      setVisible((prevValue) => prevValue + 5);
  }
  const DeliveryAreas = [
    { Area: `${t("Area 1")}` },
    { Area: `${t("Area 2")}` },
    { Area: `${t("Area 3")}` },
    { Area: `${t("Area 4")}` },
    { Area: `${t("Area 5")}` },
    { Area: `${t("Area 6")}` },
    { Area: `${t("Area 7")}` },
    { Area: `${t("Area 8")}` },
    { Area: `${t("Area 9")}` },
    { Area: `${t("Area 10")}` },
    { Area: `${t("Area 11")}` },
    { Area: `${t("Area 12")}` },
    { Area: `${t("Area 13")}` },
    { Area: `${t("Area 14")}` },
    { Area: `${t("Area 15")}` },
    { Area: `${t("Area 16")}` },
    { Area: `${t("Area 17")}` },
    { Area: `${t("Area 18")}` },
    { Area: `${t("Area 19")}` },
    { Area: `${t("Area 20")}` },
    { Area: `${t("Area 21")}` },
    { Area: `${t("Area 22")}` },
    { Area: `${t("Area 23")}` },
    { Area: `${t("Area 24")}` },
    { Area: `${t("Area 25")}` },
    { Area: `${t("Area 26")}` },
    { Area: `${t("Area 27")}` },
  ]

  return (
    <Suspense fallback={<Loading />}>
    <div className='pt-[80px]'>
    <div className='p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
    <HeaderSection title={t("Advantages")} details={`${t("Home")} / ${t("Advantages")}`} />
      </div>
      <div className='mt-6'>
        <MainText SubTitle={t("features of Khardl")} />
      </div>
      <div className='p-[30px]'>
        <Cards />
      </div>
      <div className='mt-6'>
        <MainText Title={t("Geographical coverage areas")} SubTitle={t("Default Text")} />
        <div className='mx-[160px] max-[1250px]:mx-[20px]'>
          <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 items-center justify-center gap-10 mx-4 mt-8 mb-[50px]">
            {DeliveryAreas.slice(0, Visible).map((area, index) => (
              <div key={index}>
                <DeliveryAreaCard
                  AreaName={area.Area}
                />
              </div>
            ))}
          </div>
          {DeliveryAreas.slice(0, Visible).length === DeliveryAreas.length ?
            <div></div>
            :
            <div className="flex flex-col items-center justify-center">
                <Button
                    title={t("More")}
                    classContainer="!border-none !px-12"
                    onClick={showMoreItems}
                />
            </div>
        }
        </div>
      </div>
      <ContactUs />
    </div>
    </Suspense>
  )
}

export default Advantages
