import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { changeLanguage } from '../redux/languageSlice';
import Arabic from '../assets/saudiArabia.png';
import English from '../assets/unitedKingdom.png';
import Button from './Button';
import AxiosInstance from '../axios/axios';


function Languages() {
  const dispatch = useDispatch();
  const currentLanguage = localStorage.getItem("i18nextLng")
  const newLanguage = currentLanguage === 'en' ? 'ar' : 'en';
  const buttonText = currentLanguage === 'en' ? 'AR' : 'EN';

  const handleLanguageChange = () => {
    AxiosInstance.get(`/change-language/${newLanguage}`, {}).then(() => {
      dispatch(changeLanguage(newLanguage))
     
    })
  };

  return (
    <div className={`flex justify-center items-center gap-2 max-[1000px]:w-[100%] new-translate-button`}>
      <div className='flex justify-center items-center gap-2'>
        <Button
          onClick={handleLanguageChange}
          classContainer={`flex justify-center items-center !px-[12px] !py-[2px]`}
          title={buttonText}
        />
      </div>
    </div>
  );
}

export default React.memo(Languages);
