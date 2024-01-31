import React from "react";
import LogoPattern from '../assets/LogoPattern.webp';

const HeaderSection = ({ title, details }) => {

  return (
    <section className=" max-[1250px]:mx-[20px]">
      <div className="new-header">
        <h2>{title}</h2>
        <p>{details}</p>
      </div>
      {/* <footer className="active text-center">
        <div className="px-6 py-10 text-center md:text-right rounded-[30px]"
          style={{
            backgroundImage: `url(${LogoPattern})`,
            backgroundSize: "cover",
          }}>
          <div className="text-center py-10 lg:py-20">
            <h1 className="text-4xl font-extrabold tracking-tight leading-none md:text-5xl lg:text-6xl mb-8">{title}</h1>
            <p className="text-lg font-normal lg:text-xl sm:px-16 lg:px-48">{details}</p>
          </div>
        </div>
      </footer> */}
    </section>
  );
};

export default HeaderSection;
