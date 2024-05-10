import React, { useEffect, useState } from "react";
import Navbar from "./components/Navbar";
import MainBoardEditor from "./components/MainBoardEditor";
import AxiosInstance from "../../../axios/axios";
import { useDispatch, useSelector } from "react-redux";
import { changeStyleDataRestaurant } from "../../../redux/editor/styleDataRestaurantSlice";
import {
  changeRestuarantEditorStyle,
  headerColor,
  logoBorderColor,
  logoBorderRadius,
  pageBackgroundColor,
  logoAlignment,
  setSidebarCollapse,
  socialMediaIconsAlignment,
  socialMediaColor,
  socialMediaBackgroundColor,
  socialMediaRadius,
  MenuCardBackgroundColor,
  MenuCardTextFont,
  MenuCardTextWeight,
  MenuCardTextSize,
  MenuCardTextColor,
  MenuNameBackgroundColor,
  MenuNameTextFont,
  MenuNameTextWeight,
  MenuNameTextSize,
  MenuNameTextColor,
  TotalCaloriesBackgroundColor,
  TotalCaloriesTextFont,
  TotalCaloriesTextWeight,
  TotalCaloriesTextSize,
  TotalCaloriesTextColor,
  PriceBackgroundColor,
  PriceTextFont,
  PriceTextWeight,
  PriceTextSize,
  PriceTextColor,
  HeaderPosition,
  HeaderColor,
  HeaderRadius,
  SideMenuPosition,
  OrderCartPosition,
  OrderCartColor,
  OrderCartRadius,
  HomePosition,
  HomeColor,
  HomeRadius,
  MenuCategoryBackgroundColor,
  MenuCategoryFont,
  MenuCategoryWeight,
  MenuCategorySize,
  MenuCategoryColor,
  MenuCategoryPosition,
  MenuCategoryRadius,
  MenuSectionBackgroundColor,
  MenuSectionRadius,
  MenuCardRadius,
  BannerRadius,
  footerColor,
  footerAlignment,
  footerTextFont,
  footerTextWeight,
  footerTextSize,
  footerTextColor,
  termsAndConditionsColor,
  termsAndConditionsAlignment,
  termsAndConditionsTextFont,
  termsAndConditionsTextWeight,
  termsAndConditionsTextSize,
  termsAndConditionsTextColor,
  privacyPolicyColor,
  privacyPolicyAlignment,
  privacyPolicyTextFont,
  privacyPolicyTextWeight,
  privacyPolicyTextSize,
  privacyPolicyTextColor,
} from "../../../redux/NewEditor/restuarantEditorSlice";
import {
  getCartItemsCount,
  setCategoriesAPI,
} from "../../../redux/NewEditor/categoryAPISlice";
import HeaderEdit from "./components/HeaderEdit";
import { LeftSideBar } from "./components/LeftSideBar";
import { RightSideBarMobile } from "./components/RightSideBarMobile";
import { RightSideBarDesktop } from "./components/RightSideBarDesktop";
import { useTranslation } from "react-i18next";
import useWindowSize from "../../../hooks/useWindowSize";

