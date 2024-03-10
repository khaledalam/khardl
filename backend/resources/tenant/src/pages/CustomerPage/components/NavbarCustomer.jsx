import React, { useContext, useEffect, useState } from "react";
import { IoMenuOutline } from "react-icons/io5";
import { useNavigate } from "react-router-dom";
import cartHeaderImg from "../../../assets/cartBoldIcon.svg";
import { MenuContext } from "react-flexible-sliding-menu";
import { useDispatch, useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { getCartItemsCount } from "../../../redux/NewEditor/categoryAPISlice";
import MobileMenu from "../components/MobileMenu";

const NavbarCustomer = ({ customerDashboard = false }) => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { toggleMenu } = useContext(MenuContext);
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
    // const [cartItemsCount, setCartItemsCount] = useState(0);
    const cartItems = useSelector((state) => state.cart.items);
    const cartItemsCount = useSelector(
        (state) => state.categoryAPI.cartItemsCount,
    );
    const isLoggedIn = JSON.parse(localStorage.getItem("isLoggedIn"));

    const fetchCartData = async () => {
        if (isLoggedIn == true) {
            try {
                const cartResponse = await AxiosInstance.get(`carts/count`);
                if (cartResponse.data) {
                    const count = cartResponse.data?.data?.count || 0;
                    dispatch(getCartItemsCount(count));
                }
            } catch (error) {
                // toast.error(`${t('Failed to send verification code')}`)
                console.log(error);
            }
        } else {
            console.log("user Unauthenticated");
        }
    };

    useEffect(() => {
        fetchCartData().then(() => {
            console.log("fetched cart items count successfully");
        });
    }, []);

    return (
        <div className="h-[70px] w-full bg-white flex items-center justify-between px-4 xl:px-8">
            {customerDashboard && <MobileMenu />}
            {window.innerWidth > 700 && (
                <IoMenuOutline
                    size={42}
                    className="text-neutral-400 cursor-pointer xl:ml-16"
                    onClick={toggleMenu}
                />
            )}
            <div
                onClick={() => navigate("/cart")}
                className="w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer"
            >
                <img src={cartHeaderImg} alt={"cart"} className="" />
                {cartItemsCount > 0 && (
                    <div className="absolute top-[-0.5rem] right-[-0.5rem]">
                        <div className="w-[20px] h-[20px] rounded-full p-1 bg-red-500 flex items-center justify-center">
                            <span className="text-white font-bold text-xs">
                                {cartItemsCount}
                            </span>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
};

export default NavbarCustomer;
