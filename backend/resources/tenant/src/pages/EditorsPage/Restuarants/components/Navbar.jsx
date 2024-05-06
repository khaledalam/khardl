import { Fragment, useContext, useState, useEffect } from "react";
import { FaPlay } from "react-icons/fa";
import { IoMenuOutline } from "react-icons/io5";
import AxiosInstance from "../../../../axios/axios";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";
import { MenuContext } from "react-flexible-sliding-menu";
import GoBackHomeIcon from "../../../../assets/GoBackHomeIcon.png";
import PrimaryDropDown from "./PrimaryDropDown";
import {
  headerPosition,
  SetSideBar,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import Modal from "../../../../components/Modal";
import NewSideBar from "../../../../components/NewSideBar";
import Branches from "../../../../components/Branches";
import { use } from "i18next";
import { useSelector, useDispatch } from "react-redux";

const Navbar = ({ toggleSidebarCollapse, setIsPreview, isPreview }) => {
  const { t } = useTranslation();
  const { toggleMenu } = useContext(MenuContext);
  const [isLoading, setIsLoading] = useState(false);
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);

  const dispatch = useDispatch();

  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode
  );

  const handleSubmitResStyle = async (e) => {
    e.preventDefault();
    let inputs = {};
    inputs.logo_alignment = restuarantStyle.logo_alignment;
    inputs.logo_shape = restuarantStyle.logo_shape;
    inputs.banner_shape = restuarantStyle.banner_shape;
    inputs.banner_type = restuarantStyle.banner_type;
    inputs.banner_background_color = restuarantStyle.banner_background_color;
    inputs.category_alignment = restuarantStyle.category_alignment;
    inputs.category_shape = restuarantStyle.category_shape;
    inputs.category_hover_color = restuarantStyle.category_hover_color;
    inputs.categoryDetail_alignmnent =
      restuarantStyle.categoryDetail_alignmnent;
    inputs.categoryDetail_shape = restuarantStyle.categoryDetail_shape;
    inputs.categoryDetail_type = restuarantStyle.categoryDetail_type;
    inputs.categoryDetail_cart_color =
      restuarantStyle.categoryDetail_cart_color;
    inputs.selectedSocialIcons = restuarantStyle.selectedSocialIcons;
    inputs.socialMediaIcons_alignment =
      restuarantStyle.socialMediaIcons_alignment;
    inputs.phoneNumber = restuarantStyle.phoneNumber;
    inputs.phoneNumber_alignment = restuarantStyle.phoneNumber_alignment;
    inputs.page_color = restuarantStyle?.page_color;
    inputs.product_background_color = restuarantStyle.product_background_color;
    inputs.page_category_color = restuarantStyle.page_category_color;
    inputs.header_color = restuarantStyle.header_color;
    inputs.headerPosition = restuarantStyle.headerPosition;
    inputs.footer_color = restuarantStyle.footer_color;
    inputs.price_color = restuarantStyle.price_color;
    inputs.text_fontFamily = restuarantStyle.text_fontFamily;
    inputs.text_fontWeight = restuarantStyle.text_fontWeight;
    inputs.text_fontSize = restuarantStyle.text_fontSize;
    inputs.text_alignment = restuarantStyle.text_alignment;
    inputs.text_color = restuarantStyle.text_color;
    inputs.socialMediaIcons_alignment =
      restuarantStyle.socialMediaIcons_alignment;
    inputs.social_media_color = restuarantStyle.social_media_color;
    inputs.social_media_background_color =
      restuarantStyle.social_media_background_color;
    inputs.social_media_radius = restuarantStyle.social_media_radius;
    inputs.page_color = restuarantStyle.page_color;
    inputs.menu_card_background_color =
      restuarantStyle.menu_card_background_color;
    inputs.menu_card_text_font = restuarantStyle.menu_card_text_font;
    inputs.menu_card_text_weight = restuarantStyle.menu_card_text_weight;
    inputs.menu_card_text_size = restuarantStyle.menu_card_text_size;
    inputs.menu_card_text_color = restuarantStyle.menu_card_text_color;
    inputs.menu_name_background_color =
      restuarantStyle.menu_name_background_color;
    inputs.menu_name_text_font = restuarantStyle.menu_name_text_font;
    inputs.menu_name_text_weight = restuarantStyle.menu_name_text_weight;
    inputs.menu_name_text_size = restuarantStyle.menu_name_text_size;
    inputs.menu_name_text_color = restuarantStyle.menu_name_text_color;
    inputs.total_calories_background_color =
      restuarantStyle.total_calories_background_color;
    inputs.total_calories_text_font = restuarantStyle.total_calories_text_font;
    inputs.total_calories_text_weight =
      restuarantStyle.total_calories_text_weight;
    inputs.total_calories_text_size = restuarantStyle.total_calories_text_size;
    inputs.total_calories_text_color =
      restuarantStyle.total_calories_text_color;
    inputs.price_background_color = restuarantStyle.price_background_color;
    inputs.price_text_font = restuarantStyle.price_text_font;
    inputs.price_text_weight = restuarantStyle.price_text_weight;
    inputs.price_text_size = restuarantStyle.price_text_size;
    inputs.price_text_color = restuarantStyle.price_text_color;
    inputs.logo_border_radius = restuarantStyle.logo_border_radius;
    inputs.logo_border_color = restuarantStyle.logo_border_color;
    inputs.header_color = restuarantStyle.header_color;
    inputs.header_radius = restuarantStyle.header_radius;
    inputs.side_menu_position = restuarantStyle.side_menu_position;
    inputs.order_cart_position = restuarantStyle.order_cart_position;
    inputs.order_cart_color = restuarantStyle.order_cart_color;
    inputs.order_cart_radius = restuarantStyle.order_cart_radius;
    inputs.home_position = restuarantStyle.home_position;
    inputs.home_color = restuarantStyle.home_color;
    inputs.home_radius = restuarantStyle.home_radius;
    inputs.menu_category_background_color =
      restuarantStyle.menu_category_background_color;
    inputs.menu_category_font = restuarantStyle.menu_category_font;
    inputs.menu_category_weight = restuarantStyle.menu_category_weight;
    inputs.menu_category_size = restuarantStyle.menu_category_size;
    inputs.menu_category_color = restuarantStyle.menu_category_color;
    inputs.menu_category_position = restuarantStyle.menu_category_position;
    inputs.menu_category_radius = restuarantStyle.menu_category_radius;
    inputs.menu_section_background_color =
      restuarantStyle.menu_section_background_color;
    inputs.menu_section_radius = restuarantStyle.menu_section_radius;
    inputs.menu_card_radius = restuarantStyle.menu_card_radius;
    inputs.footer_color = restuarantStyle.footer_color;
    inputs.footer_alignment = restuarantStyle.footer_alignment;
    inputs.footer_text_fontFamily = restuarantStyle.footer_text_fontFamily;
    inputs.footer_text_fontWeight = restuarantStyle.footer_text_fontWeight;
    inputs.footer_text_fontSize = restuarantStyle.footer_text_fontSize;
    inputs.footer_text_color = restuarantStyle.footer_text_color;
    inputs.terms_and_conditions_color =
      restuarantStyle.terms_and_conditions_color;
    inputs.terms_and_conditions_alignment =
      restuarantStyle.terms_and_conditions_alignment;
    inputs.terms_and_conditions_text_fontFamily =
      restuarantStyle.terms_and_conditions_text_fontFamily;
    inputs.terms_and_conditions_text_fontWeight =
      restuarantStyle.terms_and_conditions_text_fontWeight;
    inputs.terms_and_conditions_text_fontSize =
      restuarantStyle.terms_and_conditions_text_fontSize;
    inputs.terms_and_conditions_text_color =
      restuarantStyle.terms_and_conditions_text_color;
    inputs.privacy_policy_color = restuarantStyle.privacy_policy_color;
    inputs.privacy_policy_alignment = restuarantStyle.privacy_policy_alignment;
    inputs.privacy_policy_text_fontFamily =
      restuarantStyle.privacy_policy_text_fontFamily;
    inputs.privacy_policy_text_fontWeight =
      restuarantStyle.privacy_policy_text_fontWeight;
    inputs.privacy_policy_text_fontSize =
      restuarantStyle.privacy_policy_text_fontSize;
    inputs.privacy_policy_text_color =
      restuarantStyle.privacy_policy_text_color;
    inputs.terms_and_conditions_enText =
      restuarantStyle.terms_and_conditions_enText;
    inputs.terms_and_conditions_arText =
      restuarantStyle.terms_and_conditions_arText;
    inputs.privacy_policy_enText = restuarantStyle.privacy_policy_enText;
    inputs.privacy_policy_arText = restuarantStyle.privacy_policy_arText;
    inputs.header_position = restuarantStyle.header_position;
    inputs.banner_radius = restuarantStyle.banner_radius;
    inputs.category_background_color =
      restuarantStyle.category_background_color;
    inputs.banner_image = restuarantStyle?.bannerUpload
      ? await fetch(restuarantStyle?.bannerUpload).then((r) => r.blob())
      : "";

    // inputs.banner_images = restuarantStyle?.banner_images;
    console.log("bannerUpload 1", restuarantStyle?.bannerUpload);
    console.log("banner_images 1", restuarantStyle?.banner_images);

    if (restuarantStyle.banner_type == "slider") {
      console.log("inside");
      const imagePromises = restuarantStyle?.banner_images
        .filter((banner) => banner !== undefined || banner !== null)
        .map(async (image) => {
          return await fetch(image.url).then((r) => r.blob());
        });
      console.log("imagePromises", await Promise.all(imagePromises));
      inputs.banner_images = await Promise.all(imagePromises);
    } else {
      inputs.banner_images = "";
    }

    if (
      restuarantStyle?.bannersUpload &&
      restuarantStyle?.bannersUpload.length > 0
    ) {
      const imagePromises = restuarantStyle?.bannersUpload
        .filter((banner) => banner !== undefined || banner !== null)
        .map(async (image) => {
          return await fetch(image.url).then((r) => r.blob());
        });
      console.log("imagePromises", await Promise.all(imagePromises));
      inputs.banner_images = await Promise.all(imagePromises);
      console.log("inputs.banner_images", inputs.banner_images);
    } else {
      // inputs.banner_images = "";
    }
    inputs.logo = restuarantStyle?.logoUpload
      ? await fetch(restuarantStyle?.logoUpload).then((r) => r.blob())
      : "";
    inputs.logo_url =
      restuarantStyle?.logoUpload === null ? restuarantStyle.logo : "";
    inputs.banner_image_url =
      restuarantStyle?.bannerUpload === null
        ? restuarantStyle.banner_image
        : "";
    inputs.banner_images_urls =
      restuarantStyle?.bannersUpload.length === 0
        ? restuarantStyle.banner_images
        : "";

    inputs.logo_type = restuarantStyle?.logoUpload === null ? "url" : "file";

    setIsLoading(true);

    try {
      const response = await AxiosInstance.post(`restaurant-style`, inputs, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      if (response) {
        setIsLoading(false);
        toast.success(response.data.message);
      }
    } catch (error) {
      console.log(error.response.data.message);
      toast.error(error.response?.data?.message);
      setIsLoading(false);
    }
  };

  let isModelOpen = restuarantStyle.isSideBarOpen;
  let setIsModelOpen = (value) => dispatch(SetSideBar(value));

  // const [isModelOpen, setIsModelOpen] = useState(false);

  const [isBranchModelOpen, setIsBranchModelOpen] = useState(false);
  useEffect(() => {
    console.log("isModelOpen", isModelOpen);
    console.log("isBranchModelOpen", isBranchModelOpen);
    if (isModelOpen === true && isBranchModelOpen === true) {
      () => setIsModelOpen(false);
    }
  }, [isBranchModelOpen]);

  if (isLoading) {
    return (
      <div role="status" className="fixed top-0 right-0 h-screen w-screen z-10">
        <div className="rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]"></div>
        <div className="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 ">
          <svg
            aria-hidden="true"
            className="w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]"
            viewBox="0 0 100 101"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
              fill="currentColor"
            />
            <path
              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
              fill="currentFill"
            />
          </svg>
          <span className="sr-only">Loading...</span>
        </div>
      </div>
    );
  }

  return (
    <Fragment>
      {isBranchModelOpen ? (
        <Modal
          open={isBranchModelOpen}
          onClose={() => {
            setIsBranchModelOpen(false);
          }}
          className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
        >
          <Branches
            closingFunc={() => {
              setIsBranchModelOpen(false);
            }}
            closingFuncSideMenu={() => setIsModelOpen(false)}
          />
        </Modal>
      ) : (
        <Modal
          open={isModelOpen}
          onClose={() => setIsModelOpen(false)}
          className={`fixed ${
            currentLanguage == "en" ? "left-auto" : "right-auto"
          } top-auto md:top-auto ${
            currentLanguage == "en" ? "md:left-auto" : "md:right-auto"
          }`}
        >
          <NewSideBar
            onClose={() => setIsModelOpen(false)}
            isBranchModelOpen={isBranchModelOpen}
            setIsBranchModelOpen={setIsBranchModelOpen}
          />
        </Modal>
      )}

      <div className="relative z-40 h-[56px] w-full bg-white flex items-center justify-between px-[17px] border-b border-[rgba(0,0,0,0.3)]">
        {/* <IoMenuOutline
                    size={42}
                    className="text-neutral-400 cursor-pointer"
                    onClick={toggleMenu}
                /> */}
        <img
          src={GoBackHomeIcon}
          className="hover:cursor-pointer"
          alt="icon"
          // onClick={toggleMenu}
          onClick={() => {
            setIsModelOpen(true);
          }}
        />
        {/*<PrimaryDropDown*/}
        {/*  // handleChange={handleChange}*/}
        {/*  innerClassName="border-none shadow-none"*/}
        {/*  defaultValue={*/}
        {/*    restuarantStyle.template === "template-1"*/}
        {/*      ? t("Template 1")*/}
        {/*      : restuarantStyle.template === "template-2"*/}
        {/*        ? t("Template 2")*/}
        {/*        : restuarantStyle.template === "template-3"*/}
        {/*          ? t("Template 3")*/}
        {/*          : " "*/}
        {/*  }*/}
        {/*  dropdownList={[*/}
        {/*    {*/}
        {/*      value: "template-1",*/}
        {/*      text: t("Template 1"),*/}
        {/*    },*/}
        {/*    {*/}
        {/*      value: "template-2",*/}
        {/*      text: t("Template 2"),*/}
        {/*    },*/}
        {/*    {*/}
        {/*      value: "template-3",*/}
        {/*      text: t("Template 3"),*/}
        {/*    },*/}
        {/*  ]}*/}
        {/*/>*/}
        <div className="flex items-center gap-[8px] cursor-pointer">
          <button
            onClick={() => setIsPreview((prev) => !prev)}
            className="w-[63px] h-[24px] text-[10px] font-semibold bg-white hover:bg-neutral-200 active:bg-neutral-200 border-[0.5px] rounded-[50px] "
          >
            {isPreview ? t("Edit") : t("Preview")}
          </button>
          <button
            onClick={handleSubmitResStyle}
            className="w-[63px] h-[24px] text-[10px] font-semibold bg-white hover:bg-neutral-200 active:bg-neutral-200 rounded-[50px] border-[0.5px]"
          >
            {t("Publish")}
          </button>
        </div>
      </div>
    </Fragment>
  );
};

export default Navbar;
