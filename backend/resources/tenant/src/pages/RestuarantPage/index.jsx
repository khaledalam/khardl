import React, { useEffect, useState } from "react";
import Herosection from "./components/Herosection";
import ProductSection from "./components/ProductSection";
import FooterRestuarant from "./components/Footerr";
import FullPage from "./components/FullPage";
import AxiosInstance from "../../axios/axios";
import { useDispatch, useSelector } from "react-redux";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import {
  getCartItemsCount,
  selectedCategoryAPI,
  setCategoriesAPI,
} from "../../redux/NewEditor/categoryAPISlice";
import { Helmet } from "react-helmet";
import { useTranslation } from "react-i18next";

export const RestuarantHomePage = () => {
  const dispatch = useDispatch();
  const { t } = useTranslation();
  const [isMobile, setIsMobile] = useState(false);
  const [isLoading, setisLoading] = useState(true);
  const [isCatLoading, setIsCatLoading] = useState(true);
  const categories = useSelector((state) => state.categoryAPI.categories);

  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
  const restaurantStyleVersion = useSelector(
    (state) => state.styleDataRestaurant.restaurantStyleVersion
  );
  const branches = restaurantStyle.branches;

  let branch_id = localStorage.getItem("selected_branch_id");
  // let branch_id = 2

  const fetchCategoriesData = async (id) => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch${
          branch_id
            ? `&selected_branch_id=${branch_id}`
            : id
            ? `&selected_branch_id=${id}`
            : ""
        }`
      );
      // const restaurantCategoriesResponse =[];

      if (
        restaurantCategoriesResponse.data &&
        restaurantCategoriesResponse.data?.data &&
        restaurantCategoriesResponse.data?.data.length > 0
      ) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data));
        dispatch(
          selectedCategoryAPI({
            name: restaurantCategoriesResponse.data?.data[0].name,
            id: restaurantCategoriesResponse.data?.data[0].id,
          })
        );

        if (!branch_id && id) {
          //if no branch id in local storage and id passed to fetch cats
          //then set local storage to this id
          branch_id = id;
          localStorage.setItem("selected_branch_id", branch_id);
        } else {
          //if there is branch id or no branch id and no id passed
          //then set branch in local storage to this in cat response
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id;
          localStorage.setItem("selected_branch_id", branch_id);
        }
      } else {
        console.log("error");
      }
      setIsCatLoading(false);
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
      setIsCatLoading(false);
    }
  };
  const fetchResStyleData = async () => {
    try {
      if (
        localStorage.getItem("restaurantStyleVersion") == restaurantStyleVersion
      ) {
        dispatch(
          changeRestuarantEditorStyle(JSON.parse(localStorage.getItem("restaurantStyle")))
        );
      } else {
        localStorage.setItem("restaurantStyleVersion", restaurantStyleVersion);
        AxiosInstance.get(`restaurant-style`).then((response) => {
          localStorage.setItem("restaurantStyle", JSON.stringify(response.data?.data));
          dispatch(changeRestuarantEditorStyle(response.data?.data));
        });
      }
      setisLoading(false);
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      setisLoading(false);
    }
  };
  useEffect(() => {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    setIsMobile(isMobile);
  }, []);

  useEffect(() => {
    fetchResStyleData();
    fetchCategoriesData().then(() => {});
  }, []);

  // let pickupFirstBranch =
  //     branches?.filter((branch) => branch.pickup_availability === 1)[0] ||
  //     false;

  // let deliveryFirstBranch =
  //     branches?.filter((branch) => branch.delivery_availability === 1)[0] ||
  //     false;

  // useEffect(() => {
  //     if (pickupFirstBranch && pickupFirstBranch?.id && !branch_id) {
  //         fetchCategoriesData(pickupFirstBranch.id);
  //     } else {
  //         if (deliveryFirstBranch && deliveryFirstBranch?.id) {
  //             fetchCategoriesData(deliveryFirstBranch.id);
  //         }
  //     }
  // }, [branches, pickupFirstBranch, deliveryFirstBranch]);

  if (isLoading || !restaurantStyle) {
    return (
      <div className="w-screen h-screen flex items-center justify-center">
        <span className="loading loading-spinner text-primary"></span>
      </div>
    );
  }

  return <FullPage categories={categories} />;

  // return (
  //     <>
  //         {/* <Helmet>
  //     <title>{t("Home")}</title>
  //     <link
  //       rel="icon"
  //       type="image/png"
  //       href={restaurantStyle.logo}
  //       sizes="16x16"
  //     />
  //   </Helmet> */}

  //         {/* <div
  //             style={{
  //                 backgroundColor: restaurantStyle?.page_color,
  //                 fontFamily: "cairo",
  //                 minHeight: "calc(100vh - 230px)",
  //                 padding: "16px",
  //             }}
  //         >
  //             <Herosection
  //                 isMobile={isMobile}
  //                 categories={categories}
  //                 isCatLoading={isCatLoading}
  //             />
  //             <ProductSection categories={categories} isMobile={isMobile} />
  //         </div>
  //         <FooterRestuarant /> */}
  //     </>
  // );
};
