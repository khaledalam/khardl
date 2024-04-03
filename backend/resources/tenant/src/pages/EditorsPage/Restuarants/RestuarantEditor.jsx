import React, { useEffect, useState } from "react";
import Navbar from "./components/Navbar";
import SidebarEditor from "./components/SidebarEditor";
import MainBoardEditor from "./components/MainBoardEditor";
import AxiosInstance from "../../../axios/axios";
import { useDispatch, useSelector } from "react-redux";
import { changeStyleDataRestaurant } from "../../../redux/editor/styleDataRestaurantSlice";
import {
    changeRestuarantEditorStyle,
    setSidebarCollapse,
} from "../../../redux/NewEditor/restuarantEditorSlice";
import {
    getCartItemsCount,
    setCategoriesAPI,
} from "../../../redux/NewEditor/categoryAPISlice";
import HeaderEdit from "./components/HeaderEdit";
import { LeftSideBar } from "./components/LeftSideBar";
import { RightSideBar } from "./components/RightSideBar";

export const RestuarantEditor = () => {
    const [isLoading, setIsLoading] = useState(true);

    const dispatch = useDispatch();
    const categories = useSelector((state) => state.categoryAPI.categories);

    const isSidebarCollapse = useSelector(
        (state) => state.restuarantEditorStyle.collapse_sidebar,
    );
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
    console.log("karim - restaurantStyle : ", restaurantStyle);
    const template = useSelector(
        (state) => state.restuarantEditorStyle.template,
    );

    const handleSidebarCollapse = () => {
        dispatch(setSidebarCollapse(!isSidebarCollapse));
    };

    const fetchResStyleData = async () => {
        try {
            const restaurantStyleResponse =
                await AxiosInstance.get(`restaurant-style`);

            if (restaurantStyleResponse.data) {
                dispatch(
                    changeStyleDataRestaurant(
                        restaurantStyleResponse.data?.data,
                    ),
                );
                dispatch(
                    changeRestuarantEditorStyle(
                        restaurantStyleResponse.data?.data,
                    ),
                );
            }
            setIsLoading(false);
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            setIsLoading(false);
            console.log(error);
        }
    };
    let branch_id = localStorage.getItem("selected_branch_id");

    const fetchCategoriesData = async () => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(
                `categories?items&user&branch${
                    branch_id ? `&selected_branch_id=${branch_id}` : ""
                }`,
            );

            console.log(
                "editor rest restaurantCategoriesResponse RestuarantEditor",
                restaurantCategoriesResponse.data,
            );
            if (restaurantCategoriesResponse.data) {
                dispatch(
                    setCategoriesAPI(restaurantCategoriesResponse.data?.data),
                );


                if (!branch_id) {
                    branch_id =
                        restaurantCategoriesResponse.data?.data[0]?.branch?.id;
                    localStorage.setItem("selected_branch_id", branch_id);
                }
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

    useEffect(() => {
        fetchCategoriesData().then(() => {});
        fetchResStyleData().then(() => {});
    }, []);

    return (
        <div className="block" style={
            {fontFamily: "Plus Jakarta Sans, sans-serif"}
        }>
            <Navbar toggleSidebarCollapse={handleSidebarCollapse} />
            <div className="flex bg-[#EEEEEE] h-[100vh] w-full transition-all hide-scroll">
                <div
                    className={`transition-all ${
                        isSidebarCollapse ? "flex-[0] hidden w-0" : "flex-[20%]"
                    } xl:flex-[20%] laptopXL:flex-[25%] overflow-x-hidden bg-white h-[646px] border-r border-[rgba(0,0,0,0.3)]`}
                >
                    {/* <SidebarEditor /> */}
                    <LeftSideBar />
                </div>
                <div
                    className={` transition-all h-full ${
                        isSidebarCollapse ? "flex-[100%] w-full" : "flex-[60%]"
                    } xl:flex-[80%] laptopXL:flex-[50%] overflow-x-hidden bg-neutral-200`}
                >
                    {template === "template-1" && (
                        <div className="w-full h-full  flex flex-col gap-2">
                            {restaurantStyle?.headerPosition === "fixed" && (
                                <div className="p-2">
                                    <HeaderEdit
                                        restaurantStyle={restaurantStyle}
                                        toggleSidebarCollapse={
                                            handleSidebarCollapse
                                        }
                                    />
                                </div>
                            )}
                            <div className=" h-full overflow-y-scroll hide-scroll">
                                <MainBoardEditor
                                    isLoading={isLoading}
                                    categories={categories}
                                    toggleSidebarCollapse={
                                        handleSidebarCollapse
                                    }
                                />
                            </div>
                        </div>
                    )}
                </div>
                <div
                    className={`transition-all ${
                        isSidebarCollapse ? "flex-[0] hidden w-0" : "flex-[20%]"
                    } xl:flex-[20%] laptopXL:flex-[25%] overflow-x-hidden h-[646px] bg-white border-l border-[rgba(0,0,0,0.3)]`}
                >
                    {/* <SidebarEditor /> */}
                    <RightSideBar />
                </div>
            </div>
        </div>
    );
};
