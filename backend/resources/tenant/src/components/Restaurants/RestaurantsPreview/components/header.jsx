
import React, {useEffect, useState} from 'react';
import { MdOutlineDeliveryDining } from 'react-icons/md';
import { MdOutlineDoneAll } from 'react-icons/md';
import { LiaShoppingCartSolid } from 'react-icons/lia';
import {useDispatch, useSelector} from 'react-redux';
import Model from './Model';
import Login from './Login';
import Languages from "../../../Languages";
import Button from "../../../Button";
import {setIsOpen} from "../../../../redux/features/drawerSlice";
import {useNavigate} from "react-router-dom";
import {useTranslation} from "react-i18next";
import {useAuthContext} from "../../../context/AuthContext";
import {logout} from "../../../../redux/auth/authSlice";
import {HTTP_NOT_AUTHENTICATED} from "../../../../config";
import {toast} from "react-toastify";
import AxiosInstance from "../../../../axios/axios";
import {changeStyleDataRestaurant} from "../../../../redux/editor/styleDataRestaurantSlice";

function Header() {

    const [isMenuOpen, setMenuOpen] = useState(false);
    const [isOpenModel1, setIsOpenModel1] = useState(null);
    const [isOpenModel2, setIsOpenModel2] = useState(null);
    const [showDetailesItem, setShowDetailesItem] = useState(false);




    useEffect(() => {
        fetchData().then(r => null);
    }, []);

    const dispatch = useDispatch()
    const { t } = useTranslation()
    const { setStatusCode } = useAuthContext()
    const cartItems = useSelector((state) => state.cart.items);
    const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
    const navigate = useNavigate()
    const styleDataRestaurant = useSelector((state) => state.styleDataRestaurant.styleDataRestaurant);
    const GlobalColor = styleDataRestaurant?.primary_color || sessionStorage.getItem('globalColor');


    const handleModelClick2 = buttonId => {
        setIsOpenModel2(buttonId);
    };

    const fetchData = async () => {
        try {
            const restaurantStyleResponse = await AxiosInstance.get(`restaurant-style`)

            if (restaurantStyleResponse.data) {
                dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data));
            }

        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };
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


    const redirectToDashboard = () => {
        // Redirect to an external URL (window.location.href)
        window.location.href = '/dashboard';
    };
    const handleLogout = async (e) => {
        e.preventDefault()

        try {
            await dispatch(logout({ method: 'POST' })).unwrap()
                .then(res => {
                    setStatusCode(HTTP_NOT_AUTHENTICATED)
                    setStatusCode(HTTP_NOT_AUTHENTICATED)
                    navigate('/login', { replace: true })
                    toast.success('Logged out successfully')
                })
        } catch (err) {
            console.error(err.message)
            toast.error(`${t('Logout failed')}`)
        }
        dispatch(setIsOpen(false))
    }

    if (!styleDataRestaurant) return;

    const buttons = styleDataRestaurant?.buttons || JSON.parse(sessionStorage.getItem('buttons'));

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

                        {isOpenModel1 !== null && (
                            <span
                                onClick={() => setIsOpenModel1(null)}
                                className='w-full h-full fixed inset-0 z-[80] transition-all duration-500'
                                style={{ display: isOpenModel1 ? 'block' : 'none' }}
                            >
                            </span>
                        )}
                        <span
                            className='relative p-[6px] px-4 flex items-center justify-center gap-1 font-semibold'
                            onClick={handleModelClick2}
                            style={{
                                border: `1px solid ${buttons[1]?.color || ''}`,
                                backgroundColor: 'transparent',
                                borderRadius: buttons[1]?.shape || '',
                            }}
                        >
                            <MdOutlineDoneAll size={20} />
                            {isOpenModel2 ? (
                                <Model
                                    buttonId={2}
                                />
                            ) : <div></div>}
                            <div>{t(buttons[1]?.text) || ''}</div>
                        </span>
                        {isOpenModel2 !== null && (
                            <span
                                onClick={() => setIsOpenModel2(null)}
                                className='w-full h-full fixed inset-0 z-[80] transition-all duration-500'
                                style={{ display: isOpenModel2 ? 'block' : 'none' }}
                            >
                            </span>
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
                    <span
                        className='absolute top-[-7px] right-[-6px] text-[10px] text-bold h-[20px] w-[20px] rounded-full bg-red-500 text-white'>
                        <div>{cartItems.length}</div>
                    </span>
                </button>
                <button
                    className='p-[6px] px-4 flex items-center justify-center gap-1 font-semibold'
                    style={{ background: `${buttons[2]?.color || ''}`, borderRadius: buttons[2]?.shape || '' }}
                    onClick={showMeDetailesItem}
                    >
                    {t(buttons[2]?.text) || ''}
                </button>
                {showDetailesItem &&
                    <Login
                        onClose={showMeDetailesItem}
                        onRequest={showMeDetailesItem}
                    />
                }
            </div>

            <div className='flex items-center justify-between gap-2'>
                <Languages />
                <div className='relative flex items-center gap-2 justify-center'>
                    {isLoggedIn ? (
                        <>
                            <Button
                                onClick={redirectToDashboard}
                                title={t('Dashboard')}
                                classContainer='!text-[16px] !px-[16px] !py-[6px] !font-medium '
                            />
                            <Button
                                title={t('Logout')}
                                onClick={handleLogout}
                                classContainer='!w-100 !px-[16px] !font-medium !bg-[var(--danger)]'
                            />
                        </>
                    ) : (
                        <>
                            <Button
                                title={t('Create an account')}
                                link='/register'
                                onClick={() => dispatch(setIsOpen(false))}
                                classContainer='!w-100 !px-[25px]'
                            />
                            <Button
                                title={t('Login')}
                                link='/login'
                                onClick={() => dispatch(setIsOpen(false))}
                                classContainer='!w-100 !px-[16px] !font-medium'
                                style={{
                                    border: `1px solid ${buttons[0]?.color || ''}`,
                                    backgroundColor: 'transparent',
                                    borderRadius: buttons[0]?.shape || '',
                                }}
                            />
                        </>
                    )}
                </div>
            </div>

        </div>
    );
}

export default Header;

