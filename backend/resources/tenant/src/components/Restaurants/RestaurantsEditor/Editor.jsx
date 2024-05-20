import React, { useState, useEffect, useRef } from "react";
import { useParams } from "react-router";
import Header from "./components/header";
import Hero from "./components/Hero";
import Footer from "./components/footer";
import { useSelector, useDispatch } from "react-redux";
import { Taps, Tap } from "../RestaurantsPreview/components/Taps";
import MenuItems from "../RestaurantsPreview/components/menuItems";
import { useTranslation } from "react-i18next";
import Logo from "./components/Logo";
import ResizeDetector from "react-resize-detector";
import { setDivWidth } from "../../../redux/editor/divWidthSlice";
import AxiosInstance from "../../../axios/axios";
import { getSelectedAlign } from "../../../redux/editor/alignSlice";
import { getSelectedCategory } from "../../../redux/editor/categorySlice";

const Editor = () => {
  const branch_id = localStorage.getItem("selected_branch_id");
  const [branch, setBranch] = useState(null);
  const [branches, setBranches] = useState([]);
  const [categories, setCategories] = useState([]);
  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
  const selectedFontFamily = useSelector(
    (state) => state.fonts.selectedFontFamily,
  );
  const selectedFontWeight = useSelector(
    (state) => state.fonts.selectedFontWeight,
  );
  const styleDataRestaurant = useSelector(
    (state) => state.styleDataRestaurant.styleDataRestaurant,
  );

  const dispatch = useDispatch();
  const selectedCategory = useSelector(getSelectedCategory);
  const selectedAlign = useSelector(getSelectedAlign);
  const Language = useSelector((state) => state.languageMode.languageMode);
  const { t } = useTranslation();

  const fetchData = async () => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch&selected_branch_id=${branch_id}`,
      );

      if (restaurantCategoriesResponse.data) {
        setCategories(restaurantCategoriesResponse.data?.data);

        if (!branch) {
          setBranch(restaurantCategoriesResponse.data?.data[0]?.branch?.id);
        }
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
    }
  };

  useEffect(() => {
    fetchData().then((r) => null);

    if (divRef.current) {
      const newWidth = divRef.current.clientWidth;
      if (newWidth <= 900) {
        dispatch(setDivWidth(900));
      } else {
        dispatch(setDivWidth(newWidth));
      }
    }
    handleResize();
    window.addEventListener("resize", handleResize);
    return () => {
      window.removeEventListener("resize", handleResize);
    };
  }, []);

  const categoriesForBranch = categories.filter(
    (category) => category?.branch?.id === branch,
  );

  const handleResize = () => {
    if (divRef.current) {
      dispatch(setDivWidth(divRef.current.clientWidth));
    }
  };

  if (!styleDataRestaurant) {
    return;
  }


  return (
    <div
      ref={divRef}
      className="w-[100%] bg-white h-[85vh] overflow-y-auto"
      style={{
        fontFamily: `${selectedFontFamily || styleDataRestaurant?.font_family}`,
        fontWeight: `${selectedFontWeight || styleDataRestaurant?.font_type}`,
        fontSize: `${selectedFontFamily || styleDataRestaurant?.font_size}`,
      }}
    >
      <Header />

      <div className="">
        {/*    /!*{branches?.length > 0 ?*!/*/}
        {/*    /!*    <div className={"w-[100%] flex items-center bg-[var(--primary)] h-[auto] m-4 p-1"}>*!/*/}
        {/*    /!*        <b className={"flex text-black"}>Branches:</b>*!/*/}
        {/*    /!*        {branches.map((branchItem, i) =>*!/*/}
        {/*    /!*            <span onClick={() => {*!/*/}
        {/*    /!*                setBranch(branchItem?.id);*!/*/}
        {/*    /!*                toast.info("branches changed to " + branchItem?.name );*!/*/}
        {/*    /!*            }} className={(branchItem?.id == branch ? 'border border-[red]' : '') + " m-1 flex justify-center content-center cursor-pointer w-[100px] flex bg-[var(--primary)]"} key={i}>{branchItem?.name}</span>)}*!/*/}
        {/*    /!*    </div>*!/*/}
        {/*    /!*: <h2>No branches yet! <a href={"/branches"} className={"m-1 flex justify-center content-center bg-[var(--primary)]"}>Add new branch</a></h2>}*!/*/}

        {/*    /!*<hr />*!/*/}

        <div
          className={`${selectedAlign === "Center" ? "justify-center" : ""}
        ${selectedAlign === "Left" && Language === "en" ? "justify-start" : selectedAlign === "Left" ? "justify-end" : ""}
        ${selectedAlign === "Right" && Language === "en" ? "justify-end" : selectedAlign === "Right" ? "justify-start" : ""}
        flex items-center  gap-4`}
        >
          <div className="my-[35px] mx-4 text-center">
            <Logo url={styleDataRestaurant?.logo} />
            <div className="flex justify-center items-center gap-2 mt-2">
              {/*<h2>العنوان</h2>*/}
              {/*<HiOutlineLocationMarker />*/}
            </div>
          </div>
        </div>
        <Hero />
      </div>

      <div
        className={`mt-[30px] mb-[50px] ${divWidth >= 744 ? "mx-[40px]" : ""}`}
      >
        <div>
          <div>
            <div className={`px-[30px] text-xl`}>
              {categoriesForBranch?.length > 0 ? (
                <>
                  <Taps
                    contentClassName={`
        bg-[var(--secondary)] ${selectedCategory === `${t("Carousel")}` ? `flex justify-center` : ""} text-xl
        ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}
                  >
                    {categoriesForBranch.map((category, i) => {
                      return (
                        <Tap
                          key={i}
                          component={
                            category?.items?.length > 0 ? (
                              <MenuItems
                                items={category?.items?.filter(
                                  (item) => item?.availability == "1",
                                )} // only availabile items
                                branch_id={category?.branch?.id}
                              />
                            ) : (
                              <h2 className={"m-4"}>
                                No items in this category yet!{" "}
                                <a
                                  target={"_blank"}
                                  href={`/menu/${category?.id}/${branch}`}
                                  className={"p-1 bg-[var(--primary)]"}
                                >
                                  Add items to this category
                                </a>
                              </h2>
                            )
                          }
                          contentClassName="text-black"
                        >
                          {category?.name}
                        </Tap>
                      );
                    })}
                  </Taps>
                </>
              ) : (
                <h2>
                  No categories yet!{" "}
                  <a
                    target={"_blank"}
                    href={"/branches"}
                    className={"p-1 bg-[var(--primary)]"}
                  >
                    Add new category
                  </a>
                </h2>
              )}
            </div>
          </div>
        </div>
      </div>
      <Footer />
      <ResizeDetector onResize={handleResize} />
    </div>
  );
};

export default Editor;
