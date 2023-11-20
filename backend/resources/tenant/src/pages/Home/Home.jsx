import React, { lazy, Suspense } from 'react';
import { Helmet } from 'react-helmet';
import Hero from './Components/Hero';
import ContactUs from '../../components/ContactUsSection/ContactUs';
import Preview from "../../components/Restaurants/RestaurantsPreview/Preview";

const Home = () => {
  return (
    <div>
      <div className="flex flex-col justify-start items-center gap-[180px] pt-[80px]">
        <div className='p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] '>
            <h1 className={"p-5 flex w-full justify-content-center text-center"}>Restaurant Details Will Be Here...</h1>
            <Hero />
        </div>
        <ContactUs />
      </div>
    </div>
  );
};

export default Home;
