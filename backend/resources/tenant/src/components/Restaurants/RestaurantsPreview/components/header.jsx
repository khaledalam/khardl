import React, {useContext, useEffect, useState} from 'react';
import {MdOutlineDeliveryDining, MdOutlineDoneAll} from 'react-icons/md';
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
import { MenuContext } from "react-flexible-sliding-menu";

function Header() {
    const [isSideMenuOpen, setIsSideMenuOpen] = useState(false);
    const { toggleMenu } = useContext(MenuContext);
    const dispatch = useDispatch();
    const { t } = useTranslation();
    const navigate = useNavigate();
    const styleDataRestaurant = useSelector((state) => state.styleDataRestaurant.styleDataRestaurant);
    const GlobalColor = styleDataRestaurant?.primary_color || sessionStorage.getItem('globalColor');
    const cartItemsCount = useSelector((state) => state.categoryAPI.cartItemsCount)

    useEffect(() => {
        fetchData().then(r => null);
        // fetchCartData().then(r => null);
    }, []);

    const toggleTheMenu = () => {
        toggleMenu();
        setIsSideMenuOpen(!isSideMenuOpen);
    }


    const fetchData = async () => {

        console.log("test ---- ", styleDataRestaurant);

        if (styleDataRestaurant) return;

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



    if (!styleDataRestaurant) return;


    let branch_id = localStorage.getItem('selected_branch_id');

    if (!branch_id) {
        branch_id = styleDataRestaurant?.branches[0]?.id;
    }


    return (
        <div className={`flex items-start justify-between p-[12px] px-8 bg-[var(--secondary)]`}>
            <div className='flex justify-between'>
    {/*            <div className={"d-none"}>*/}
    {/*                /!*className="lg:hidden">*!/*/}
    {/*                <label className={` hamburger ${isMenuOpen ? "absolute top-[5px] z-[999999999]" : ""}`}*/}
    {/*                    style={{*/}
    {/*                        stroke: '#000000'*/}
    {/*                    }} >*/}
    {/*                    <input type="checkbox" checked={isMenuOpen} onChange={toggleInnerMenu} />*/}
    {/*                    <svg viewBox="0 0 32 32" >*/}
    {/*                        <path className="line line-top-bottom"*/}
    {/*d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"/>*/}
    {/*                        <path className="line" d="M7 16 27 16"></path>*/}
    {/*                    </svg>*/}
    {/*                </label>*/}
    {/*            </div>*/}


                {/*hamburger icon*/}
                <button onClick={toggleTheMenu} className={"text-black border"} style={{
                    border: '1px solid var(--primary)',
                    fontSize: '17px',
                    fontWeight: 'bold',
                    padding: '5px 15px'
                }}>☰{/*{!isSideMenuOpen ? "☰" : "✖"}*/}</button>

            </div>

            <div className='flex items-center justify-between gap-4'>
                <button className='relative p-1 text-black'
                    onClick={() => navigate('/cart')}
                    style={{
                        border: `1px solid ${GlobalColor}`,
                        backgroundColor: 'transparent',
                        borderRadius: "100%"
                    }}
                >
                    <LiaShoppingCartSolid size={26} />
                    <span
                        className='text-center flex items-center justify-center absolute top-[-7px] right-[-6px] text-[10px] text-bold h-[20px] w-[20px] rounded-full bg-red-500 text-white'>
                        <div>{cartItemsCount}</div>
                    </span>
                </button>
            </div>



        </div>
    );
}

export default Header;
