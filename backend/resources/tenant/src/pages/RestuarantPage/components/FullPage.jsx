import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { useState, useEffect } from "react";

import Header from "./Header";
// import Logo from "./Logo";
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
import { useNavigate } from "react-router-dom";

const FullPage = ({ categories }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { t } = useTranslation();
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
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

  useEffect(() => {
    const handleKeyDown = (event) => {
      if (event.keyCode === 27) {
        if (isLoginModalOpen) {
          dispatch(SetLoginModal(false));
        }
        if (isRegisterModalOpen) {
          dispatch(SetRegisterModal(false));
        }
      }
    };

    document.addEventListener("keydown", handleKeyDown);

    return () => {
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [isLoginModalOpen, isRegisterModalOpen, dispatch]);

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
          handleGotoCart={() => {
            if (!isLoggedIn) {
              dispatch(SetLoginModal(true));
            } else {
              navigate("/cart");
            }
          }}
        />
        {/* <Logo restaurantStyle={restaurantStyle} /> */}
        <Banner restaurantStyle={restaurantStyle} />
        <Category restaurantStyle={restaurantStyle} categories={categories} />
        <SocialMedia restaurantStyle={restaurantStyle} />
        <Footer restaurantStyle={restaurantStyle} />
      </div>
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
          <Login closingFunc={() => dispatch(SetLoginModal(false))} />
        </Modal>
      ) : isRegisterModalOpen ? (
        <Modal
          open={isRegisterModalOpen}
          onClose={() => dispatch(SetRegisterModal(false))}
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[400px] p-[10px]"
        >
          <Register closingFunc={() => dispatch(SetRegisterModal(false))} />
        </Modal>
      ) : (
        <>
          <div
            className={`fixed top-0 left-0 w-screen h-screen z-[999] bg-black bg-opacity-50 ${
              isModelOpen ? "" : "hidden"
            }`}
            onClick={() => setIsModelOpen(false)}
          />
          {/* <div className="relative"> */}
          <div
            className={`absolute z-[1000] top-[60px] ${
              isModelOpen ? "" : "hidden"
            } ${
              currentLanguage === "en"
                ? "left-auto ml-[4%]"
                : "right-auto mr-[4%]"
            }`}
          >
            <NewSideBar
              onClose={() => setIsModelOpen(false)}
              isBranchModelOpen={isBranchModelOpen}
              setIsBranchModelOpen={setIsBranchModelOpen}
            />

            {/* <Modal
              open={isModelOpen}
              onClose={() => setIsModelOpen(false)}
              className={`fixed ${
                currentLanguage == "en" ? "left-auto" : "right-auto"
              } top-[60px] md:top-[60px] ${
                currentLanguage == "en" ? "md:left-auto" : "md:right-auto"
              }`}
            ></Modal> */}
          </div>
          {/* </div> */}
        </>
      )}
    </div>
  );
};

export default FullPage;
