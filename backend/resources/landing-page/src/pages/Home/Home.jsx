import React, { lazy, Suspense } from 'react';
import { Helmet } from 'react-helmet';
import Hero from './Components/Hero';
import Features from '../../components/FeaturesSection/Features';
import ContactUs from '../../components/ContactUsSection/ContactUs';

import "./index.css"

const Home = () => {

    // window.location.href = '/dashboard';
    //
    // return;

  return (
    <div>
      <Helmet>
        <title>Khardl</title>
        <meta name="description" content="Khardl" />
      </Helmet>

      <div className="flex flex-col justify-start items-center gap-[180px] pt-[80px]">
        <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
          <Hero />
        </div>
       
        {/*<Clients />*/}
        <Features />
        <ContactUs />
      </div>
    </div>
  );
};

export default Home;
