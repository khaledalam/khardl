import React, { useState, useEffect } from "react";
import logo from "../../assets/Logo.webp";
import Copyright from "./Copyright";
import LogoPattern from "../../assets/LogoPattern.webp";
import {
  FaFacebookF,
  FaInstagram,
  FaWhatsapp,
  FaYoutube,
} from "react-icons/fa";
import { BsBehance, BsTwitter, BsLinkedin } from "react-icons/bs";
import { useTranslation } from "react-i18next";
import { HiOutlineMail } from "react-icons/hi";
import { Link } from "react-router-dom";

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
        <div
          className="px-6 py-10 text-center md:text-right rounded-t-[30px]"
          style={{
            backgroundImage: `url(${LogoPattern})`,
            backgroundSize: "cover",
          }}
        >
          <div className="flex flex-col items-center justify-center gap-4">
            <div>
              <div className="mb-4 uppercase transform transition-transform hover:-translate-y-2">
                <Link to="/">
                  <img
                    loading="lazy"
                    className="w-[120px] max-[500px]:w-[90px]"
                    src={logo}
                    alt="logo2"
                  />
                </Link>
              </div>
            </div>
            <h2 className="max-w-[500px] text-center">{t("Footer-text")}</h2>
            <div className="flex justify-center items-center flex-wrap  mt-[20px] gap-[15px]">
              <div className="bg-black hover:bg-[#1D9BF0]  hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <BsTwitter size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#C71610] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <HiOutlineMail size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#E4405F] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <FaInstagram size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#0e76a8] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <BsLinkedin size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#FF0000] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <FaYoutube size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#053eff] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <BsBehance size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#20B038] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
                <a href="#">
                  <FaWhatsapp size={26} />
                </a>
              </div>
              <div className="bg-black hover:bg-[#1877F2] hover:text-white text-[var(--primary)] p-2 rounded-full transform transition-transform hover:-translate-y-2">
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
