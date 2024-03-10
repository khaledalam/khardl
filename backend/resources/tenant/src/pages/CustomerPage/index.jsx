import React, { useContext, useEffect, useState } from "react";
import SideNavbar from "./components/SideNavbar";
import NavbarCustomer from "./components/NavbarCustomer";
import { useSelector, useDispatch } from "react-redux";
import CustomerDashboard from "./components/CustomerDashboard";
import CustomerOrder from "./components/CustomerOrder";
import CustomerProfile from "./components/CustomerProfile";
import { useNavigate, useSearchParams } from "react-router-dom";
import CustomerOrderDetail from "./components/CustomerOrderDetail";
import { RiMenuFoldFill } from "react-icons/ri";
import CustomerPayment from "./components/CustomerPayment";
import {
    updateCardsList,
    updateOrderList,
} from "../../redux/NewEditor/customerSlice";
import AxiosInstance from "../../axios/axios";
import { useTranslation } from "react-i18next";
import {changeRestuarantEditorStyle} from "../../redux/NewEditor/restuarantEditorSlice";

export const CustomerPage = () => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { t } = useTranslation();
    const activeNavItem = useSelector(
        (state) => state.customerAPI.activeNavItem,
    );
    const cardsList = useSelector((state) => state.customerAPI.cardsList);
    const [searchParam] = useSearchParams();
    const [showOrderDetail, setShowOrderDetail] = useState(false);
    const [isMobile, setIsMobile] = useState(false);
    const [showMenu, setShowMenu] = useState(true);

    const TABS = {
        dashboard: t("Dashboard"),
        orders: t("Orders"),
        profile: t("Profile"),
        // payment: t("Payment"), // @TODO: Add it again once payment cards logic finished
    };

    let orderId = searchParam.get("orderId");

    console.log("chParam.get(orde >>", orderId);

    useEffect(() => {
        const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
            || window.innerWidth < 800;
        setIsMobile(isMobile);
        fetchResStyleData()
    }, []);

    useEffect(() => {
        if (orderId) {
            setShowOrderDetail(true);
        } else {
            setShowOrderDetail(false);
        }
    }, [orderId]);


    const fetchResStyleData = async () => {
        try {
            AxiosInstance.get(`restaurant-style`).then((response) =>
                dispatch(changeRestuarantEditorStyle(response.data?.data)),
            );
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

    const fetchOrdersData = async () => {
        try {
            const ordersResponse = await AxiosInstance.get(`orders?items&item`);

            console.log("ordersResponse >>>", ordersResponse.data);
            if (ordersResponse.data) {
                dispatch(
                    updateOrderList(Object.values(ordersResponse?.data?.data)),
                );
            }
        } catch (error) {
            console.log(error);
        } finally {
        }
    };

    // useEffect(() => {
    //   navigate("/dashboard#Dashboard")
    // }, [])

    const fetchCardsData = async () => {
        try {
            const cardsResponse = await AxiosInstance.get(`cards`);

            console.log("cardsResponse >>>", cardsResponse.data);
            if (cardsResponse.data) {
                dispatch(
                    updateCardsList(Object.values(cardsResponse?.data?.data)),
                );
            }
        } catch (error) {
            console.log(error);
        } finally {
        }
    };
    useEffect(() => {
        fetchOrdersData().then(() => {});
        fetchCardsData().then(() => {});
    }, []);



    console.log("showOrderDetail :> ", showOrderDetail);

    return (
        <div>
            <NavbarCustomer
                customerDashboard={true}
                setShowMenu={setShowMenu}
                showMenu={showMenu}
            />
            <div className="flex bg-white h-[calc(100vh-75px)] w-full transition-all">
                <div
                    className={`transition-all ${
                        (isMobile || !showMenu) ? "flex-[0] hidden w-0" : "flex-[20%]"
                    } xl:flex-[20%] laptopXL:flex-[17%] overflow-hidden bg-white h-full `}
                >
                    <SideNavbar />
                </div>
                <div
                    className={` transition-all ${
                        isMobile ? "flex-[100%] w-full" : "flex-[80%]"
                    } xl:flex-[80%] laptopXL:flex-[83%] overflow-x-hidden bg-neutral-100 h-full overflow-y-scroll hide-scroll`}
                >
                    {t(activeNavItem) === TABS.dashboard && !showOrderDetail ? (
                        <CustomerDashboard />
                    ) : t(activeNavItem) === TABS.orders && !showOrderDetail ? (
                        <CustomerOrder />
                    ) : t(activeNavItem) === TABS.profile && !showOrderDetail ? (
                        <CustomerProfile />
                    ) : t(activeNavItem) === TABS.payment && !showOrderDetail ? (
                        <CustomerPayment cardsList={cardsList} />
                    ) : (
                        <></>
                    )}
                    {showOrderDetail && orderId && (
                        <CustomerOrderDetail orderId={orderId} />
                    )}
                </div>
            </div>
        </div>
    );
};
