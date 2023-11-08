import React, { useState, useEffect } from "react";
import logo from "../../assets/Logo.webp";
import Copyright from "./Copyright";
import LogoPattern from '../../assets/LogoPattern.webp';
import { FaFacebookF, FaInstagram, FaYoutube } from 'react-icons/fa';
import { BsBehance, BsTwitter, BsLinkedin } from 'react-icons/bs';
import { useTranslation } from "react-i18next";
import { HiOutlineMail } from 'react-icons/hi';

const Footer = () => {
  const [, setShow] = useState(true);
  const { t } = useTranslation();

  useEffect(() => {
    const handleResize = () => {
      setShow(window.innerWidth >= 770);
    };
    window.addEventListener("resize", handleResize);
    handleResize();
    return () => {
      window.removeEventListener("resize", handleResize);
    };
  }, []);


  return (
    <section className=" mx-[160px] max-[1250px]:mx-[20px]">
      <footer className="active text-center">
        <div className="px-6 py-10 text-center md:text-right rounded-t-[30px]"
          style={{
            backgroundImage: `url(${LogoPattern})`,
            backgroundSize: "cover",
          }}>
          <div className="flex flex-col items-center justify-center gap-4">
            <div >
              <div className="mb-4 uppercase">
                <img loading="lazy"   className="w-24" src={logo} alt="logo2"  />
              </div>
            </div>
            <h2 className="max-w-[500px] text-center">
              {t("Footer")}
            </h2>
            <div className="flex justify-center items-center flex-wrap  mt-[20px] gap-[15px]">
            <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <BsTwitter size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <HiOutlineMail size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <FaInstagram size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <BsLinkedin size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <FaYoutube size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <BsBehance size={26} />
            </a>
          </div>
          <div className="bg-black text-[var(--primary)] p-2 rounded-full">
            <a href="#">
              <FaFacebookF size={26} />
            </a>
          </div>
            </div>
          </div>
        </div>
        <Copyright />
      </footer>
    </section>
  );
};

export default Footer;