export const RestuarantEditor = () => {
  const { t } = useTranslation();
  const [isLoading, setIsLoading] = useState(true);
  const { width } = useWindowSize();
  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );
  const dispatch = useDispatch();

  const {
    logo_alignment,
    banner_type,
    socialMediaIcons_alignment,
    social_media_color,
    social_media_background_color,
    social_media_radius,
    selectedSocialIcons,
    page_color,
    menu_card_background_color,
    menu_card_text_font,
    menu_card_text_weight,
    menu_card_text_size,
    menu_card_text_color,
    menu_name_background_color,
    menu_name_text_font,
    menu_name_text_weight,
    menu_name_text_size,
    menu_name_text_color,
    total_calories_background_color,
    total_calories_text_font,
    total_calories_text_weight,
    total_calories_text_size,
    total_calories_text_color,
    price_background_color,
    price_text_font,
    price_text_weight,
    price_text_size,
    price_text_color,
    logo_border_radius,
    logo_border_color,
    header_color,
    header_radius,
    side_menu_position,
    order_cart_position,
    order_cart_color,
    order_cart_radius,
    home_position,
    home_color,
    home_radius,
    menu_category_background_color,
    menu_category_font,
    menu_category_weight,
    menu_category_size,
    menu_category_color,
    menu_category_position,
    menu_category_radius,
    menu_section_background_color,
    menu_section_radius,
    menu_card_radius,
    banner_radius,
    footer_color,
    footer_alignment,
    footer_text_fontFamily,
    footer_text_fontWeight,
    footer_text_fontSize,
    footer_text_color,
  } = restuarantEditorStyle;

  const categories = useSelector((state) => state.categoryAPI.categories);

  const isSidebarCollapse = useSelector(
    (state) => state.restuarantEditorStyle.collapse_sidebar
  );
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
  const template = useSelector((state) => state.restuarantEditorStyle.template);

  const [activeSubitem, setActiveSubitem] = useState(null);
  const [activeSection, setActiveSection] = useState(null);
  const [activeDesignSection, setActiveDesignSection] = useState(null);

  const handleSidebarCollapse = () => {
    dispatch(setSidebarCollapse(!isSidebarCollapse));
  };

  const fetchResStyleData = async () => {
    try {
      const restaurantStyleResponse = await AxiosInstance.get(
        `restaurant-style`
      );

      if (restaurantStyleResponse.data) {
        dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data));
        dispatch(
          changeRestuarantEditorStyle(restaurantStyleResponse.data?.data)
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
        }`
      );

      console.log(
        "editor rest restaurantCategoriesResponse RestuarantEditor",
        restaurantCategoriesResponse.data
      );
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data));

        if (!branch_id) {
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id;
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

  const navItems = [
    {
      title: t("Page"),
      subItems: [
        {
          title: t("Page Background"),
          layout: ["color"],
          layoutInitialValues: [page_color],
          layoutOnChange: [(color) => dispatch(pageBackgroundColor(color))],
          contentPosition: [],
          text: [],
          link: [],
        },
      ],
    },
    {
      title: t("Header"),
      subItems: [
        {
          title: t("Header"),
          layout: ["color", "radius"],
          layoutInitialValues: [header_color, header_radius],
          layoutOnChange: [
            (color) => dispatch(HeaderColor(color)),
            (radius) => dispatch(HeaderRadius(radius)),
          ],
          contentPosition: [],
          text: [],
          link: [],
        },
        {
          title: t("Side Menu"),
          layout: [],
          contentPosition: ["positionContent"],
          contentPositionInitialValues: [side_menu_position],
          contentPositionOnChange: [
            (value) => dispatch(SideMenuPosition(value)),
          ],
          text: [],
          link: [],
        },
        {
          title: t("Order Cart"),
          layout: [],
          contentPosition: ["positionContent", "color", "radius"],
          contentPositionInitialValues: [
            order_cart_position,
            order_cart_color,
            order_cart_radius,
          ],
          contentPositionOnChange: [
            (value) => dispatch(OrderCartPosition(value)),
            (color) => dispatch(OrderCartColor(color)),
            (radius) => dispatch(OrderCartRadius(radius)),
          ],
          text: [],
          link: [],
        },
        {
          title: t("Logo"),
          layout: [],
          contentPosition: ["positionContent", "radius"],
          contentPositionInitialValues: [logo_alignment, logo_border_radius],
          contentPositionOnChange: [
            (value) => dispatch(logoAlignment(value)),
            (borderRadius) => dispatch(logoBorderRadius(borderRadius)),
          ],
          text: [],
          link: [],
        },
      ],
    },
    // {
    //   title: t("Logo"),
    //   subItems: [
    //     {
    //       title: t("Logo"),
    //       layout: ["color"],
    //       layoutInitialValues: [logo_border_color],
    //       layoutOnChange: [(color) => dispatch(logoBorderColor(color))],
    //       contentPosition: ["positionContent", "radius"],
    //       contentPositionInitialValues: [logo_alignment, logo_border_radius],
    //       contentPositionOnChange: [
    //         (value) => dispatch(logoAlignment(value)),
    //         (borderRadius) => dispatch(logoBorderRadius(borderRadius)),
    //       ],
    //       text: [],
    //       link: [],
    //     },
    //   ],
    // },
    {
      title: t("Banner"),
      subItems: [
        {
          title: t("Banner"),
          layout: ["radius"],
          layoutInitialValues: [banner_radius],
          layoutOnChange: [(radius) => dispatch(BannerRadius(radius))],
          contentPosition: [],
          text: [],
          link: [],
        },
      ],
    },
    {
      title: t("Menu Category"),
      subItems: [
        {
          title: t("Category"),
          layout: ["positionLayoutGrid", "color", "radius"],
          layoutInitialValues: [
            menu_category_position,
            menu_category_background_color,
            menu_category_radius,
          ],
          layoutOnChange: [
            (value) => dispatch(MenuCategoryPosition(value)),
            (color) => dispatch(MenuCategoryBackgroundColor(color)),
            (radius) => dispatch(MenuCategoryRadius(radius)),
          ],
          contentPosition: [],
          text: ["font", "weight", "size", "color"],
          textInitialValues: [
            menu_category_font,
            menu_category_weight,
            menu_category_size,
            menu_category_color,
          ],
          textOnChange: [
            (value) => dispatch(MenuCategoryFont(value)),
            (value) => dispatch(MenuCategoryWeight(value)),
            (value) => dispatch(MenuCategorySize(value)),
            (color) => dispatch(MenuCategoryColor(color)),
          ],
          link: [],
        },
      ],
    },
    {
      title: t("Menu Category Detail"),
      subItems: [
        {
          title: t("Menu Section"),
          layout: ["color", "radius"],
          layoutInitialValues: [
            menu_section_background_color,
            menu_section_radius,
          ],
          layoutOnChange: [
            (color) => dispatch(MenuSectionBackgroundColor(color)),
            (radius) => dispatch(MenuSectionRadius(radius)),
          ],
          contentPosition: [],
          text: [],
          link: [],
        },
        {
          title: t("Menu Card"),
          layout: ["color", "radius"],
          layoutInitialValues: [menu_card_background_color, menu_card_radius],
          layoutOnChange: [
            (color) => dispatch(MenuCardBackgroundColor(color)),
            (radius) => dispatch(MenuCardRadius(radius)),
          ],
          contentPosition: [],
          text: [],
          textInitialValues: [],
          textOnChange: [],
          link: [],
        },
        {
          title: t("Item Text"),
          layout: [],
          layoutInitialValues: [],
          layoutOnChange: [],
          contentPosition: [],
          text: ["font", "weight", "size", "color"],
          textInitialValues: [
            menu_name_text_font,
            menu_name_text_weight,
            menu_name_text_size,
            menu_name_text_color,
          ],
          textOnChange: [
            (value) => dispatch(MenuNameTextFont(value)),
            (value) => dispatch(MenuNameTextWeight(value)),
            (value) => dispatch(MenuNameTextSize(value)),
            (color) => dispatch(MenuNameTextColor(color)),
          ],
          text_2: ["font", "weight", "size", "color"],
          textInitialValues_2: [
            total_calories_text_font,
            total_calories_text_weight,
            total_calories_text_size,
            total_calories_text_color,
          ],
          textOnChange_2: [
            (value) => dispatch(TotalCaloriesTextFont(value)),
            (value) => dispatch(TotalCaloriesTextWeight(value)),
            (value) => dispatch(TotalCaloriesTextSize(value)),
            (color) => dispatch(TotalCaloriesTextColor(color)),
          ],
          link: [],
        },
        // {
        //     title: t("Total Calories"),
        //     layout: ["color"],
        //     layoutInitialValues: [total_calories_background_color],
        //     layoutOnChange: [
        //         (color) =>
        //             dispatch(TotalCaloriesBackgroundColor(color)),
        //     ],
        //     contentPosition: [],
        //     text: ["font", "weight", "size", "color"],
        //     textInitialValues: [
        //         total_calories_text_font,
        //         total_calories_text_weight,
        //         total_calories_text_size,
        //         total_calories_text_color,
        //     ],
        //     textOnChange: [
        //         (value) => dispatch(TotalCaloriesTextFont(value)),
        //         (value) => dispatch(TotalCaloriesTextWeight(value)),
        //         (value) => dispatch(TotalCaloriesTextSize(value)),
        //         (color) => dispatch(TotalCaloriesTextColor(color)),
        //     ],
        //     link: [],
        // },
        {
          title: t("Price"),
          layout: [],
          layoutInitialValues: [],
          layoutOnChange: [],
          contentPosition: ["color"],
          contentPositionInitialValues: [price_background_color],
          contentPositionOnChange: [
            (color) => dispatch(PriceBackgroundColor(color)),
          ],
          text: ["font", "weight", "size", "color"],
          textInitialValues: [
            price_text_font,
            price_text_weight,
            price_text_size,
            price_text_color,
          ],
          textOnChange: [
            (value) => dispatch(PriceTextFont(value)),
            (value) => dispatch(PriceTextWeight(value)),
            (value) => dispatch(PriceTextSize(value)),
            (color) => dispatch(PriceTextColor(color)),
          ],
          link: [],
        },
      ],
    },
    {
      title: t("Footer"),
      subItems: [
        {
          title: t("Footer"),
          layout: ["color"],
          layoutInitialValues: [footer_color],
          layoutOnChange: [(color) => dispatch(footerColor(color))],
          // contentPosition: ["positionContent"],
          // contentPositionInitialValues: [footer_alignment],
          // contentPositionOnChange: [
          //   (value) => dispatch(footerAlignment(value)),
          // ],
          // text: ["font", "weight", "size", "color"],
          // textInitialValues: [
          //   footer_text_fontFamily,
          //   footer_text_fontWeight,
          //   footer_text_fontSize,
          //   footer_text_color,
          // ],
          // textOnChange: [
          //   (value) => dispatch(footerTextFont(value)),
          //   (value) => dispatch(footerTextWeight(value)),
          //   (value) => dispatch(footerTextSize(value)),
          //   (color) => dispatch(footerTextColor(color)),
          // ],
          link: [],
        },
        {
          title: t("Social Media"),
          layout: ["color"],
          layoutInitialValues: [social_media_color],
          layoutOnChange: [(color) => dispatch(socialMediaColor(color))],
          contentPosition: ["positionContent", "radius", "color"],
          contentPositionInitialValues: [
            socialMediaIcons_alignment,
            social_media_radius,
            social_media_background_color,
          ],
          contentPositionOnChange: [
            (value) => dispatch(socialMediaIconsAlignment(value)),
            (value) => dispatch(socialMediaRadius(value)),
            (value) => dispatch(socialMediaBackgroundColor(value)),
          ],
          text: [],
          textInitialValues: [],
          textOnChange: [],
          link: ["linkTo"],
        },
      ],
    },
  ];

  const [isPreview, setIsPreview] = useState(false);

  return (
    <div
      className="block"
      style={{ fontFamily: "Plus Jakarta Sans, sans-serif" }}
    >
      <Navbar
        toggleSidebarCollapse={handleSidebarCollapse}
        setIsPreview={setIsPreview}
        isPreview={isPreview}
      />
      <div
        style={{ backgroundColor: page_color }}
        className={`flex flex-col md:flex-row h-[calc(100vh-56px)] w-full transition-all hide-scroll`}
      >
        {isPreview ? (
          <div className="md:flex-0 md:max-w-[240px]"></div>
        ) : (
          <div className="transition-all flex-[40px] md:flex-[25%] overflow-x-hidden bg-white max-h-[40px] md:max-h-full md:h-full border-b md:border-b-0 md:border-r border-[rgba(0,0,0,0.3)]">
            {/* <SidebarEditor /> */}
            <LeftSideBar
              activeSubitem={activeSubitem}
              setActiveSubitem={setActiveSubitem}
              activeSection={activeSection}
              setActiveSection={setActiveSection}
              navItems={navItems}
              activeDesignSection={activeDesignSection}
              setActiveDesignSection={setActiveDesignSection}
            />
          </div>
        )}
        <div
          style={{ backgroundColor: page_color }}
          className={` transition-all h-full ${
            isPreview ? "flex-[100%] w-full" : "flex-[50%]"
          } xl:flex-[80%] overflow-x-hidden`}
        >
          {template === "template-1" && (
            <div className="w-full h-full flex flex-col gap-2 max-w-[1200px] mx-auto">
              {restaurantStyle?.headerPosition === "fixed" && (
                <div className="p-2">
                  <HeaderEdit
                    restaurantStyle={restaurantStyle}
                    toggleSidebarCollapse={handleSidebarCollapse}
                    isHighlighted={
                      navItems[activeSection]?.title === t("Header")
                    }
                    handleLogoUpload={() => {}}
                  />
                </div>
              )}
              <div className=" h-full overflow-y-scroll hide-scroll">
                <MainBoardEditor
                  isLoading={isLoading}
                  categories={categories}
                  toggleSidebarCollapse={handleSidebarCollapse}
                  activeSubitem={activeSubitem}
                  setActiveSubitem={setActiveSubitem}
                  activeSection={activeSection}
                  setActiveSection={setActiveSection}
                  navItems={navItems}
                  activeDesignSection={activeDesignSection}
                  setActiveDesignSection={setActiveDesignSection}
                />
              </div>
            </div>
          )}
        </div>
        {isPreview ? (
          <div className="md:flex-0 md:max-w-[240px]"></div>
        ) : (
          <div
            className={`transition-all flex-[140px] max-h-[140px] md:max-h-full md:flex-[25%] overflow-x-hidden h-full bg-white border-t md:border-t-0 md:border-l border-[rgba(0,0,0,0.3)]`}
          >
            {/* <SidebarEditor /> */}
            {width < 768 ? (
              <RightSideBarMobile
                activeSubitem={activeSubitem}
                setActiveSubitem={setActiveSubitem}
                activeSection={activeSection}
                setActiveSection={setActiveSection}
                navItems={navItems}
                activeDesignSection={activeDesignSection}
                setActiveDesignSection={setActiveDesignSection}
              />
            ) : (
              <RightSideBarDesktop
                activeSubitem={activeSubitem}
                setActiveSubitem={setActiveSubitem}
                activeSection={activeSection}
                setActiveSection={setActiveSection}
                navItems={navItems}
                activeDesignSection={activeDesignSection}
                setActiveDesignSection={setActiveDesignSection}
              />
            )}
          </div>
        )}
      </div>
    </div>
  );
};
