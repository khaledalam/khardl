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
    const [imgType, setImgType] = useState("");
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { toggleMenu } = useContext(MenuContext);

    const {
        page_color,
        page_category_color,
        product_background_color,
        category_hover_color,
        category_alignment,
        category_shape,

        categoryDetail_cart_color,
        categoryDetail_type,
        categoryDetail_alignment,
        categoryDetail_shape,

        price_color,
        logo,
        banner_image,
        banner_images,
        header_color,
        banner_background_color,
        footer_color,
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
        selectedSocialIcons,
        text_color,
    } = restuarantEditorStyle;

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
                setIsCropModalOpened(true);
                setImgType("setBannerUpload");
                setUploadSingleBanner(URL.createObjectURL(selectedBanner));
            }
            dispatch(setBannerUpload(URL.createObjectURL(selectedBanner)));
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
                fontFamily: text_fontFamily,
                fontWeight: text_fontWeight,
            }}
            className="w-full p-4 flex flex-col gap-[16px] relative "
        >
            {/* Header cart */}
            {headerPosition !== "fixed" && (
                <HeaderEdit
                    restaurantStyle={restuarantEditorStyle}
                    toggleSidebarCollapse={toggleSidebarCollapse}
                    isHighlighted={
                        navItems[activeSection]?.title === t("Header")
                    }
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
                    navItems[activeSection]?.title === t("Logo") &&
                    "shadow-inner border-[#C0D123] border-[2px]"
                }`}
            >
                <div
                    style={{
                        borderRadius: logo_shape === "sharp" ? 0 : 12,
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
                                (logo || uploadLogo) && "hidden"
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
                banner_type === "slider" ? (
                    <>
                        <div
                            className={`w-full h-[300px] ${
                                navItems[activeSection]?.title ===
                                    t("Banner") &&
                                "shadow-inner border-[#C0D123] border-[2px] rounded-[10px]"
                            }`}
                        >
                            <Slider banner_images={banner_images} />
                        </div>
                        {/* <div className="w-full h-[300px]">
                            <Sliderr banner_images={banner_images} />
                        </div> */}
                    </>
                ) : (
                    // : isVideo ||
                    //   (banner_image && banner_image?.type === "video") ? (
                    //     <div
                    //         className={`w-full min-h-[180px] max-h-[300px] overflow-hidden relative  border border-neutral-100  flex items-center justify-center`}
                    //     >
                    //         {uploadSingleBanner && (
                    //             <video
                    //                 controls
                    //                 className="absolute top-0 right-0 bottom-0 z-[5] left-0 w-full max-h-[200px]"
                    //             >
                    //                 <source
                    //                     src={uploadSingleBanner}
                    //                     type="video/mp4"
                    //                 />
                    //                 Your browser does not support the video tag.
                    //             </video>
                    //         )}
                    //         <div
                    //             style={{
                    //                 borderRadius: banner_shape === "sharp" ? 0 : 12,
                    //             }}
                    //             className="w-14 h-14 rounded-lg p-2 flex items-center z-10 justify-center bg-neutral-100 relative"
                    //         >
                    //             <label htmlFor="banner">
                    //                 <input
                    //                     type="file"
                    //                     name="banner"
                    //                     id={"banner"}
                    //                     accept="video/*, image/*"
                    //                     onChange={handleBannerUpload}
                    //                     className="hidden"
                    //                     hidden
                    //                 />
                    //                 {uploadSingleBanner ? (
                    //                     <IoCloseOutline
                    //                         size={28}
                    //                         className="text-red-500"
                    //                         onClick={clearBanner}
                    //                     />
                    //                 ) : (
                    //                     <BiCloudUpload size={28} />
                    //                 )}
                    //             </label>
                    //         </div>
                    //     </div>
                    // )
                    <div
                        style={{
                            backgroundColor: banner_background_color,
                            backgroundImage: uploadSingleBanner
                                ? `url(${uploadSingleBanner})`
                                : banner_image
                                ? `url(${banner_image?.url})`
                                : `url(${EmptyBackground})`,
                            borderRadius: banner_shape === "sharp" ? 0 : 12,
                            backgroundSize: "cover",
                            backgroundRepeat: "no-repeat",
                        }}
                        className={`w-full min-h-[180px] h-[300px] flex pt-[56px] md:pt-[80px] justify-center relative`}
                    >
                        <div className="flex flex-col items-center">
                            <span className="uppercase text-[24px] leading-[30px] font-semibold text-black/[.54] mb-[8px]">
                                {t("Banner")}
                            </span>
                            <label htmlFor="banner">
                                <input
                                    type="file"
                                    name="banner"
                                    id={"banner"}
                                    accept="video/*, image/*"
                                    onChange={handleBannerUpload}
                                    className="hidden"
                                    hidden
                                />
                                <img
                                    src={UploadIcon}
                                    alt={""}
                                    style={{
                                        borderRadius:
                                            logo_shape === "sharp" ? 0 : 12,
                                    }}
                                    className="w-[18px] h-[18px] object-cover"
                                />
                            </label>

                            {uploadSingleBanner && (
                                <div className="absolute top-[-0.8rem] right-[-1rem]">
                                    <div className="w-[20px] h-[20px] rounded-full p-1 bg-neutral-100 flex items-center justify-center">
                                        <IoCloseOutline
                                            size={16}
                                            className="text-red-500"
                                            onClick={clearBanner}
                                        />
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                )
            ) : (
                <div className="skeleton w-[100px] h-[95px] w-full shrink-0"></div>
            )}

            {/* Category */}
            <div
                className={`w-full h-full flex ${
                    category_alignment === "center"
                        ? "flex-col justify-center"
                        : "flex-row"
                } items-center gap-[16px]`}
            >
                <div
                    className={`h-full overflow-x-hidden overflow-y-scroll hide-scroll ${
                        category_alignment === "left"
                            ? "order-1 w-[25%]"
                            : category_alignment === "right"
                            ? "order-2 w-[25%]"
                            : category_alignment === "center"
                            ? "w-full"
                            : "w-[25%]"
                    } `}
                >
                    <EditorSlider
                        items={categories}
                        scrollToSection={scrollToSection}
                        isHighlighted={
                            navItems[activeSection]?.title ===
                            t("Menu Category")
                        }
                        currentSubItem={
                            activeSubitem != null
                                ? navItems[activeSection].subItems[
                                      activeSubitem
                                  ].title
                                : null
                        }
                    />
                    {/* <div
                        style={{
                            backgroundColor: page_category_color,
                            borderRadius: category_shape === "sharp" ? 0 : 12,
                        }}
                        className="w-full h-40 py-3 flex items-center justify-between"
                    >
                        <div
                            className={`flex items-center justify-between w-full px-[16px]`}
                        >
                            <button className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center">
                                <img src={LeftIcon} alt="left icon" />
                            </button>
                            <div
                                className={`flex ${
                                    category_alignment === "center"
                                        ? "flex-row gap-[30px] "
                                        : "flex-col gap-6"
                                } items-center `}
                            >
                                {categories && categories.length > 0 ? (
                                    categories?.map((category, i) => (
                                        <CategoryItem
                                            key={i}
                                            active={
                                                selectedCategory.id ===
                                                category.id
                                            }
                                            name={category.name}
                                            imgSrc={category.photo}
                                            alt={category.name}
                                            hoverColor={category_hover_color}
                                            onClick={() =>
                                                dispatch(
                                                    selectedCategoryAPI({
                                                        name: category.name,
                                                        id: category.id,
                                                    })
                                                )
                                            }
                                            textColor={text_color}
                                            textAlign={text_alignment}
                                            fontWeight={text_fontWeight}
                                            shape={category_shape}
                                            isGrid={
                                                category_alignment === "center"
                                                    ? false
                                                    : true
                                            }
                                            fontSize={text_fontSize}
                                        />
                                    ))
                                ) : (
                                    <div className="skeleton w-16 h-16 rounded-full shrink-0"></div>
                                )}
                            </div>
                            <button className="w-[25px] h-[25px] bg-black/10 rounded-full flex justify-center items-center">
                                <img src={RightIcon} alt="right icon" />
                            </button>
                        </div>
                    </div> */}
                </div>
                {!isLoading && (
                    <div
                        style={{ backgroundColor: product_background_color }}
                        className={`h-full  ${
                            category_alignment === "left"
                                ? "order-2 w-[75%]"
                                : category_alignment === "right"
                                ? "order-1 w-[75%]"
                                : category_alignment === "center"
                                ? "w-full"
                                : "w-[75%]"
                        } ${
                            categoryDetail_shape === "sharp" ? "" : "rounded-lg"
                        } bg-white py-[32] 
                        ${
                            navItems[activeSection]?.title ===
                                t("Menu Category Detail") &&
                            "shadow-inner border-[#C0D123] border-[2px]"
                        }`}
                    >
                        <div
                            className={`w-full h-full flex flex-col max-h-[610px] items-start justify-center `}
                        >
                            <div
                                className={`flex flex-col gap-[30px] h-fit p-4 overflow-y-scroll hide-scroll`}
                            >
                                {/* {categories &&
                                    categories[0].items
                                        .filter(
                                            (item) => item.availability === 1
                                        )
                                        .map((product, idx) => (
                                            <ProductItem
                                                key={idx + "prdt"}
                                                id={product.id}
                                                name={product.name}
                                                imgSrc={product.photo}
                                                amount={product.price}
                                                caloryInfo={product.calories}
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
                                                amountColor={price_color}
                                                textColor={text_color}
                                                textAlign={text_alignment}
                                                fontWeight={text_fontWeight}
                                                shape={categoryDetail_shape}
                                                fontSize={text_fontSize}
                                            />
                                        ))} */}
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
                                            <div className="flex flex-row flex-wrap gap-[25px] justify-start">
                                                {/* {category.items.map(
                                                    (product, idx) => (
                                                        <div>Hello</div>
                                                    )
                                                )} */}
                                                {category.items.map(
                                                    (product, idx) => (
                                                        <ProductItem
                                                            key={idx + "prdt"}
                                                            id={product.id}
                                                            name={product.name}
                                                            imgSrc={
                                                                product.photo
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
                style={{ backgroundColor: footer_color }}
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
                    navItems[activeSection]?.title === t("Social Media") &&
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
                            <div className="w-[35px] h-[35px] bg-[#F3F3F3] flex justify-center items-center rounded-full relative">
                                <img
                                    src={socialMedia.imgUrl}
                                    alt={"whatsapp"}
                                    className="w-[20px] h-[20px] object-cover"
                                    onClick={() =>
                                        handleSocialMediaSelect(socialMedia.id)
                                    }
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
                style={{ backgroundColor: footer_color }}
                className={`w-full min-h-[70px]  rounded-xl flex  ${
                    phoneNumber_alignment === "center"
                        ? "items-center justify-center"
                        : phoneNumber_alignment === "left"
                        ? "items-center justify-start"
                        : phoneNumber_alignment === "right"
                        ? "items-center justify-end"
                        : ""
                } 
                ${
                    navItems[activeSection]?.title === t("Footer Editor") &&
                    "shadow-inner border-[#C0D123] border-[2px]"
                }`}
            >
                <h3
                    className={`${
                        text_fontFamily
                            ? text_fontFamily
                            : "font-['Plus Jakarta Sans']"
                    } text-black text-opacity-50 text-[10px] font-normal leading-3 tracking-tight relative`}
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
        </div>
    );
};

export default MainBoardEditor;
