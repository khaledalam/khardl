import React, { useState } from 'react';
import { useSelector } from 'react-redux';
import { selectButtons } from '../../../../redux/editor/buttonSlice';
import { globalColor } from '../../../../redux/editor/buttonSlice';
import PersonalImage from '../../../../assets/image.webp';

function Header() {
    const buttons = useSelector(selectButtons);
    const [isOpen, setIsOpen] = useState(null);
    const cartItems = useSelector((state) => state.cart.items);
    const GlobalColor = useSelector(globalColor);
    const [showDetailesItem, setShowDetailesItem] = useState(false);
    const [isMenuOpen, setMenuOpen] = useState(false);
    const divWidth = useSelector((state) => state.divWidth.value);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const shapeImageShape = useSelector(state => state.shapeImage.shapeImageShape);

    const toggleMenu = () => {
        setMenuOpen(!isMenuOpen);
    };
  
    return (
        <div className={`flex items-start justify-between shadow-sm sticky  ${divWidth <= 400 ? "px-2" : ""} p-[10px] px-4 bg-white`}>
            <div className=' flex flex-col'>
                <div className={`relative ${divWidth >= 800 ? "hidden" : ""}`}>
                    <label className={` hamburger ${isMenuOpen ? "absolute top-[5px] z-[999999999]" : ""}`}
                        style={{
                            stroke: '#000000'
                        }} >
                        <input type="checkbox" checked={isMenuOpen} onClick={toggleMenu} />
                        <svg viewBox="0 0 32 32" >
                            <path className="line line-top-bottom"
                                d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
                            <path className="line" d="M7 16 27 16"></path>
                        </svg>
                    </label>
                </div>
                <div className={`${divWidth >= 800 ? "flex items-center justify-between gap-2" : (isMenuOpen ? 'block' : 'hidden')}`}>
                    <div className={`${divWidth <= 800 ? "flex-col mt-16" : ""} flex gap-2`}>

                    </div>
                </div>
            </div>
            <div className='flex items-center justify-end gap-4'>
            <div className='flex justify-start items-center gap-3 '>
              <div className={`w-[40px] h-[40px] rounded-[4px] bg-center bg-cover shadow-md`}
                style={{ backgroundImage: `url(${PersonalImage})`, borderRadius: shapeImageShape}}>
              </div>
              <div className={`truncate w-[4rem] ${Language == "en" ? 'rtl' : 'ltr'}`}>
                abdallah mohamed
              </div>
            </div>
                {isOpen !== null && (
                    <button
                        onClick={() => setIsOpen(null)}
                        className='w-full h-full fixed inset-0 z-[100] transition-all duration-500'
                        style={{ display: isOpen ? 'block' : 'none' }}
                    >
                    </button>
                )}
            </div>
        </div>
    );
}

export default Header;



