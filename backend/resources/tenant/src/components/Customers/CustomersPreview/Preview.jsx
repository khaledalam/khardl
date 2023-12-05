import React, { useState, useEffect, useRef } from 'react';
import { useParams } from "react-router";
import { useSelector, useDispatch } from 'react-redux';
import { getSelectedCategory } from '../../../redux/editor/categorySlice';
import { useTranslation } from "react-i18next";
import { getSelectedAlign } from '../../../redux/editor/alignSlice';
import ResizeDetector from 'react-resize-detector';
import { setDivWidth } from '../../../redux/editor/divWidthSlice';
import Header from './components/header';
import Dashboard from './components/Dashboard/Dashboard';
import 'babel-polyfill'
import AxiosInstance from "../../../axios/axios";

const Preview = () => {
  const { branch_id } = useParams();
  const selectedCategory = useSelector(getSelectedCategory);
  const { t } = useTranslation();
  const selectedAlign = useSelector(getSelectedAlign);
  const Language = useSelector((state) => state.languageMode.languageMode);
    const [branch, setBranch] = useState([]);
    const [branches, setBranches] = useState([]);
    const [categories, setCategories] = useState([]);
  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
  const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
  const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);

  const dispatch = useDispatch();


  console.log("branch_id", branch_id);

     const fetchData = async () => {
      try {
          const response = await AxiosInstance.post(`api/categories?items&user&branch`)

          console.log(response)
          if (response.data) {
              const responseData = await response.json()
              console.log(responseData)


              setBranch(data);

          } else {
          }
      } catch (error) {
          // toast.error(`${t('Failed to send verification code')}`)
          console.log(error);
      }
    };

    useEffect(() => {
        console.log("TEST")
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
    <div ref={divRef} className="w-[100%] bg-[var(--forth)] h-[100%] overflow-y-auto"
      style={{
        fontFamily: `${selectedFontFamily}`,
        fontWeight: `${selectedFontWeight}`
      }}>

      <ResizeDetector onResize={handleResize} />
      <Header />
      <Dashboard />
    </div>
  );
};

export default Preview;
