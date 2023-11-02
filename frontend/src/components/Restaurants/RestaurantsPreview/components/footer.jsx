import React from 'react';
import { BsTwitter, BsMessenger, BsWhatsapp, BsInstagram, BsFacebook, BsLinkedin, BsTiktok, BsYoutube, BsTelegram } from 'react-icons/bs';
import { FaYoutube } from 'react-icons/fa';

function Footer() {
    const icons = JSON.parse(sessionStorage.getItem('icons'));
    const phoneNumber = sessionStorage.getItem('phoneNumber');
    const iconComponents = {
        BsWhatsapp,
        BsMessenger,
        BsTwitter,
        BsInstagram,
        BsFacebook,
        BsLinkedin,
        BsTiktok,
        BsYoutube,
        BsTelegram,
        FaYoutube,
    };

    return (
        <div className='w-[100%] bg-[#000000] text-white'>
            <div className='w-[100%] flex flex-wrap justify-center items-center gap-6 items-cnter py-2 px-6'>
                <div className='text-xl text-center mb-2'>
                    {phoneNumber}
                </div>
                <div className='flex items-cnter flex-wrap gap-2'>
                    {icons.map((icon) => {
                        const IconComponent = iconComponents[icon.icon];
                        return (
                            <a
                                key={icon.id}
                                className={`p-2 bg-[${icon.color}] ${icon.color} rounded-full text-[12px] border-[1px] border-white`}
                                href={icon.Link}
                            >
                                <IconComponent size="15px" />
                            </a>
                        );
                    })}
                </div>
            </div>
        </div>
    )
}

export default Footer;

