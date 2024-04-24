import { useTranslation } from "react-i18next";
import * as Moment from "moment";
import { extendMoment } from "moment-range";
import { useDispatch, useSelector } from "react-redux";

import LocationIcon from "../assets/locationIcon.png";
import PhoneIcon from "../assets/phoneIcon.png";
import CalendarIcon from "../assets/calendarIcon.png";

import AxiosInstance from "../axios/axios";
import {
    selectedCategoryAPI,
    setCategoriesAPI,
} from "../redux/NewEditor/categoryAPISlice";

import { useState, useEffect } from "react";

import Modal from "./Modal";

import DoubleRightArrows from "../assets/doubleRightArrows.png";
import XIcon from "../assets/xIcon.png";
import { set } from "react-hook-form";

const Branches = ({ closingFunc, closingFuncSideMenu }) => {
    console.log("Closing: ", closingFunc);
    const { t } = useTranslation();
    const dispatch = useDispatch();

    const moment = extendMoment(Moment);

    const restuarantStyle = useSelector((state) => {
        return state.restuarantEditorStyle;
    });

    console.log(
        "currently branches :",
        localStorage.getItem("selected_branch_id")
    );

    useEffect(() => {
        setSelectedBranch(localStorage.getItem("selected_branch_id") - 1);
    }, []);

    const branches = (function () {
        try {
            let tempBranches = [...restuarantStyle.branches];
            console.log("tempBranches", tempBranches);
            return tempBranches.map((branch) => {
                let isClosed = false;
                var currentHour = moment();
                var currentDay = currentHour.format("dddd").toLowerCase();
                let isBranchClosed = eval("branch." + currentDay + "_closed");
                isClosed = isBranchClosed !== 0;
                if (!isClosed) {
                    let branchStart = moment(
                        eval("branch." + currentDay + "_open"),
                        "HH:mm:ss"
                    );
                    let branchEnd = moment(
                        eval("branch." + currentDay + "_close"),
                        "HH:mm:ss"
                    );
                    let branchRage = moment.range(branchStart, branchEnd);
                    isClosed = !branchRage.contains(currentHour);
                }

                return {
                    ...branch,
                    isClosed: isClosed ? true : false,
                };
            });
        } catch (err) {
            console.log(err);
        }
    })();

    console.log("branches", branches);
    const [selectedBranch, setSelectedBranch] = useState(null);

    let branch_id = localStorage.getItem("selected_branch_id");

    const fetchCategoriesData = async (id) => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(
                `categories?items&user&branch${
                    id ? `&selected_branch_id=${id}` : ""
                }`
            );

            console.log(
                "editor rest restaurantCategoriesResponse OuterSidebarNav",
                restaurantCategoriesResponse.data
            );
            if (restaurantCategoriesResponse.data) {
                dispatch(
                    setCategoriesAPI(restaurantCategoriesResponse.data?.data)
                );
                dispatch(
                    selectedCategoryAPI({
                        name: restaurantCategoriesResponse.data?.data[0].name,
                        id: restaurantCategoriesResponse.data?.data[0].id,
                    })
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

    const handleSelectBranch = () => {
        if (selectedBranch !== null) {
            fetchCategoriesData(branches[selectedBranch].id);
            localStorage.setItem(
                "selected_branch_id",
                branches[selectedBranch].id
            );
            console.log("ide: ", branches[selectedBranch].id);
            console.log("closingFunc: ", closingFunc);
            closingFunc();
            closingFuncSideMenu();
        }
    };

    const [isWorkingHours, setIsWorkingHours] = useState(false);
    const [selectedDay, setSelectedDay] = useState("thursday");
    const [currentBranch, setCurrentBranch] = useState(null);

    return (
        <div className="w-full max-w-[680px] mx-auto bg-white rounded-[10px] flex flex-col items-center px-[32px] pt-[16px] relative">
            <div className="w-full max-w-[616px] mx-auto mb-[24px] h-10 bg-orange-100 bg-opacity-30 rounded-[50px] border border-orange-100 flex justify-center items-center">
                <div className="text-black text-xs font-semibold font-['Plus Jakarta Sans']">
                    {t("Branches")}
                </div>
            </div>
            <div className="w-full flex flex-col items-center mb-[24px] space-y-[24px]">
                {branches.map((branch, index) => (
                    <div
                        key={index}
                        onClick={() => setSelectedBranch(index)}
                        className="w-full max-w-[616px] flex justify-between p-[16px] bg-white rounded-[10px] shadow border border-black border-opacity-10 relative"
                    >
                        {console.log("branch index: ", index)}
                        {console.log("select index: ", selectedBranch)}
                        <div className="flex flex-col">
                            <div className="mb-[18px] flex flex-row items-center">
                                <div className="w-[30px] h-[30px] mr-[8px]">
                                    <img
                                        src={restuarantStyle?.logo}
                                        alt="Branch Image"
                                        className="w-full h-full"
                                    />
                                </div>
                                <div className="text-black text-[16px] font-medium">
                                    {branch.name}
                                </div>
                                <div className="text-black/[0.77] text-[13px] font-medium">
                                    ~ Jeddah
                                </div>
                            </div>
                            <div className="flex flex-row ">
                                <a
                                    href={`https://www.google.com/maps/search/?api=1&query=${branch.lat},${branch.lng}`}
                                    target="_blank"
                                    className="w-[25px] h-[25px] md:w-[35px] md:h-[35px] bg-orange-100 bg-opacity-30 rounded-full flex justify-center items-center mx-[8px]"
                                >
                                    <img
                                        className="w-[7.63px] h-[7.63px] md:w-[11px] md:h-[11px]"
                                        src={LocationIcon}
                                        alt="Location Icon"
                                    />
                                </a>
                                <a
                                    href={`tel:+1234567890`}
                                    className="w-[25px] h-[25px] md:w-[35px] md:h-[35px] bg-orange-100 bg-opacity-30 rounded-full flex justify-center items-center mx-[8px]"
                                >
                                    <img
                                        className="w-[7.63px] h-[7.63px] md:w-[11px] md:h-[11px]"
                                        src={PhoneIcon}
                                        alt="Location Icon"
                                    />
                                </a>
                                <div
                                    onClick={() => {
                                        setIsWorkingHours(true);
                                        setCurrentBranch(branch);
                                    }}
                                    className="w-[25px] h-[25px] md:w-[35px] md:h-[35px] bg-orange-100 bg-opacity-30 rounded-full flex justify-center items-center mx-[8px]"
                                >
                                    <img
                                        className="w-[7.63px] h-[7.63px] md:w-[11px] md:h-[11px]"
                                        src={CalendarIcon}
                                        alt="Location Icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div className="flex flex-col items-end">
                            {!branch.isClosed ? (
                                <div className="w-20 h-[21px] mb-[16px] bg-orange-100 bg-opacity-30 rounded-[50px] border flex justify-center items-center">
                                    <div className="text-black text-[10px] font-medium">
                                        {t("OPEN")}
                                    </div>
                                </div>
                            ) : (
                                <div className="w-20 h-[21px] mb-[16px] bg-orange-100 bg-opacity-10 rounded-[50px] border flex justify-center items-center">
                                    <div className="text-black text-opacity-30 text-[10px] font-medium">
                                        {t("CLOSE")}
                                    </div>
                                </div>
                            )}
                            <div className="flex flex-col space-y-[8px]">
                                {branch.delivery_availability ? (
                                    <div className="w-12 h-4 bg-red-900 rounded-[50px] border flex justify-center items-center">
                                        <div className="text-white text-[8px] font-medium">
                                            {t("Delivery")}
                                        </div>
                                    </div>
                                ) : null}
                                {branch.pickup_availability && (
                                    <div className="w-12 h-4 bg-red-900 rounded-[50px] border flex justify-center items-center">
                                        <div className="text-white text-[8px] font-medium">
                                            {t("Pickup")}
                                        </div>
                                    </div>
                                )}
                            </div>
                        </div>
                        {selectedBranch == index && (
                            <div className="w-[25px] h-[25px] absolute right-[-12px] top-[-12px] bg-orange-100 rounded-full flex justify-center items-center">
                                <div className="">✓</div>
                            </div>
                        )}
                    </div>
                ))}
            </div>
            <div
                onClick={handleSelectBranch}
                className="w-full max-w-[616px] h-10 bg-red-900 rounded-tl-[30px] rounded-tr-[30px] flex justify-center items-center"
            >
                <div className="text-center text-white text-xs font-medium">
                    {t("Select this branch")}
                </div>
            </div>
            <Modal
                open={isWorkingHours}
                onClose={() => setIsWorkingHours(false)}
                noBackground={true}
                className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full flex justify-center"
            >
                <div className="w-[350px] h-[223px] relative bg-white rounded-[10px] shadow border">
                    <div className="w-[302px] h-10 left-[24px] top-[24px] absolute flex space-x-[4px]">
                        <div
                            onClick={() => setSelectedDay("monday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "monday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("MON")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("tuesday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "tuesday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("TUE")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("wednesday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "wednesday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("WED")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("thursday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "thursday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("THU")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("friday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "friday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("FRI")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("saturday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "saturday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("SAT")}
                        </div>
                        <div
                            onClick={() => setSelectedDay("sunday")}
                            className={`w-10 h-10 rounded-[13px] border border-red-900 flex justify-center items-center ${
                                selectedDay == "sunday"
                                    ? "text-white text-[10px] font-semibold bg-red-900"
                                    : "text-black text-[8px] font-normal bg-white"
                            }`}
                        >
                            {t("SUN")}
                        </div>
                    </div>
                    <div className="left-[113px] top-[104px] absolute text-black text-xs font-normal font-['Plus Jakarta Sans']">
                        {t("Branch working hours")}
                    </div>
                    <div className="w-[250px] h-16 left-[50px] top-[135px] absolute">
                        <div className="w-[250px] h-16 left-0 top-0 absolute bg-orange-100 bg-opacity-30 rounded-[50px]" />
                        <div className="w-[37.50px] h-[14.86px] left-[20px] top-[11.43px] absolute text-black text-[10px] font-light font-['Plus Jakarta Sans']">
                            {t("FROM")}
                        </div>
                        <div className="w-[17.50px] h-[14.86px] left-[168.75px] top-[11.43px] absolute text-black text-[10px] font-light font-['Plus Jakarta Sans']">
                            {t("TO")}
                        </div>
                        <div className="w-[72.50px] h-[17.14px] left-[20px] top-[34.29px] absolute text-black text-xs font-medium font-['Plus Jakarta Sans']">
                            {currentBranch?.[selectedDay + "_open"]
                                ? currentBranch?.[selectedDay + "_open"]
                                : "00:00:00"}
                        </div>
                        <div className="w-[67.50px] h-[17.14px] left-[168.75px] top-[34.29px] absolute text-black text-xs font-medium font-['Plus Jakarta Sans']">
                            {currentBranch?.[selectedDay + "_closed"]
                                ? currentBranch?.[selectedDay + "_closed"]
                                : "00:00:00"}
                        </div>
                        <img
                            className="w-[12.50px] h-[11.43px] left-[118.75px] top-[36.57px] absolute"
                            src={DoubleRightArrows}
                        />
                    </div>
                    <div
                        onClick={() => setIsWorkingHours(false)}
                        className="w-[25px] h-[25px] bg-white flex justify-center items-center rounded-full border border-black border-opacity-30 absolute right-0 top-[-30px]"
                    >
                        <img
                            src={XIcon}
                            alt="x icon"
                            className="w-[6.25px] h-[6.25px]"
                        />
                    </div>
                </div>
            </Modal>
            <div
                onClick={() => closingFunc()}
                className="w-[25px] h-[25px] bg-white flex justify-center items-center rounded-full border border-black border-opacity-30 absolute right-0 top-[-30px]"
            >
                <img
                    src={XIcon}
                    alt="x icon"
                    className="w-[6.25px] h-[6.25px]"
                />
            </div>
        </div>
    );
};

export default Branches;
