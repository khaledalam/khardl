import React, { useState } from 'react';
import { BiSupport } from 'react-icons/bi';
import { FaFacebookF, FaInstagram, FaYoutube } from 'react-icons/fa';
import { BsBehance, BsLinkedin, BsSnapchat, BsTiktok, BsTwitter } from 'react-icons/bs';
import ClientSection from '../assets/ClientSection.webp';
import { useSelector } from 'react-redux';
import { HiOutlineMail } from 'react-icons/hi';

const Supports = () => {
  const [open, setOpen] = useState(false);
  const Language = useSelector((state) => state.languageMode.languageMode);

  return (
    <div className={`z-[9999999999] fixed max-[450px]:bottom-3  bottom-6 ${Language === "en" ? "right-6 max-[450px]:right-4" : "left-6 max-[450px]:left-4" }  flex flex-col items-end justify-end`}>
      {open &&
        <div className='w-[280px] h-[350px] p-6 bg-white mb-4 rounded-xl shadow-lg'
        style={{
          backgroundImage: `url(${ClientSection})`,
          backgroundSize: "cover",
        }}>
          <div className="flex justify-end items-center flex-wrap  mt-[20px] gap-[15px]">
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
      }
      <div
        onClick={() => setOpen(!open)}
        className="p-[10px]  shadow-[0_-1px_8px_rgba(48,133,231,0.80)] cursor-pointer w-fit rounded-full bg-white flex flex-col items-center justify-center overflow-hidden"
      >
        <BiSupport className='text-blue-400 text-[40px] max-[450px]:text-[30px]' />
      </div>
    </div>
  );
};

export default Supports;
