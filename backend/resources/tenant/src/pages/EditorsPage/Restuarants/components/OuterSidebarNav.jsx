import React, {
    Fragment,
    useContext,
    useEffect,
    useRef,
    useState,
} from "react";
import homeIcon from "../../../../assets/homeIcon.svg";
import LoginIcon from "../../../../assets/login.svg";
import shopIcon from "../../../../assets/shopIcon.svg";
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg";
import dashboardIcon from "../../../../assets/dashboardIcon.svg";
import worldLangIcon from "../../../../assets/worldLang.svg";
import { IoMenuOutline } from "react-icons/io5";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { useAuthContext } from "../../../../components/context/AuthContext";
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../../../axios/axios";
import { changeLanguage } from "../../../../redux/languageSlice";
import { MenuContext } from "react-flexible-sliding-menu";
import PrimarySelectWithIcon from "./PrimarySelectWithIcon";
import {
    selectedCategoryAPI,
    setCategoriesAPI,
} from "../../../../redux/NewEditor/categoryAPISlice";
import * as Moment from "moment";
import { extendMoment } from "moment-range";
import LogoutButton from "../../../../components/Logout/LogoutButton";
import LanguageButton from "../../../../components/LanguageButton";

const OuterSidebarNav = ({ id }) => {
    const moment = extendMoment(Moment);

    const restuarantStyle = useSelector((state) => {
        return state.restuarantEditorStyle;
    });

    const branches = (function () {
        try {
            let tempBranches = [...restuarantStyle.branches];
            return tempBranches.map((branch) => {
                let isClosed = false;
                var currentDate = new Date();
                var currentHour = moment();

                switch (currentDate.getDay()) {
                    case 0:
                        isClosed = branch.sunday_closed !== 0;
                        if (!isClosed) {
                            const startSunday = moment(
                                branch.sunday_open,
                                "HH:mm:ss",
                            );
                            const endSunday = moment(
                                branch.sunday_close,
                                "HH:mm:ss",
                            );

                            const sundayRange = moment.range(
                                startSunday,
                                endSunday,
                            );
                            isClosed = !sundayRange.contains(currentHour);
                        }
                        break;
                    case 1:
                        isClosed = branch.monday_closed !== 0;
                        if (!isClosed) {
                            const startMonday = moment(
                                branch.monday_open,
                                "HH:mm:ss",
                            );
                            const endMonday = moment(
                                branch.monday_close,
                                "HH:mm:ss",
                            );

                            const mondayRange = moment.range(
                                startMonday,
                                endMonday,
                            );
                            isClosed = !mondayRange.contains(currentHour);
                        }
                        break;
                    case 2:
                        isClosed = branch.tuesday_closed !== 0;
                        if (!isClosed) {
                            const startTuesday = moment(
                                branch.tuesday_open,
                                "HH:mm:ss",
                            );
                            const endTuesday = moment(
                                branch.tuesday_close,
                                "HH:mm:ss",
                            );

                            const tuesdayRange = moment.range(
                                startTuesday,
                                endTuesday,
                            );
                            isClosed = !tuesdayRange.contains(currentHour);
                        }
                        break;
                    case 3:
                        isClosed = branch.wednesday_closed !== 0;
                        if (!isClosed) {
                            const startWednesday = moment(
                                branch.wednesday_open,
                                "HH:mm:ss",
                            );
                            const endWednesday = moment(
                                branch.wednesday_close,
                                "HH:mm:ss",
                            );

                            const wednesdayRange = moment.range(
                                startWednesday,
                                endWednesday,
                            );
                            isClosed = !wednesdayRange.contains(currentHour);
                        }
                        break;
                    case 4:
                        isClosed = branch.thursday_closed !== 0;
                        if (!isClosed) {
                            const startThursday = moment(
                                branch.thursday_closed,
                                "HH:mm:ss",
                            );
                            const endThursday = moment(
                                branch.thursday_close,
                                "HH:mm:ss",
                            );

                            const thursdayRange = moment.range(
                                startThursday,
                                endThursday,
                            );
                            isClosed = !thursdayRange.contains(currentHour);
                        }
                        break;
                    case 5:
                        isClosed = branch.friday_closed !== 0;
                        if (!isClosed) {
                            const startFriday = moment(
                                branch.friday_closed,
                                "HH:mm:ss",
                            );
                            const endFriday = moment(
                                branch.friday_close,
                                "HH:mm:ss",
                            );

                            const fridayRange = moment.range(
                                startFriday,
                                endFriday,
                            );
                            isClosed = !fridayRange.contains(currentHour);
                        }
                        break;
                    case 6:
                        isClosed = branch.saturday_closed !== 0;
                        if (!isClosed) {
                            const startSaturday = moment(
                                branch.saturday_closed,
                                "HH:mm:ss",
                            );
                            const endSaturday = moment(
                                branch.saturday_close,
                                "HH:mm:ss",
                            );

                            const saturdayRange = moment.range(
                                startSaturday,
                                endSaturday,
                            );
                            isClosed = !saturdayRange.contains(currentHour);
                        }
                        break;
                    default:
                        return branch;
                }

                return {
                    ...branch,
                    isClosed: `${isClosed ? "*" : ""}`,
                };
            });
        } catch (err) {
            console.log(err);
        }
    })();

    let branch_id = localStorage.getItem("selected_branch_id");

    const [selectedDeliveryBranch, setSelectedDeliveryBranch] = useState(null);
    const [selectedPickUpBranch, setSelectedPickBranch] = useState(null);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { t } = useTranslation();
    const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
    const { closeMenu } = useContext(MenuContext);

    const currentLanguage = useSelector(
        (state) => state.languageMode.languageMode,
    );

    const refOuterNav = useRef(null);

    useEffect(() => {
        document.addEventListener("keydown", hideOnEscape, true);
        document.addEventListener("click", hideOnClickOutside, true);

        const firstPickupBranch = pickupFirstBranch();
        const firstDeliveryBranch = deliveryFirstBranch();
        if (firstPickupBranch) {
            setSelectedPickBranch(firstPickupBranch);
            setSelectedDeliveryBranch(null);
        } else {
            setSelectedDeliveryBranch(firstDeliveryBranch);
            setSelectedPickBranch(null);
        }
    }, []);

    // hide on ESC press
    const hideOnEscape = (e) => {
        if (e.key === "Escape") {
            closeMenu();
        }
    };

    // Hide on outside click
    const hideOnClickOutside = (e) => {
        if (refOuterNav.current && !refOuterNav.current?.contains(e.target)) {
            closeMenu();
        }
    };

    // let branch_id = 2

    const fetchCategoriesData = async (id) => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(
                `categories?items&user&branch${
                    id ? `&selected_branch_id=${id}` : ""
                }`,
            );

            console.log(
                "editor rest restaurantCategoriesResponse OuterSidebarNav",
                restaurantCategoriesResponse.data,
            );
            if (restaurantCategoriesResponse.data) {
                dispatch(
                    setCategoriesAPI(restaurantCategoriesResponse.data?.data),
                );
                dispatch(
                    selectedCategoryAPI({
                        name: restaurantCategoriesResponse.data?.data[0].name,
                        id: restaurantCategoriesResponse.data?.data[0].id,
                    }),
                );

                console.log(">> branch_id >>", branch_id);

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

    const newLanguage = currentLanguage === "en" ? "ar" : "en";
    const buttonText =
        currentLanguage === "en" ? (
            <span title="Arabic">AR</span>
        ) : (
            <span title="English">EN</span>
        );

    useEffect(() => {
        if (selectedPickUpBranch?.id) {
            fetchCategoriesData(selectedPickUpBranch.id);
            localStorage.setItem("selected_branch_id", selectedPickUpBranch.id);
        }

        if (selectedDeliveryBranch?.id) {
            fetchCategoriesData(selectedDeliveryBranch?.id);
            localStorage.setItem(
                "selected_branch_id",
                selectedDeliveryBranch.id,
            );
        }
    }, [selectedPickUpBranch, selectedDeliveryBranch]);

    const handleRedirect = (role) => {
        console.log(role);
        if (role == "Customer") {
            navigate("/dashboard#Dashboard");
        } else if (role == "Driver") {
            window.open(window.location.href + "orders-all");
        } else {
            console.log(window.location.href);
            window.open(window.location.href + "summary");
        }
    };
    const role = localStorage.getItem("user-role");

    let pickupFirstBranch = () => {
        const defaultBranches = branches?.filter(
            (branch) =>
                branch.is_primary === 1 && branch.pickup_availability === 1,
        );
        if (defaultBranches?.length > 0) {
            return defaultBranches[0];
        } else {
            return branches?.filter(
                (branch) => branch.pickup_availability === 1,
            )[0];
        }
    };

    let deliveryFirstBranch = () => {
        const defaultBranches = branches?.filter(
            (branch) =>
                branch.is_primary === 1 && branch.delivery_availability === 1,
        );
        if (defaultBranches?.length > 0) {
            return defaultBranches[0];
        } else {
            return branches?.filter(
                (branch) => branch.delivery_availability === 1,
            )[0];
        }
    };

    const getPickUpDefaultVal = () => {
        if (selectedDeliveryBranch?.name) return "";
        if (selectedPickUpBranch?.name) {
            return selectedPickUpBranch.name + selectedPickUpBranch.isClosed;
        } else {
            return pickupFirstBranch().name + pickupFirstBranch().isClosed;
        }
    };

    const getDeliveryDefaultVal = () => {
        if (selectedPickUpBranch?.name) return "";
        if (selectedDeliveryBranch?.name) {
            return (
                selectedDeliveryBranch.name + selectedDeliveryBranch.isClosed
            );
        } else {
            return deliveryFirstBranch().name + deliveryFirstBranch().isClosed;
        }
    };

    return (
        <div
            ref={refOuterNav}
            className="w-full bg-white h-[100vh] flex flex-col items-center justify-between cursor-pointer"
        >
            <div onClick={closeMenu}>
                <IoMenuOutline
                    size={42}
                    className="text-neutral-400 cursor-pointer"
                />
            </div>
            <div className="w-full h-full flex flex-col items-center justify-center gap-6 cursor-pointer">
                <div
                    onClick={() => {
                        navigate("/");
                        closeMenu();
                    }}
                    className="w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer "
                    style={{
                        borderColor: restuarantStyle?.categoryDetail_cart_color,
                    }}
                >
                    <div className="w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center">
                        <img src={homeIcon} alt="home" />
                    </div>
                    <h3 className="">{t("Homepage")}</h3>
                </div>
                {/* pick up */}
                {branches?.some((e) => e.pickup_availability === 1) ? (
                    <PrimarySelectWithIcon
                        imgUrl={shopIcon}
                        text={t("PICKUP")}
                        defaultValue={getPickUpDefaultVal()}
                        onChange={(value) => {
                            setSelectedPickBranch(value);
                            setSelectedDeliveryBranch(null);
                        }}
                        options={
                            branches
                                ? branches?.filter(
                                      (branch) =>
                                          branch.pickup_availability === 1,
                                  )
                                : []
                        }
                    />
                ) : null}
                {/* delivery */}
                {branches?.some((e) => e.delivery_availability === 1) ? (
                    <PrimarySelectWithIcon
                        imgUrl={deliveryIcon}
                        text={t("Delivery")}
                        defaultValue={getDeliveryDefaultVal()}
                        onChange={(value) => {
                            setSelectedDeliveryBranch(value);
                            setSelectedPickBranch(null);
                        }}
                        options={
                            branches
                                ? branches?.filter(
                                      (branch) =>
                                          branch.delivery_availability === 1,
                                  )
                                : []
                        }
                    />
                ) : null}

                {/* login */}

                {isLoggedIn ? (
                    <>
                        {role == "Customer" ? (
                            <>
                                <Fragment>
                                    <div
                                        onClick={() => {
                                            handleRedirect(role);
                                            closeMenu();
                                        }}
                                        className="w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border items-center cursor-pointer"
                                        style={{
                                            borderColor:
                                                restuarantStyle?.categoryDetail_cart_color,
                                        }}
                                    >
                                        <div className="w-[60px] h-[50px] rounded-xl p-2 flex items-center justify-center">
                                            <img
                                                src={dashboardIcon}
                                                alt="home"
                                            />
                                        </div>
                                        <h3 className=""> {t("Dashboard")}</h3>
                                    </div>
                                </Fragment>
                            </>
                        ) : (
                            <Fragment>
                                <Fragment>
                                    <div
                                        onClick={() => {
                                            handleRedirect("Customer");

                                            closeMenu();
                                        }}
                                        className="w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer "
                                        style={{
                                            borderColor:
                                                restuarantStyle?.categoryDetail_cart_color,
                                        }}
                                    >
                                        <div className="w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center">
                                            <img
                                                src={dashboardIcon}
                                                alt="home"
                                            />
                                        </div>
                                        <h3 className="">
                                            {t("Dashboard Customer")}
                                        </h3>
                                    </div>
                                </Fragment>
                                <Fragment>
                                    <div
                                        onClick={() => {
                                            handleRedirect(role);
                                            closeMenu();
                                        }}
                                        className="w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer "
                                        style={{
                                            borderColor:
                                                restuarantStyle?.categoryDetail_cart_color,
                                        }}
                                    >
                                        <div className="w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center">
                                            <img
                                                src={dashboardIcon}
                                                alt="home"
                                            />
                                        </div>
                                        <h3 className="">
                                            {" "}
                                            {t("Dashboard Admin")}
                                        </h3>
                                    </div>
                                </Fragment>
                            </Fragment>
                        )}
                    </>
                ) : (
                    <Fragment>
                        {/* <div
              onClick={() => navigate("/register")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border cursor-pointer  items-center '
            >
  style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}             <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <BiSolidUserAccount size={25} />
              </div>
              <h3 className=''> {t("Create an account")} </h3>
            </div> */}

                        <div
                            onClick={() => {
                                navigate("/login");
                                closeMenu();
                            }}
                            className="w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg cursor-pointer border  items-center "
                            style={{
                                borderColor:
                                    restuarantStyle?.categoryDetail_cart_color,
                            }}
                        >
                            <div className="w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center">
                                <img src={LoginIcon} alt="home" />
                            </div>
                            <h3 className=""> {t("Login")} </h3>
                        </div>

                        {/* <div
              onClick={() => navigate("/login-admins")}
              className='w-[90%] mx-auto flex flex-row gap-3 cursor-pointer bg-neutral-100 rounded-lg border  items-center '
            >
  style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}             <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={LoginIcon} alt='home' />
              </div>
              <h3 className=''> {t("Management Area")} </h3>
            </div> */}
                    </Fragment>
                )}

                <LanguageButton id={id} />
            </div>

            <LogoutButton outerSidebarNav={true} />
        </div>
    );
};

export default OuterSidebarNav;
