import React, { lazy, Suspense } from "react";
import { Helmet } from "react-helmet";
import Hero from "./Components/Hero";
import Features from "../../components/FeaturesSection/Features";
import ContactUs from "../../components/ContactUsSection/ContactUs";

import "./index.css";

const Home = () => {
  return (
    <div>
      <Helmet>
        <title>Khardl</title>
        <meta name="description" content="Khardl" />
      </Helmet>

      <div className="flex flex-col justify-start items-center gap-[150px] pt-[80px]">
        <div className="pt-[60px] max-md:px-[5px] max-md:py-[40px] max-w-full md:max-w-[1250px]">
          <Hero />
        </div>
        {/*<Clients />*/}
        <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">
          <Features />
        </div>
        <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">
          <ContactUs />
        </div>
      </div>
    </div>
  );
};

export default Home;
