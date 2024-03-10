import React, { useEffect, useState } from "react";
import NavItem from "./NavItem";
import Dashboard from "../../../assets/dashboardWhiteIcon.svg";
import DashboardBlack from "../../../assets/dashboardBlockIcon.svg";
import OrderWhite from "../../../assets/orderWhite.svg";
import OrderBlack from "../../../assets/orderBlack.svg";
import ProfileIcon from "../../../assets/profileIcon.svg";
import ProfileWhiteIcon from "../../../assets/profileWhiteIcon.svg";
import CardIcon from "../../../assets/cardProfileIcon.svg";
import CardWhiteIcon from "../../../assets/CardProfileWhite.svg";
import { useDispatch, useSelector } from "react-redux";
import {
    setActiveNavItem,
    updateProfileSaveStatus,
} from "../../../redux/NewEditor/customerSlice";
import { useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";
import logoutIcon from "../../../assets/logout.svg";
import { logout } from "../../../redux/auth/authSlice";
import { HTTP_NOT_AUTHENTICATED } from "../../../config";
import { toast } from "react-toastify";
import { useAuthContext } from "../../../components/context/AuthContext";
import LogoutButton from "../../../components/Logout/LogoutButton";
import LanguageButton from "../../../components/LanguageButton";

const SideNavbar = () => {
    const dispatch = useDispatch();
    const { t } = useTranslation();
    const navigate = useNavigate();
    const [status, setStatus] = useState(true);
    const activeNavItem = useSelector(
        (state) => state.customerAPI.activeNavItem,
    );
    const saveProfileChange = useSelector(
        (state) => state.customerAPI.saveProfileChanges,
    );

    const navItems = [
        {
            id: 1,
            imgUrl: DashboardBlack,
            activeImgUrl: Dashboard,
            title: t("Dashboard"),
            link: "/dashboard#Dashboard",
        },
        {
            id: 2,
            imgUrl: OrderBlack,
            activeImgUrl: OrderWhite,
            title: t("Orders"),
            link: "/dashboard#Orders",
        },
        {
            id: 3,
            imgUrl: ProfileIcon,
            activeImgUrl: ProfileWhiteIcon,
            title: t("Profile"),
            link: "/dashboard#Profile",
        },
        // {
        //     id: 4,
        //     imgUrl: CardIcon,
        //     activeImgUrl: CardWhiteIcon,
        //     title: t("Payment"),
        //     link: "/dashboard#Payment",
        // },
    ];

    const pages = ["Profile", "Orders", "Dashboard"]; // @TODO: add Payment
    pages.forEach(function (page) {
        if (
            window.location.href.indexOf(`#${page.toLowerCase()}`) > -1 ||
            window.location.href.indexOf(`#${page.toUpperCase()}`) > -1 ||
            window.location.href.indexOf(
                `#${page.charAt(0).toUpperCase() + page.slice(1)}`,
            ) > -1
        ) {
            dispatch(setActiveNavItem(t(page)));
        }
    });

    const handleNavigate = (navItem) => {
        navigate(navItem.link);
    };

    useEffect(() => {
        if (!status) {
            dispatch(updateProfileSaveStatus(false));
        }
    }, [status]);

    console.log("status updated", status);
    console.log("saveProfile", saveProfileChange);

    return (
        <div className="mt-5">
            <div className="p-4 flex flex-col gap-4">
                {navItems.map((navItem) => (
                    <NavItem
                        key={navItem.id}
                        active={navItem.title === activeNavItem}
                        onClick={() => handleNavigate(navItem)}
                        title={navItem.title}
                        imgUrl={navItem.imgUrl}
                        activeImgUrl={navItem.activeImgUrl}
                    />
                ))}
            </div>

            <div className={"lg:hidden mt-5"}>
                <LanguageButton id={"test"} />

                <div className={"w-[100%] mx-auto p-1 mt-5"}>
                    <LogoutButton outerSidebarNav={false} />
                </div>
            </div>
        </div>
    );
};

export default SideNavbar;
