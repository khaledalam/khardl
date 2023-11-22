import React, { useState, useEffect } from 'react';
import { useParams } from "react-router";
import Header from './components/header';
import Hero from './components/Hero';
import Footer from './components/footer';
import { Taps, Tap } from "./components/Taps";
import MenuItems from "./components/menuItems";
import { useTranslation } from "react-i18next";
import Logo from './components/Logo';
import { HiOutlineLocationMarker } from 'react-icons/hi';
import AxiosInstance from "../../../axios/axios";

const Preview = () => {
    const selectedCategory = sessionStorage.getItem('selectedCategory');
    const selectedAlign = sessionStorage.getItem('selectedAlign');
    const Language = sessionStorage.getItem('Language');
    const { branch_id } = useParams();
    const { t } = useTranslation();
    const [branch, setBranch] = useState([]);
    const [branches, setBranches] = useState([]);
    const [categories, setCategories] = useState([]);
    const selectedFont = sessionStorage.getItem('selectedFont');


    const fetchData = async () => {
        try {
            const response = await AxiosInstance.get(`categories?items&user&branch`)

            console.log("SAS>ASAS>>>", response)
            if (response.data) {
                console.log(response.data)

                setCategories(response.data?.data);

            } else {
            }
        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };


    useEffect(() => {
        fetchData();
    }, []);

    useEffect(() => {
      if (branches.length > 0) {
        const foundBranch = branches.find((branch) => branch.branch_id === parseInt(branch_id));
        if (foundBranch) {
          setBranch(foundBranch);
        }
      }
    }, [branch_id, branches]);

    const categoriesForBranch = categories.filter(category => category.branch_id === branch.branch_id);
    return (
      <div className="w-[100%] bg-white"  style={{fontFamily: `${selectedFont}`}}>
      <Header />
      <div className=''>
        <div className={`${selectedAlign === "Center" ? "justify-center" : ""}
        ${selectedAlign === "Left" && Language === "en" ? "justify-start" : selectedAlign === "Left" ? "justify-end":""}
        ${selectedAlign === "Right" && Language === "en" ? "justify-end" : selectedAlign === "Right" ? "justify-start":""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4'>
            <Logo />
            <div className={`flex justify-center items-center gap-2 mt-2 ${Language === "en" ? "flex-col-reverse" : "" }`}>
            <h2>العنوان</h2>
            <HiOutlineLocationMarker />
            </div>
          </div>
        </div>
        <Hero />
      </div>
      <div className="flex justify-center mt-[30px] mb-[50px] xl:mx-[150px]">
        <div>
          <div>
            <div className={`px-[30px] text-xl`}>

                {categoriesForBranch?.length > 0 ?
                    <>
                        <h2>Categories:</h2>
                    <Taps
                contentClassName={`
        bg-[var(--secondary)] ${selectedCategory === `${t("Carousel")}` ? `flex justify-center`:''} text-xl
        ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}>
                {categoriesForBranch.map((category, i) => (
                  <Tap
                      key={i}
                    component={
                      <MenuItems
                        items={category?.items}
                      />
                    }
                    contentClassName="text-black">
                    {category?.name}
                  </Tap>
                ))}
              </Taps></> : <h2>No categories of this branch yet!</h2>}
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </div>
    );
};

export default Preview;
