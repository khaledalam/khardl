import React, { lazy, Suspense } from 'react';
const Hero = lazy(() => import('./Components/Hero'));
const Clients = lazy(() => import('../../components/Clients/Clients'));
const RequestPoint = lazy(() => import('../../components/RequestPointSection/RequestPoint'));
const Features = lazy(() => import('../../components/FeaturesSection/Features'));
const ContactUs = lazy(() => import('../../components/ContactUsSection/ContactUs'));
const Loading = lazy(() => import('../Loading'));

const Home = () => {
  return (
    <Suspense fallback={<Loading />}>
      <div className="flex flex-col justify-start items-center gap-[180px] pt-[80px]">
        <div className='p-[30px]  pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
          <Hero />
        </div>
        <Clients />
        <RequestPoint />
        <Features />
        <ContactUs />
      </div>
    </Suspense>
  );
};

export default Home;
