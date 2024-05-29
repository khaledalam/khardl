import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { useState, useEffect, useCallback, useMemo } from "react";
import Skeleton from "react-loading-skeleton";
import Header from "./Header";
// import Logo from "./Logo";
import Banner from "./Banner";
import Category from "./Category";
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
  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode
  );

  const [isBranchModelOpen, setIsBranchModelOpen] = useState(false);

  const handleGotoCart = useCallback(() => {
    if (!isLoggedIn) {
      dispatch(SetLoginModal(true));
    } else {
      navigate("/cart");
    }
  }, [isLoggedIn, dispatch, navigate]);

  const handleCloseModal = useCallback(() => {
    if (isLoginModalOpen) dispatch(SetLoginModal(false));
    if (isRegisterModalOpen) dispatch(SetRegisterModal(false));
  }, [isLoginModalOpen, isRegisterModalOpen, dispatch]);

  useEffect(() => {
    const handleKeyDown = (event) => {
      if (event.keyCode === 27) {
        handleCloseModal();
      }
    };

    document.addEventListener("keydown", handleKeyDown);
    return () => {
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [handleCloseModal]);

  useEffect(() => {
    if (isModelOpen && isBranchModelOpen) {
      setIsModelOpen(false);
    }
  }, [isBranchModelOpen]);

  useEffect(() => {
    setIsModelOpen(false);
  }, [isBranchModelOpen, isLoginModalOpen]);

  const isModelOpen = useMemo(() => isSideBarOpen, [isSideBarOpen]);
  const setIsModelOpen = useCallback(
    (value) => dispatch(SetSideBar(value)),
    [dispatch]
  );

  return (
    <div
      style={{ backgroundColor: page_color }}
      className="h-full overflow-y-scroll hide-scroll"
    >
      <div
        style={{ backgroundColor: page_color }}
        className="w-full h-full p-2 pt-1 md:p-4 flex flex-col gap-[16px] relative mx-auto max-w-[1200px]"
      >
        <Header
          restaurantStyle={restaurantStyle}
          categories={categories}
          handleGotoCart={handleGotoCart}
        />
        {/* <Logo restaurantStyle={restaurantStyle} /> */}
        <Banner restaurantStyle={restaurantStyle} />
        {categories.length ? (
          <Category restaurantStyle={restaurantStyle} categories={categories} />
        ) : (
          <div className="min-h-[30px]">
            <Skeleton className="h-full" />
          </div>
        )}
        {/* <SocialMedia restaurantStyle={restaurantStyle} /> */}
        <Footer restaurantStyle={restaurantStyle} />
      </div>
      {isBranchModelOpen && (
        <Modal
          open={isBranchModelOpen}
          onClose={() => setIsBranchModelOpen(false)}
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[680px]"
        >
          <Branches closingFunc={() => setIsBranchModelOpen(false)} />
        </Modal>
      )}
      {isLoginModalOpen && (
        <Modal
          open={isLoginModalOpen}
          onClose={() => dispatch(SetLoginModal(false))}
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[400px] p-[10px]"
        >
          <Login closingFunc={() => dispatch(SetLoginModal(false))} />
        </Modal>
      )}
      {isRegisterModalOpen && (
        <Modal
          open={isRegisterModalOpen}
          onClose={() => dispatch(SetRegisterModal(false))}
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-[400px] p-[10px]"
        >
          <Register closingFunc={() => dispatch(SetRegisterModal(false))} />
        </Modal>
      )}
      {isModelOpen && (
        <>
          <div
            className="fixed top-0 left-0 w-screen h-screen z-[999] bg-black bg-opacity-50"
            onClick={() => setIsModelOpen(false)}
          />
          <div
            className={`absolute z-[1000] top-[60px] ${
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
          </div>
        </>
      )}
    </div>
  );
};

export default FullPage;
