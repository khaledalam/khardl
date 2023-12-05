import React, { useState, useEffect } from 'react';
import { useParams } from "react-router";
import Header from './components/header';
import Hero from './components/Hero';
import Footer from './components/footer';
import { Taps, Tap } from "./components/Taps";
import MenuItems from "./components/menuItems";
import { useTranslation } from "react-i18next";
import Logo from './components/Logo';
import AxiosInstance from "../../../axios/axios";
import {useDispatch} from "react-redux";
import { changeStyleDataRestaurant } from '../../../redux/editor/styleDataRestaurantSlice';


const RestaurantHomePage = () => {
    const Language = sessionStorage.getItem('Language') || 'en';

    const { t } = useTranslation();
    const [branch, setBranch] = useState([]);
    const [branches, setBranches] = useState([]);
    const [categories, setCategories] = useState([]);
    const [styleData, setStyleData] = useState(null);

    const dispatch = useDispatch()

    const branch_id = localStorage.getItem('selected_branch_id');


    const fetchData = async () => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(`categories?items&user&branch&selected_branch_id=${branch_id}`);
            const restaurantStyleResponse = await AxiosInstance.get(`restaurant-style`)

            console.log("editor rest restaurantCategoriesResponse >>>", restaurantCategoriesResponse.data)
            if (restaurantCategoriesResponse.data) {
                setCategories(restaurantCategoriesResponse.data?.data);

                if (!branch) {
                    setBranch(restaurantCategoriesResponse.data?.data[0]?.branch?.id)
                }
            }

            console.log("editor rest restaurantStyleResponse >>>", restaurantStyleResponse.data)
            if (restaurantStyleResponse.data) {
                setStyleData(restaurantStyleResponse.data?.data);
                dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data));
            }

        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };


    useEffect(() => {
        fetchData().then(r => null);
    }, []);

    useEffect(() => {
      if (branches.length > 0) {
        const foundBranch = branches.find((branch) => branch.branch_id === parseInt(branch_id));
        if (foundBranch) {
          setBranch(foundBranch);
        }
      }
    }, [branch_id, branches]);


    if (!styleData){
        return;
    }

    const categoriesForBranch = categories.filter(category => category.branch_id === branch.branch_id);
    return (
      <div className="w-[100%] bg-white" style={{fontFamily: `${styleData?.font_family}`}}>
          <div className=''>
        <div className={`${styleData?.logo_alignment === "Center" ? "justify-center" : ""}
        ${styleData?.logo_alignment === "Left" && Language === "en" ? "justify-start" : styleData?.logo_alignment === "Left" ? "justify-end":""}
        ${styleData?.logo_alignment === "Right" && Language === "en" ? "justify-end" : styleData?.logo_alignment === "Right" ? "justify-start":""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4'>
            <Logo url={styleData?.logo}/>
            <div className={`flex justify-center items-center gap-2 mt-2 ${Language === "en" ? "flex-col-reverse" : "" }`}>
            {/*<h2>العنوان</h2>*/}
            {/*<HiOutlineLocationMarker />*/}
            </div>
          </div>
        </div>
        <Hero styleData={styleData} />
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
                        styleData={styleData}
                contentClassName={`
        bg-[var(--secondary)] mb-5 ${styleData?.category_style === "Carousel" ? `flex justify-center`:''} text-xl
        ${styleData?.category_style === "Right" || styleData?.category_style === "Left" ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}>
                {categoriesForBranch.map((category, i) => (
                  <Tap
                      key={i}
                    component={
                        category?.items?.length > 0
                            ? <MenuItems items={category?.items} />
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
      <Footer styleData={styleData} />
    </div>
    );
};

export default RestaurantHomePage;
