
import React, { useState } from 'react';
import { MdOutlineDeliveryDining } from 'react-icons/md';
import { MdOutlineDoneAll } from 'react-icons/md';
import { LiaShoppingCartSolid } from 'react-icons/lia';
import { useSelector } from 'react-redux';
import Model from './Model';
import Login from './Login';

function Header() {
    const [isMenuOpen, setMenuOpen] = useState(false);
    const [isOpenModel1, setIsOpenModel1] = useState(null);
    const [isOpenModel2, setIsOpenModel2] = useState(null);
    const [showDetailesItem, setShowDetailesItem] = useState(false);
    function showMeDetailesItem() {
        if (!showDetailesItem) {
            setShowDetailesItem(true);
        } else {
            setShowDetailesItem(false);
        }
    }
    const toggleMenu = () => {
        setMenuOpen(!isMenuOpen);
    };
    const buttons = JSON.parse(sessionStorage.getItem('buttons'));
    const shapeImageShape = sessionStorage.getItem('shapeImageShape');
    const previewImage = sessionStorage.getItem('previewImage');
    const cartItems = useSelector((state) => state.cart.items);
    const GlobalColor = sessionStorage.getItem('globalColor');
    const handleModelClick1 = buttonId => {
        setIsOpenModel1(buttonId);
    };
    const handleModelClick2 = buttonId => {
        setIsOpenModel2(buttonId);
    };
    return (
        <div className={`flex items-start justify-between p-[12px] px-8 bg-[var(--secondary)]`}>
            <div className='flex flex-col'>
                <div className="lg:hidden">
                    <label className={` hamburger ${isMenuOpen ? "absolute top-[5px] z-[999999999]" : ""}`}
                        style={{
                            stroke: '#000000'
                        }} >
                        <input type="checkbox" checked={isMenuOpen} onChange={toggleMenu} />
                        <svg viewBox="0 0 32 32" >
                            <path className="line line-top-bottom"
    d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"/>
                            <path className="line" d="M7 16 27 16"></path>
                        </svg>
                    </label>
                </div>

                <div className={`lg:flex items-center justify-between gap-2 ${isMenuOpen ? 'block' : 'hidden'}`}>
                    <div className='flex max-lg:flex-col max-lg:mt-14 gap-2'>
                        <button
                            className='relative p-[6px] px-4 flex items-center justify-center gap-1 font-semibold'
                            onClick={handleModelClick1}
                            style={{
                                border: `1px solid ${buttons[0].color}`,
                                backgroundColor: 'transparent',
                                borderRadius: buttons[0].shape,
                            }}>
                            <MdOutlineDeliveryDining size={20} />
                            {isOpenModel1 ? (
                                <Model
                                    buttonId={1}
                                />
                            ) : <div></div>}
                            <div>{buttons[0].text}</div>
                        </button>
                        {isOpenModel1 !== null && (
                            <button
                                onClick={() => setIsOpenModel1(null)}
                                className='w-full h-full fixed inset-0 z-[80] transition-all duration-500'
                                style={{ display: isOpenModel1 ? 'block' : 'none' }}
                            >
                            </button>
                        )}
                        <button
                            className='relative p-[6px] px-4 flex items-center justify-center gap-1 font-semibold'
                            onClick={handleModelClick2}
                            style={{
                                border: `1px solid ${buttons[1].color}`,
                                backgroundColor: 'transparent',
                                borderRadius: buttons[1].shape,
                            }}
                        >
                            <MdOutlineDoneAll size={20} />
                            {isOpenModel2 ? (
                                <Model
                                    buttonId={2}
                                />
                            ) : <div></div>}
                            <div>{buttons[1].text}</div>
                        </button>
                        {isOpenModel2 !== null && (
                            <button
                                onClick={() => setIsOpenModel2(null)}
                                className='w-full h-full fixed inset-0 z-[80] transition-all duration-500'
                                style={{ display: isOpenModel2 ? 'block' : 'none' }}
                            >
                            </button>
                        )}
                    </div>
                </div>
            </div>
            <div className='flex items-center justify-between  gap-4'>
                <button className='relative p-1'
                    style={{
                        border: `1px solid ${GlobalColor}`,
                        borderRadius: "100%"
                    }}
                >
                    <LiaShoppingCartSolid size={26} />
                    <button
                        className='absolute top-[-7px] right-[-6px] text-[10px] text-bold h-[20px] w-[20px] rounded-full bg-red-500 text-white'>
                        <div>{cartItems.length}</div>
                    </button>
                </button>
                <button
                    className='p-[6px] px-4 flex items-center justify-center gap-1 font-semibold'
                    style={{ background: `${buttons[2].color}`, borderRadius: buttons[2].shape }}
                    onClick={showMeDetailesItem}
                    >
                    {buttons[2].text}
                </button>
                {showDetailesItem &&
                    <Login
                        onClose={showMeDetailesItem}
                        onRequest={showMeDetailesItem}
                    />
                }
            </div>
        </div>
    );
}

export default Header;

