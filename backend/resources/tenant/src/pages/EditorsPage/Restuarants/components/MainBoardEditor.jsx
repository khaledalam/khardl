import React, { Fragment, useContext, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import ImgPlaceholder from "../../../../assets/imgPlaceholder.png";
import bannerPlaceholder from "../../../../assets/banner-placeholder.jpg";
import { IoCloseOutline, IoMenuOutline } from "react-icons/io5";
import CategoryItem from "./CategoryItem";
import ProductItem from "./ProductItem";
import EditorSlider from "./EditorSlider";
import { useSelector, useDispatch } from "react-redux";
import { MenuContext } from "react-flexible-sliding-menu";
import Slider from "./Slider";
import Sliderr from "./Sliderr";
import { selectedCategoryAPI } from "../../../../redux/NewEditor/categoryAPISlice";
import {
    logoUpload,
    setBannerUpload,
    moveSelectedIconsToMedia,
    setSelectedSocialMediaId,
    bannerType,
    BannerImages,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import EmptyBackground from "../../../../assets/emptyBackground.png";
import EmptyBackground60 from "../../../../assets/emptyBackground60.png";
import UploadIcon from "../../../../assets/uploadIcon.png";
import { useTranslation } from "react-i18next";
import HeaderEdit from "./HeaderEdit";
import { BiCloudUpload } from "react-icons/bi";
import Cropper from "react-easy-crop";
import getCroppedImg from "./cropImage";
import RightIcon from "../../../../assets/rightIcon.png";
import LeftIcon from "../../../../assets/leftIcon.png";
import GreenDot from "../../../../assets/greenDot.png";
import { AiOutlineClose } from "react-icons/ai";
import { set } from "react-hook-form";

const MainBoardEditor = ({
    categories,
    toggleSidebarCollapse,
    isLoading,
    activeSection,
    setActiveSection,
    activeSubitem,
    setActiveSubitem,
    navItems,
    activeDesignSection,
    setActiveDesignSection,
}) => {
    const restuarantEditorStyle = useSelector(
        (state) => state.restuarantEditorStyle
    );
    const [isVideo, setIsVideo] = useState(false);
    const { t } = useTranslation();
    const language = useSelector((state) => state.languageMode.languageMode);
    const [crop, setCrop] = useState({ x: 0, y: 0 });
    const [rotation, setRotation] = useState(0);
    const [zoom, setZoom] = useState(1);
    const [croppedAreaPixels, setCroppedAreaPixels] = useState(null);
    const [croppedImage, setCroppedImage] = useState(null);
    const [uncroppedImage, setUncroppedImage] = useState(null);
    const [isCropModalOpened, setIsCropModalOpened] = useState(false);
    const [isBannerModalOpened, setIsBannerModalOpened] = useState(false);
    const [showCropSection, setShowCropSection] = useState(false);
    const [imgType, setImgType] = useState("");
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { toggleMenu } = useContext(MenuContext);

    const {
        page_color,
        page_category_color,
        product_background_color,
        category_hover_color,
        category_shape,

        categoryDetail_cart_color,
        categoryDetail_type,
        categoryDetail_alignment,
        categoryDetail_shape,

        price_color,
        logo,
        banner_image,
        banner_images,
        banner_background_color,
        footer_color,
        footer_alignment,
        footer_text_fontFamily,
        footer_text_fontWeight,
        footer_text_fontSize,
        footer_text_color,
        headerPosition,
        logo_alignment,
        logo_shape,
        banner_type,
        banner_shape,
        text_fontFamily,
        text_fontWeight,
        text_fontSize,
        text_alignment,
        phoneNumber,
        phoneNumber_alignment,
        socialMediaIcons_alignment,
        social_media_radius,
        social_media_color,
        social_media_background_color,
        selectedSocialIcons,
        text_color,

        logo_border_radius,
        logo_border_color,

        header_position,
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
    } = restuarantEditorStyle;

    const [listofBannerImages, setListofBannerImages] = useState([]);

    const onCropComplete = (croppedArea, croppedAreaPixels) => {
        setCroppedAreaPixels(croppedAreaPixels);
    };
    const showCroppedImage = async () => {
        try {
            const croppedImage = await getCroppedImg(
                uncroppedImage,
                croppedAreaPixels,
                rotation
            );
            console.log("donee", { croppedImage });

            setUncroppedImage(null);
            setIsCropModalOpened(false);
            if (imgType == "logoUpload") {
                dispatch(logoUpload(croppedImage));
            } else {
                dispatch(setBannerUpload(croppedImage));
                setUploadSingleBanner(croppedImage);
            }
            // setCroppedImage(croppedImage)
        } catch (e) {
            console.error(e);
        }
    };
    const showCroppedImageBanner = async () => {
        try {
            const croppedImage = await getCroppedImg(
                uncroppedImage,
                croppedAreaPixels,
                rotation
            );
            setListofBannerImages([...listofBannerImages, { croppedImage }]);
            console.log("donee", { croppedImage });
            console.log("list of uploaded images", listofBannerImages);
            setUncroppedImage(null);
            dispatch(setBannerUpload(croppedImage));
            setUploadSingleBanner(null);
            // setCroppedImage(croppedImage)
            setShowCropSection(false);
        } catch (e) {
            console.error(e);
        }
    };
    const selectedCategory = useSelector(
        (state) => state.categoryAPI.selected_category
    );
    const cartItemsCount = useSelector(
        (state) => state.categoryAPI.cartItemsCount
    );
    const uploadLogo = useSelector(
        (state) => state.restuarantEditorStyle.logoUpload
    );

    const selectedMediaId = useSelector(
        (state) => state.restuarantEditorStyle.selectedMediaId
    );

    const [uploadSingleBanner, setUploadSingleBanner] = useState(null);
    const [uploadedSingleBanner, setUploadedSingleBanner] = useState(null);

    const handleLogoUpload = (event) => {
        event.preventDefault();

        const selectedLogo = event.target.files[0];
        if (selectedLogo) {
            setUncroppedImage(URL.createObjectURL(selectedLogo));
            setIsCropModalOpened(true);
            setImgType("logoUpload");
            dispatch(logoUpload(URL.createObjectURL(selectedLogo)));
        }
    };

    const handleBannerUpload = (event) => {
        event.preventDefault();

        const selectedBanner = event.target.files[0];

        if (selectedBanner) {
            if (selectedBanner.type.includes("video")) {
                console.log("video", selectedBanner);
                setIsVideo(true);
                setUploadSingleBanner(URL.createObjectURL(selectedBanner));
            } else {
                setIsVideo(false);
                setUncroppedImage(URL.createObjectURL(selectedBanner));
                // setIsCropModalOpened(true);
                setImgType("setBannerUpload");
                setUploadSingleBanner(URL.createObjectURL(selectedBanner));
            }
            dispatch(setBannerUpload(URL.createObjectURL(selectedBanner)));
            setShowCropSection(true);
            if (listofBannerImages.length < 2) {
                dispatch(bannerType("one-photo"));
            } else {
                dispatch(bannerType("slider"));
            }
        }
    };

    useEffect(() => {
        if (language !== "en") {
            if (categories && categories.length > 0) {
                dispatch(
                    selectedCategoryAPI({
                        name: categories[0]?.name,
                        id: categories && categories[0]?.id,
                    })
                );
            }
        } else {
            dispatch(
                selectedCategoryAPI({
                    name: categories[0]?.name,
                    id: categories && categories[0]?.id,
                })
            );
        }
        if (banner_type == "slider" && banner_images.length > 0) {
            setListofBannerImages(
                banner_images.map((image) => {
                    return {
                        croppedImage: `${image.url}`,
                    };
                })
            );
        }
        if (banner_type == "one-photo" && banner_image) {
            setListofBannerImages([{ croppedImage: `${banner_image.url}` }]);
            setUploadedSingleBanner(`${banner_image.url}`);
        }
        console.log("checking type: ", banner_type);
        console.log("checking images: ", banner_images);
        console.log("checking image: ", banner_image);
        activeSubitem != null &&
            console.log(
                "now 2 : ",
                navItems[activeSection].subItems[activeSubitem].title
            );
    }, [
        language,
        dispatch,
        categories,
        activeSection,
        activeSubitem,
        selectedSocialIcons,
    ]);

    // let currentSubItem = activeSubitem
    //     ? navItems[activeSection]?.subItem[activeSubitem].title
    //     : null;

    const clearLogo = () => {
        dispatch(logoUpload(null));
    };
    const clearBanner = () => {
        setUploadSingleBanner(null);
        dispatch(setBannerUpload(null));
    };

    const removeUploadedImage = (index) => {
        console.log("index", index);
        if (index >= 0 && index < listofBannerImages.length) {
            console.log("log list", listofBannerImages.splice(index, 1));
            setListofBannerImages(listofBannerImages.splice(index, 1));
            console.log("list of uploaded images - after", listofBannerImages);
            if (listofBannerImages.length < 2) {
                dispatch(bannerType("one-photo"));
            } else {
                dispatch(bannerType("slider"));
            }
        } else {
            console.error("Index out of bounds!");
        }
    };

    const handleRemoveMediaSelect = (id) => {
        dispatch(moveSelectedIconsToMedia(id));
    };

    const handleSocialMediaSelect = (id) => {
        dispatch(setSelectedSocialMediaId(id));
    };

    const categoriesPlaceHolders = [
        {
            id: 1,
            name: "category 1",
            photo: ImgPlaceholder,
        },
        {
            id: 2,
            name: "category 2",
            photo: ImgPlaceholder,
        },
        {
            id: 3,
            name: "category 3",
            photo: ImgPlaceholder,
        },
        {
            id: 4,
            name: "category 2",
            photo: ImgPlaceholder,
        },
        {
            id: 5,
            name: "category 3",
            photo: ImgPlaceholder,
        },
    ];
    const productPlaceHolders = [
        {
            id: 1,
            description: "descriptiomn 1",
            photo: ImgPlaceholder,
            price: 176,
            calories: 245,
            availability: 1,
        },
        {
            id: 2,
            description: "descriptiomn 2",
            photo: ImgPlaceholder,
            price: 176,
            calories: 245,
            availability: 1,
        },
        {
            id: 3,
            description: "descriptiomn 3",
            photo: ImgPlaceholder,
            price: 176,
            calories: 245,
            availability: 1,
        },
    ];

    const filterCategory =
        categories && categories.length > 0
            ? categories?.filter(
                  (category) => category.id === selectedCategory.id
              )
            : [{ name: "Product", items: productPlaceHolders }];

    const filetype = "video";

    const scrollToSection = (sectionId) => {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: "smooth" });
        }
    };

    // console.log("KKK: ")

    return (
        <div
            style={{
                backgroundColor: page_color,
                fontFamily: footer_text_fontFamily,
                fontWeight: text_fontWeight,
            }}
            className="w-full p-4 flex flex-col gap-[16px] relative"
        >
            {/* Header cart */}
            {headerPosition !== "fixed" && (
                <HeaderEdit
                    restaurantStyle={restuarantEditorStyle}
                    toggleSidebarCollapse={toggleSidebarCollapse}
                    isHighlighted={navItems[activeSection]?.title === "Header"}
                    currentSubItem={
                        activeSubitem != null
                            ? navItems[activeSection].subItems[activeSubitem]
                                  .title
                            : null
                    }
                />
            )}
            {/* logo */}
            <div
                className={`w-full h-[80px] bg-white rounded-xl flex ${
                    logo_alignment === "center"
                        ? "items-center justify-center"
                        : logo_alignment === "left"
                        ? "items-center justify-start"
                        : logo_alignment === "right"
                        ? "items-center justify-end"
                        : ""
                } ${
                    navItems[activeSection]?.title === "Logo" &&
                    "shadow-inner border-[#C0D123] border-[2px]"
                }`}
            >
                <div
                    style={{
                        borderRadius: logo_border_radius
                            ? logo_border_radius + "%"
                            : logo_shape === "sharp"
                            ? 0
                            : 12,
                        border: `1px solid ${logo_border_color}`,
                        backgroundImage: `url(${
                            uploadLogo
                                ? uploadLogo
                                : logo
                                ? logo
                                : EmptyBackground60
                        })`,
                        backgroundRepeat: "no-repeat",
                        backgroundSize: "cover",
                    }}
                    className="w-[60px] h-[60px] flex flex-col items-center pt-[17px] pb-[7px] relative"
                >
                    <img
                        src={GreenDot}
                        alt="green dot"
                        className={`${
                            activeSubitem != null &&
                            navItems[activeSection].subItems[activeSubitem]
                                .title == "Logo"
                                ? "absolute w-[5px] h-[5px] right-[-1px] top-[-3px]"
                                : "hidden"
                        }`}
                    />
                    <input
                        type="file"
                        name="logo"
                        id={"logo"}
                        accept="image/*"
                        onChange={handleLogoUpload}
                        className="hidden"
                        hidden
                    />
                    <span
                        className={`uppercase text-[12px] leading-[16px] font-semibold text-black/[.54] mb-[3px] ${
                            (logo || uploadLogo) && "hidden"
                        }`}
                    >
                        {t("Logo")}
                    </span>
                    <label htmlFor="logo">
                        <img
                            src={UploadIcon}
                            alt={""}
                            style={{
                                borderRadius: logo_shape === "sharp" ? 0 : 12,
                            }}
                            className={`w-[18px] h-[18px] object-cover ${
                                uploadLogo && "hidden"
                            }`}
                        />
                    </label>
                    {uploadLogo && (
                        <div className="absolute top-[-0.8rem] right-[-1rem] cursor-pointer">
                            <div className="w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center">
                                <IoCloseOutline
                                    size={16}
                                    className="text-red-500 cursor-pointer"
                                    onClick={clearLogo}
                                />
                            </div>
                        </div>
                    )}
                </div>
            </div>
            {/* banner */}
            {!isLoading ? (
                listofBannerImages?.length > 1 ? (
                    <>
                        <div
                            className={`w-full aspect-[2/1] ${
                                navItems[activeSection]?.title === "Banner" &&
                                "shadow-inner border-[#C0D123] border-[2px] rounded-[10px]"
                            }`}
                        >
                            {/* <Slider banner_images={banner_images} /> */}
                            <Sliderr
                                banner_images={listofBannerImages}
                                setIsBannerModalOpened={setIsBannerModalOpened}
                            />
                        </div>
                    </>
                ) : (
                    <div
                        style={{
                            backgroundColor: banner_background_color,
                            backgroundImage: uploadedSingleBanner
                                ? `url(${uploadedSingleBanner})`
                                : // : banner_image?.url
                                  // ? `url(${banner_image?.url})`
                                  `url(${EmptyBackground})`,
                            borderRadius: banner_shape === "sharp" ? 0 : 12,
                            backgroundSize: "cover",
                            backgroundRepeat: "no-repeat",
                        }}
                        className={`w-full min-h-[180px] aspect-[2/1] flex pt-[56px] md:pt-[80px] justify-center relative`}
                        onClick={() => setIsBannerModalOpened(true)}
                    >
                        <div
                            className={`${
                                uploadedSingleBanner
                                    ? "hidden"
                                    : "flex flex-col items-center"
                            } `}
                        >
                            <span className="uppercase text-[24px] leading-[30px] font-semibold text-black/[.54] mb-[8px]">
                                {t("Banner")}
                            </span>

                            <img
                                src={UploadIcon}
                                alt={""}
                                style={{
                                    borderRadius:
                                        logo_shape === "sharp" ? 0 : 12,
                                }}
                                className="w-[18px] h-[18px] object-cover"
                            />
                        </div>
                    </div>
                )
            ) : (
                <div className="skeleton h-[95px] w-full shrink-0"></div>
            )}

            {/* Category */}
            <div
                className={`w-full h-full flex ${
                    menu_category_position === "center"
                        ? "flex-col justify-center items-center"
                        : "flex-row items-start"
                }  gap-[16px]`}
            >
                <div
                    className={`h-full overflow-x-hidden overflow-y-scroll hide-scroll ${
                        menu_category_position === "left"
                            ? "order-1 w-[33%]"
                            : menu_category_position === "right"
                            ? "order-2 w-[33%]"
                            : menu_category_position === "center"
                            ? "w-full"
                            : "w-[33%]"
                    } `}
                >
                    <EditorSlider
                        items={categories}
                        scrollToSection={scrollToSection}
                        isHighlighted={
                            navItems[activeSection]?.title === "Menu Category"
                        }
                        currentSubItem={
                            activeSubitem != null
                                ? navItems[activeSection].subItems[
                                      activeSubitem
                                  ].title
                                : null
                        }
                    />
                </div>
                {!isLoading && (
                    <div
                        style={{
                            backgroundColor: menu_section_background_color,
                            borderRadius: `${menu_section_radius}px`,
                        }}
                        className={`h-full  ${
                            menu_category_position === "left"
                                ? "order-2 w-[75%]"
                                : menu_category_position === "right"
                                ? "order-1 w-[75%]"
                                : menu_category_position === "center"
                                ? "w-full max-w-[710px]"
                                : "w-[75%]"
                        } py-[32]
                        ${
                            navItems[activeSection]?.title ===
                                "Menu Category Detail" &&
                            "shadow-inner border-[#C0D123] border-[2px]"
                        }`}
                    >
                        <div
                            className={`w-full h-full flex flex-col max-h-[610px] items-start justify-center `}
                        >
                            <div
                                className={`flex flex-col gap-[30px] h-fit p-4 overflow-y-scroll hide-scroll`}
                            >
                                {categories &&
                                    categories.map((category, i) => (
                                        <div
                                            className="flex flex-col"
                                            key={i}
                                            id={category.name}
                                        >
                                            <div className="text-black text-opacity-75 text-lg font-medium mb-[16px]">
                                                {category.name}
                                            </div>
                                            <div className="flex flex-row flex-wrap gap-[25px] justify-center">
                                                {category.items.map(
                                                    (product, idx) => (
                                                        <ProductItem
                                                            key={idx + "prdt"}
                                                            id={product.id}
                                                            name={product.name}
                                                            imgSrc={
                                                                product.photo
                                                            }
                                                            description={
                                                                product.description
                                                            }
                                                            amount={
                                                                product.price
                                                            }
                                                            caloryInfo={
                                                                product.calories
                                                            }
                                                            checkbox_required={
                                                                product?.checkbox_required ?? [
                                                                    "true",
                                                                    "false",
                                                                ]
                                                            }
                                                            checkbox_input_titles={
                                                                product?.checkbox_input_titles ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            checkbox_input_names={
                                                                product?.checkbox_input_names ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            checkbox_input_prices={
                                                                product?.checkbox_input_prices ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            checkbox_input_maximum_choices={
                                                                product?.checkbox_input_maximum_choices ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            selection_required={
                                                                product?.selection_required ?? [
                                                                    "true",
                                                                    "false",
                                                                ]
                                                            }
                                                            selection_input_titles={
                                                                product?.selection_input_titles ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            selection_input_names={
                                                                product?.selection_input_names ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            selection_input_prices={
                                                                product?.selection_input_prices ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            dropdown_required={
                                                                product?.dropdown_required ?? [
                                                                    "true",
                                                                    "false",
                                                                ]
                                                            }
                                                            dropdown_input_prices={
                                                                product?.dropdown_input_prices ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            dropdown_input_titles={
                                                                product?.dropdown_input_titles ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            dropdown_input_names={
                                                                product?.dropdown_input_names ?? [
                                                                    [],
                                                                ]
                                                            }
                                                            cartBgcolor={
                                                                categoryDetail_cart_color
                                                            }
                                                            amountColor={
                                                                price_color
                                                            }
                                                            textColor={
                                                                text_color
                                                            }
                                                            textAlign={
                                                                text_alignment
                                                            }
                                                            fontWeight={
                                                                text_fontWeight
                                                            }
                                                            shape={
                                                                categoryDetail_shape
                                                            }
                                                            fontSize={
                                                                text_fontSize
                                                            }
                                                            currentSubItem={
                                                                activeSubitem !=
                                                                null
                                                                    ? navItems[
                                                                          activeSection
                                                                      ]
                                                                          .subItems[
                                                                          activeSubitem
                                                                      ].title
                                                                    : null
                                                            }
                                                        />
                                                    )
                                                )}
                                            </div>
                                        </div>
                                    ))}
                            </div>
                        </div>
                    </div>
                )}
            </div>
            {/* social media */}
            <div
                style={{ backgroundColor: social_media_color }}
                className={`w-full min-h-[70px] px-3  rounded-xl flex ${
                    socialMediaIcons_alignment === "center"
                        ? "items-center justify-center"
                        : socialMediaIcons_alignment === "left"
                        ? "items-center justify-start"
                        : socialMediaIcons_alignment === "right"
                        ? "items-center justify-end"
                        : ""
                }

                ${
                    navItems[activeSection]?.title === "Social Media" &&
                    "shadow-inner border-[#C0D123] border-[2px]"
                }
                ${selectedSocialIcons?.length == 0 ? "hidden" : ""}`}
            >
                <div className="flex items-center gap-5">
                    {selectedSocialIcons?.map((socialMedia) => (
                        <a
                            href={socialMedia.link ? socialMedia.link : null}
                            key={socialMedia.id}
                            className="cursor-pointer"
                        >
                            <div
                                className={`w-[35px] h-[35px] bg-[#F3F3F3] flex justify-center items-center relative`}
                                style={{
                                    borderRadius: social_media_radius
                                        ? social_media_radius + "%"
                                        : "50%",
                                    backgroundColor:
                                        social_media_background_color
                                            ? social_media_background_color
                                            : "#F3F3F3",
                                }}
                            >
                                <img
                                    src={socialMedia.imgUrl}
                                    alt={"whatsapp"}
                                    className="w-[20px] h-[20px] object-cover"
                                    // onClick={() =>
                                    //     handleSocialMediaSelect(socialMedia.id)
                                    // }
                                />
                                {
                                    <button
                                        key={socialMedia.id}
                                        className="absolute top-[-5px] right-[-4px] text-[10px] text-bold h-fit w-fit rounded-full bg-red-500 p-[3px] text-white"
                                        onClick={() =>
                                            handleRemoveMediaSelect(
                                                socialMedia.id
                                            )
                                        }
                                    >
                                        <AiOutlineClose size={7} />
                                    </button>
                                }
                                <img
                                    src={GreenDot}
                                    alt="green dot"
                                    className={`${
                                        activeSubitem != null &&
                                        navItems[activeSection].subItems[
                                            activeSubitem
                                        ].title == "Social Media"
                                            ? "absolute w-[5px] h-[5px] right-[-8px] top-[-8px]"
                                            : "hidden"
                                    }`}
                                />
                            </div>
                        </a>
                    ))}
                </div>
            </div>
            {/* footer */}
            <div
                style={{ backgroundColor: "white" }}
                className={`w-full min-h-[30px]  rounded-xl flex  ${
                    footer_alignment === "center"
                        ? "items-center justify-center"
                        : footer_alignment === "left"
                        ? "items-center justify-start"
                        : footer_alignment === "right"
                        ? "items-center justify-end"
                        : ""
                }
                ${
                    navItems[activeSection]?.title === "Footer Editor" &&
                    "shadow-inner border-[#C0D123] border-[2px]"
                }`}
            >
                <h3
                    style={{ color: footer_text_color }}
                    className={`${
                        footer_text_fontFamily
                            ? `font-['${footer_text_fontFamily}']`
                            : "font-['Plus Jakarta Sans']"
                    }
                    ${
                        footer_text_fontSize
                            ? `text-[${footer_text_fontSize}px]`
                            : "text-[10px]"
                    }
                    ${
                        footer_text_fontWeight
                            ? `font-${footer_text_fontWeight}`
                            : "font-normal"
                    }
                     leading-3 tracking-tight relative`}
                >
                    <span>{t("Powered by @Khardl")}</span>
                    <img
                        src={GreenDot}
                        alt="green dot"
                        className={`${
                            activeSubitem != null &&
                            navItems[activeSection].subItems[activeSubitem]
                                .title == t("Footer Editor")
                                ? "absolute w-[5px] h-[5px] right-[-7px] top-[-3px]"
                                : "hidden"
                        }`}
                    />
                </h3>
            </div>
            {isCropModalOpened && (
                <div
                    class="modal  fixed w-full h-full top-0 left-0 flex items-center justify-center"
                    style={{ opacity: 1, pointerEvents: "all" }}
                >
                    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content py-4 text-left px-6">
                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold">Crop Image!!!</p>
                                <div class="modal-close cursor-pointer z-50">
                                    <svg
                                        class="fill-current text-black"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="18"
                                        height="18"
                                        viewBox="0 0 18 18"
                                    >
                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div className={"cropper-container"}>
                                <Cropper
                                    image={uncroppedImage}
                                    crop={crop}
                                    rotation={rotation}
                                    zoom={zoom}
                                    aspect={1}
                                    onCropChange={setCrop}
                                    onRotationChange={setRotation}
                                    onCropComplete={onCropComplete}
                                    onZoomChange={setZoom}
                                />
                            </div>

                            <div class="flex justify-end pt-2">
                                <button
                                    class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                                    onClick={() => showCroppedImage()}
                                >
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            )}
            {isBannerModalOpened && (
                <div
                    class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
                    style={{ opacity: 1, pointerEvents: "all" }}
                >
                    <div class="modal-container bg-white !w-[688px] mx-auto rounded-[10px] shadow-lg z-50">
                        <div className="w-[688px] flex flex-col items-center rounded-[10px] border-dashed border-2 border-black border-opacity-30">
                            {showCropSection === false ? (
                                <div
                                    className="w-full h-[200px] mt-[16px] bg-white rounded-[10px] border border-black border-opacity-10 flex flex-col items-center relative"
                                    style={{
                                        backgroundImage: uploadSingleBanner
                                            ? `url(${uploadSingleBanner})`
                                            : // : banner_image?.url
                                              // ? `url(${banner_image?.url})`
                                              `url(${EmptyBackground})`,
                                        backgroundSize: "cover",
                                        backgroundRepeat: "no-repeat",
                                    }}
                                >
                                    <div className=" text-black text-opacity-50 mt-[67px] text-2xl font-semibold uppercase">
                                        {t("Banner")}
                                    </div>
                                    <div className="w-[18px] h-[18px] mt-[8px]">
                                        <div className="w-[18px] h-[18px] bg-zinc-100 rounded-full border border-black border-opacity-20 flex justify-center items-center">
                                            <img
                                                className="w-2 h-2"
                                                src={UploadIcon}
                                            />
                                        </div>
                                    </div>
                                </div>
                            ) : (
                                <div className={"cropper-container"}>
                                    <Cropper
                                        image={uncroppedImage}
                                        crop={crop}
                                        rotation={rotation}
                                        zoom={zoom}
                                        aspect={2 / 1}
                                        onCropChange={setCrop}
                                        onRotationChange={setRotation}
                                        onCropComplete={onCropComplete}
                                        onZoomChange={setZoom}
                                    />
                                </div>
                            )}

                            <div
                                className={`${
                                    listofBannerImages.length > 0
                                        ? "flex flex-row space-x-[8px] mt-[8px] "
                                        : "hidden"
                                }`}
                            >
                                {listofBannerImages.map((image, idx) => (
                                    <div key={idx} className="relative">
                                        <img
                                            src={image.croppedImage}
                                            alt="banner"
                                            className="w-[80px] h-[40px] rounded-[10px] object-cover"
                                        />
                                        <div className="absolute top-[-0.8rem] right-[-1rem]">
                                            <div className="w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center">
                                                <IoCloseOutline
                                                    size={16}
                                                    className="text-red-500"
                                                    onClick={() =>
                                                        removeUploadedImage(idx)
                                                    }
                                                />
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            <input
                                type="file"
                                name="banner"
                                id={"banner"}
                                accept="image/*"
                                onChange={handleBannerUpload}
                                className="hidden"
                                hidden
                            />
                            <div className="flex flex-row space-x-[16px] justify-center items-center mt-[16px]">
                                {!uploadSingleBanner ? (
                                    <label
                                        htmlFor="banner"
                                        className="w-[105px] h-6 bg-zinc-300 rounded-[50px] text-[#111827C4]/[0.77] text-[10px] font-light flex justify-center items-center"
                                    >
                                        {t("Upload Image")}
                                    </label>
                                ) : (
                                    <button
                                        onClick={() => showCroppedImageBanner()}
                                        className={`${
                                            uploadSingleBanner
                                                ? "w-14 h-6 bg-white rounded-[50px] border border-black border-opacity-20 text-[#111827C4]/[0.77] text-[10px] font-light"
                                                : "hidden"
                                        }`}
                                    >
                                        {t("Crop")}
                                    </button>
                                )}
                            </div>
                            <div className="flex flex-row space-x-[16px] my-[16px]">
                                <button
                                    onClick={() => {
                                        listofBannerImages.length == 1 &&
                                            setUploadedSingleBanner(
                                                listofBannerImages[0]
                                                    .croppedImage
                                            );
                                        setIsBannerModalOpened(false);
                                        listofBannerImages.length == 0 &&
                                            setUploadedSingleBanner(null);

                                        if (listofBannerImages.length < 2) {
                                            dispatch(bannerType("one-photo"));
                                        } else {
                                            dispatch(
                                                BannerImages(
                                                    listofBannerImages.map(
                                                        (image) => {
                                                            return {
                                                                url: image.croppedImage,
                                                            };
                                                        }
                                                    )
                                                )
                                            );
                                            dispatch(bannerType("slider"));
                                        }
                                    }}
                                    className="w-14 h-6 bg-zinc-300 rounded-[50px] text-[#111827C4]/[0.77] text-[10px] font-light"
                                >
                                    {t("Apply")}
                                </button>
                                <button
                                    onClick={() => {
                                        setIsBannerModalOpened(false);
                                    }}
                                    className="w-14 h-6 bg-white rounded-[50px] border border-black border-opacity-20 text-[#111827C4]/[0.77] text-[10px] font-light"
                                >
                                    {t("Cancel")}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default MainBoardEditor;
