import React, { useState, useEffect, useRef } from 'react';
import { useParams } from "react-router";
import Header from './components/header';
import Hero from './components/Hero';
import Footer from './components/footer';
import { useSelector, useDispatch } from 'react-redux';
import { Taps, Tap } from "./components/Taps";
import MenuItems from "./components/menuItems";
import { useTranslation } from "react-i18next";
import Logo from './components/Logo';
import { HiOutlineLocationMarker } from 'react-icons/hi';
import ResizeDetector from 'react-resize-detector';
import { setDivWidth } from '../../../redux/editor/divWidthSlice';
import AxiosInstance from "../../../axios/axios";
import { toast } from 'react-toastify'

const Editor = () => {
  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
  const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
  const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);
  const selectedFontSize = useSelector((state) => state.fonts.selectedFontSize);
    const [styleData, setStyleData] = useState(null);

    const state = useSelector((state) => state);

  const dispatch = useDispatch();
    const selectedCategory = sessionStorage.getItem('selectedCategory');
    const selectedAlign = sessionStorage.getItem('selectedAlign');
    const Language = sessionStorage.getItem('Language');
    const { branch_id } = useParams();
    const { t } = useTranslation();
    const [branch, setBranch] = useState(branch_id ?? null);
    const [branches, setBranches] = useState([]);
    const [categories, setCategories] = useState([]);
    const selectedFont = sessionStorage.getItem('selectedFont');

    console.log(">> state >> ", state)

    const fetchRestaurantStyles = async () => {
        const restaurantBranchesResponse = await AxiosInstance.get(`branches-site-editor`)

        console.log("editor rest restaurantBranchesResponse >>>", restaurantBranchesResponse.data?.data)
        if (restaurantBranchesResponse.data?.data) {
            setBranches(restaurantBranchesResponse.data?.data);
        }
    }

    const fetchData = async () => {
        try {
            const restaurantCategoriesResponse = await AxiosInstance.get(`categories?items&user&branch`);
            const restaurantStyleResponse = await AxiosInstance.get(`restaurant-style`)
            await fetchRestaurantStyles();

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
            }


        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };


    useEffect(() => {
        fetchData().then(r => null);
    }, []);


  const categoriesForBranch = categories.filter(category => category?.branch?.id === branch);

  console.log(branches);


  const handleResize = () => {
    if (divRef.current) {
      dispatch(setDivWidth(divRef.current.clientWidth));
    }
  };
  useEffect(() => {
    if (divRef.current) {
      const newWidth = divRef.current.clientWidth;
      if (newWidth <= 900) {
        dispatch(setDivWidth(900));
      } else {
        dispatch(setDivWidth(newWidth));
      }
    }
    handleResize();
    window.addEventListener('resize', handleResize);
    return () => {
      window.removeEventListener('resize', handleResize);
    };
  }, []);

  return (
    <div ref={divRef} className="w-[100%] bg-white h-[85vh] overflow-y-auto" style={{ fontFamily: `${selectedFontFamily}`, fontWeight: `${selectedFontWeight}`,fontSize:`${selectedFontFamily}` }}>
      <Header />
      <div className=''>

          {branches?.length > 0 ?
              <div className={"w-[100%] flex items-center bg-[var(--primary)] h-[auto] m-4 p-1"}>
                  <b className={"flex text-black"}>Branches:</b>
                  {branches.map((branchItem, i) =>
                      <span onClick={() => {
                          setBranch(branchItem?.id);
                          toast.info("branches changed to " + branchItem?.name );
                      }} className={(branchItem?.id == branch ? 'border border-[red]' : '') + " m-1 flex justify-center content-center cursor-pointer w-[100px] flex bg-[var(--primary)]"} key={i}>{branchItem?.name}</span>)}
              </div>
          : <h2>No branches yet! <a href={"/branches"} className={"m-1 flex justify-center content-center bg-[var(--primary)]"}>Add new branch</a></h2>}

          <hr />
        <div className={`${selectedAlign === "Center" ? "justify-center" : ""}
        ${selectedAlign === "Left" && Language === "en" ? "justify-start" : selectedAlign === "Left" ? "justify-end" : ""}
        ${selectedAlign === "Right" && Language === "en" ? "justify-end" : selectedAlign === "Right" ? "justify-start" : ""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4 text-center'>
            <Logo url={styleData?.logo}/>
            <div className='flex justify-center items-center gap-2 mt-2'>
              <h2>العنوان</h2>
              <HiOutlineLocationMarker />
            </div>
          </div>
        </div>
        <Hero />
      </div>
      <div className={`mt-[30px] mb-[50px] ${divWidth >= 744 ? "mx-[40px]" : ""}`}>
        <div>
          <div>
            <div className={`px-[30px] text-xl`}>
                {categoriesForBranch?.length > 0 ?
                    <>
                        <h2>Categories:</h2>
                        {console.log(categoriesForBranch)}
                        <Taps
                            contentClassName={`
        bg-[var(--secondary)] ${selectedCategory === `${t("Carousel")}` ? `flex justify-center`:''} text-xl
        ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}>
                        {categoriesForBranch.map((category, i) => {
                            return <Tap
                                        key={i}
                                        component={
                                            category?.items?.length > 0 ? <MenuItems
                                                items={category?.items}
                                                branch_id={category?.branch?.id}
                                            /> : <h2 className={"m-4"}>No items in this category yet! <a target={"_blank"} href={`/menu/${category?.id}/${branch}`}
                                                                                       className={"p-1 bg-[var(--primary)]"}>Add items to this category</a></h2>
                                        }
                                        contentClassName="text-black">
                                        {category?.name}
                                    </Tap>;
                            }
                        )}
                    </Taps></> : <h2>No categories yet! <a target={"_blank"} href={"/branches"} className={"p-1 bg-[var(--primary)]"}>Add new category</a></h2>}
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
