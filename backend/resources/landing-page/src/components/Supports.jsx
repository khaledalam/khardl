import React, { useState } from 'react';
import { BiSupport } from 'react-icons/bi';
import { FaFacebookF, FaInstagram, FaWhatsapp, FaYoutube } from 'react-icons/fa';
import { BsBehance, BsLinkedin, BsTwitter } from 'react-icons/bs';
import Hero from '../assets/Hero.webp';
import { useSelector } from 'react-redux';
import { HiOutlineMail } from 'react-icons/hi';

const Supports = () => {
  const [open, setOpen] = useState(false);
  const Language = useSelector((state) => state.languageMode.languageMode);

  return (
    <div className={`z-[9999999999] fixed max-[450px]:bottom-3  bottom-6 ${Language === "en" ? "right-6 max-[450px]:right-4" : "left-6 max-[450px]:left-4"}  flex flex-col items-end justify-end`}>
      {open &&
        <div className='w-[280px] h-[350px] p-6 bg-white mb-4 rounded-xl shadow-lg z-[99999999999999]'
          style={{
            backgroundImage: `url(${Hero})`,
            backgroundSize: "cover",
          }}>
          <div className="flex justify-end items-center flex-wrap  mt-[20px] gap-[15px] gap-y-[20px]">
            <div className="bg-[#2c2c2c] hover:bg-[#1D9BF0] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <BsTwitter size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#C71610] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <HiOutlineMail size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#E4405F] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <FaInstagram size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#0e76a8] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <BsLinkedin size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#FF0000] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <FaYoutube size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#053eff] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <BsBehance size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#20B038] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <FaWhatsapp size={26} />
            </a>
          </div>
          <div className="bg-[#2c2c2c] hover:bg-[#1877F2] text-white p-2 rounded-full transform transition-transform hover:-translate-y-2">
            <a href="#">
              <FaFacebookF size={26} />
            </a>
          </div>
          </div>


            <hr className={"my-5"} />

            <span className={"flex text-center w-100"}>Test</span>
        </div>
      }
      <div
        onClick={() => setOpen(!open)}
        className="p-[10px]  shadow-[0_-1px_8px_var(--primary)] cursor-pointer w-fit rounded-full bg-[#272626] flex flex-col items-center justify-center overflow-hidden transform transition-transform hover:-translate-y-2"
      >
        <BiSupport className='text-[var(--primary)] text-[40px] max-[450px]:text-[30px]' />
      </div>
      {open !== false && (
        <button
          onClick={() => setOpen(false)}
          className='w-full h-full fixed inset-0 z-[100] transition-all duration-500'
          style={{ display: open ? 'block' : 'none' }}
        >
        </button>
      )}
    </div>
  );
};

export default Supports;
