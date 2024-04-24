import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { useState, useEffect } from "react";

import Header from "./Header";
import Logo from "./Logo";
import Banner from "./Banner";
import Category from "./Category";
import SocialMedia from "./SocialMedia";
import Footer from "./Footer";
import Login from "./Login";
import Register from "./Register";

import {
    SetSideBar,
    SetLoginModal,
    SetRegisterModal,
} from "../../../redux/NewEditor/restuarantEditorSlice";
import Modal from "../../../components/Modal";
import NewSideBar from "../../../components/NewSideBar";
import Branches from "../../../components/Branches";

const FullPage = ({ categories }) => {
    const dispatch = useDispatch();
    const { t } = useTranslation();
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

    const { page_color, isSideBarOpen, isLoginModalOpen, isRegisterModalOpen } =
        restaurantStyle;

    let isModelOpen = isSideBarOpen;
    let setIsModelOpen = (value) => dispatch(SetSideBar(value));

    const currentLanguage = useSelector(
        (state) => state.languageMode.languageMode
    );

    const [isBranchModelOpen, setIsBranchModelOpen] = useState(false);
    useEffect(() => {
        if (isModelOpen === true && isBranchModelOpen === true) {
            () => setIsModelOpen(false);
        }
    }, [isBranchModelOpen]);

    useEffect(() => {
        setIsModelOpen(false);
    }, [isBranchModelOpen, isLoginModalOpen]);

    return (
        <div
            style={{
                backgroundColor: page_color,
            }}
            className=" h-full overflow-y-scroll hide-scroll"
        >
            <div
                style={{
                    backgroundColor: page_color,
                }}
                className="w-full h-full p-4 flex flex-col gap-[16px] relative mx-auto max-w-[1200px]"
            >
                <Header
                    restaurantStyle={restaurantStyle}
                    categories={categories}
                />
                <Logo restaurantStyle={restaurantStyle} />
                <Banner restaurantStyle={restaurantStyle} />
                <Category
                    restaurantStyle={restaurantStyle}
                    categories={categories}
                />
                <SocialMedia restaurantStyle={restaurantStyle} />
                <Footer restaurantStyle={restaurantStyle} />
                {isBranchModelOpen ? (
                    <Modal
                        open={isBranchModelOpen}
                        onClose={() => {
                            setIsBranchModelOpen(false);
                        }}
                        className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[680px]"
                    >
                        <Branches
                            closingFunc={() => {
                                setIsBranchModelOpen(false);
                            }}
                            closingFuncSideMenu={() => setIsModelOpen(false)}
                        />
                    </Modal>
                ) : isLoginModalOpen ? (
                    <Modal
                        open={isLoginModalOpen}
                        onClose={() => dispatch(SetLoginModal(false))}
                        className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[400px] p-[10px]"
                    >
                        <Login
                            closingFunc={() => dispatch(SetLoginModal(false))}
                        />
                    </Modal>
                ) : isRegisterModalOpen ? (
                    <Modal
                        open={isRegisterModalOpen}
                        onClose={() => dispatch(SetRegisterModal(false))}
                        className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[400px] p-[10px]"
                    >
                        <Register
                            closingFunc={() =>
                                dispatch(SetRegisterModal(false))
                            }
                        />
                    </Modal>
                ) : (
                    <Modal
                        open={isModelOpen}
                        onClose={() => setIsModelOpen(false)}
                        className={`fixed ${
                            currentLanguage == "en"
                                ? "left-[16px]"
                                : "right-[16px]"
                        } top-[88px] md:top-[104px] ${
                            currentLanguage == "en"
                                ? "md:left-[80px]"
                                : "md:right-[80px]"
                        }`}
                    >
                        <NewSideBar
                            onClose={() => setIsModelOpen(false)}
                            isBranchModelOpen={isBranchModelOpen}
                            setIsBranchModelOpen={setIsBranchModelOpen}
                        />
                    </Modal>
                )}
            </div>
        </div>
    );
};

export default FullPage;
