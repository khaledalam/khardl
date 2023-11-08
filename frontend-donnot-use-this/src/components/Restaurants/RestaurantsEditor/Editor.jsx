import React, { useState, useEffect, useRef } from 'react';
import { useParams } from "react-router";
import Header from './components/header';
import Hero from './components/Hero';
import Footer from './components/footer';
import { useSelector, useDispatch } from 'react-redux';
import { getSelectedCategory } from '../../../redux/editor/categorySlice';
import { Taps, Tap } from "./components/Taps";
import MenuItems from "./components/menuItems";
import { useTranslation } from "react-i18next";
import { getSelectedAlign } from '../../../redux/editor/alignSlice';
import Logo from './components/Logo';
import { HiOutlineLocationMarker } from 'react-icons/hi';
import { categories, branches } from '../../../data/data';
import ResizeDetector from 'react-resize-detector';
import { setDivWidth } from '../../../redux/editor/divWidthSlice';

const Editor = () => {
  const { branch_id } = useParams();
  const selectedCategory = useSelector(getSelectedCategory);
  const { t } = useTranslation();
  const selectedAlign = useSelector(getSelectedAlign);
  const Language = useSelector((state) => state.languageMode.languageMode);
  const [branch, setBranch] = useState([]);
  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
  const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
  const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);

  const dispatch = useDispatch();


  /*   const fetchData = async () => {
      try {
        const response = await fetch('https://khardl.com/api/branches');
        const data = await response.json();
        setBranch(data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };
  
    useEffect(() => {
      fetchData();
    }, []); */

  useEffect(() => {
    if (branches.length > 0) {
      const foundBranch = branches.find((branch) => branch.branch_id === parseInt(branch_id));
      if (foundBranch) {
        setBranch(foundBranch);
      }
    }
  }, [branch_id, branches]);
  const categoriesForBranch = categories.filter(category => category.branch_id === branch.branch_id);


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
    <div ref={divRef} className="w-[100%] bg-white  h-[85vh] overflow-y-auto" style={{ fontFamily: `${selectedFontFamily}`, fontWeight: `${selectedFontWeight}` }}>
      <Header />
      <div className=''>
        <div className={`${selectedAlign === "Center" ? "justify-center" : ""} 
        ${selectedAlign === "Left" && Language === "en" ? "justify-start" : selectedAlign === "Left" ? "justify-end" : ""} 
        ${selectedAlign === "Right" && Language === "en" ? "justify-end" : selectedAlign === "Right" ? "justify-start" : ""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4 text-center'>
            <Logo />
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
              <Taps
                contentClassName={`
                ${divWidth <= 744 ? "justify-center flex-wrap" : ""}
                ${divWidth <= 500 ? (selectedCategory === `${t("Carousel")}` ? "flex-col" : "justify-center flex-wrap") : ""}
        bg-[var(--secondary)] ${selectedCategory === `${t("Carousel")}` ? `flex justify-center` : ''} text-xl
        ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "min-w-[180px]  mx-[15px] p-2 rounded-md" : "px-[30px]"}`}>
                {categoriesForBranch.map((category) => (
                  <Tap
                    component={
                      <MenuItems
                        category_id={category.category_id}
                        branch_id={category.branch_id}
                      />
                    }
                    contentClassName="text-black">
                    {category.category_name}
                  </Tap>
                ))}
              </Taps>
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