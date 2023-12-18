import React, { useState, useEffect } from 'react';
import Hero from './components/Hero';
import Footer from './components/footer';
import { Taps, Tap } from "./components/Taps";
import MenuItems from "./components/menuItems";
import { useTranslation } from "react-i18next";
import Logo from './components/Logo';
import AxiosInstance from "../../../axios/axios";
import {useDispatch, useSelector} from "react-redux";


const RestaurantHomePage = () => {
    const Language = sessionStorage.getItem('Language') || 'en';
    const { t } = useTranslation();
    const [categories, setCategories] = useState([]);
    const styleDataRestaurant = useSelector((state) => state.styleDataRestaurant.styleDataRestaurant);
    const [branchIdState, setBranchIdState] = useState(null);

    let branch_id = localStorage.getItem('selected_branch_id');

    const fetchData = async () => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(`categories?items&user&branch`);

            console.log("editor rest restaurantCategoriesResponse >>>", restaurantCategoriesResponse.data)
            if (restaurantCategoriesResponse.data) {
                setCategories(restaurantCategoriesResponse.data?.data);

                console.log(">> >>", branch_id);

                if (!branch_id) {
                    branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id;
                    localStorage.setItem('selected_branch_id',branch_id)
                    setBranchIdState(branch_id);
                }
            }


        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };


    useEffect(() => {
        fetchData().then(r => null);
    }, []);


    if (!styleDataRestaurant){
        return;
    }
    console.log(branch_id);

    const categoriesForBranch = categories.filter(category => category.branch.id == branch_id);

    return (
      <div className="w-[100%] bg-white" style={{fontFamily: `${styleDataRestaurant?.font_family}` ,fontWeight: `${styleDataRestaurant?.font_type}`,fontSize:`${styleDataRestaurant?.font_size}`}}>
          <div className=''>
        <div className={`${styleDataRestaurant?.logo_alignment === "Center" ? "justify-center" : ""}
        ${styleDataRestaurant?.logo_alignment === "Left" && Language === "en" ? "justify-start" : styleDataRestaurant?.logo_alignment === "Left" ? "justify-end":""}
        ${styleDataRestaurant?.logo_alignment === "Right" && Language === "en" ? "justify-end" : styleDataRestaurant?.logo_alignment === "Right" ? "justify-start":""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4'>
            <Logo url={styleDataRestaurant?.logo}/>
            <div className={`flex justify-center items-center gap-2 mt-2 ${Language === "en" ? "flex-col-reverse" : "" }`}>
            {/*<h2>العنوان</h2>*/}
            {/*<HiOutlineLocationMarker />*/}
            </div>
          </div>
        </div>
        <Hero />
      </div>
      <div className="justify-center mt-[30px] mb-[50px] xl:mx-[150px]">
        <div>
          <div>
            <div className={`px-[30px] text-xl `} style={{
                minWidth: '650px',
                marginBottom: '200px'
            }}>
                {categoriesForBranch?.length > 0 ?
                    <Taps
                contentClassName={`
        bg-[var(--secondary)] mb-5 ${styleDataRestaurant?.category_style === "Carousel" ? `flex justify-center`:''} text-xl
        ${styleDataRestaurant?.category_style === "Right" || styleDataRestaurant?.category_style === "Left" ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}>
                {categoriesForBranch?.map((category, i) => (
                  <Tap
                      key={i}
                    component={
                        category?.items?.length > 0
                            ? <MenuItems items={category?.items?.filter(item => item?.availability == '1')} /> // only availabile items
                             : <h2 style={{color: 'var(--primary)'}}>{t("No items in this category")}</h2>
                    }
                    contentClassName="text-black">
                    {category?.name}
                  </Tap>
                ))}
              </Taps> : <h2>No categories yet!</h2>}
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </div>
    );
};

export default RestaurantHomePage;
