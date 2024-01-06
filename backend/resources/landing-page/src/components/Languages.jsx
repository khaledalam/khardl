import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { changeLanguage } from '../redux/languageSlice';
import Arabic from '../assets/saudiArabia.png';
import English from '../assets/unitedKingdom.png';
import Button from './Button';

function Languages() {
  const dispatch = useDispatch();
  const currentLanguage = useSelector((state) => state.languageMode.languageMode);
  const newLanguage = currentLanguage === 'en' ? 'ar' : 'en';
  const buttonText = currentLanguage === 'en' ? <img src={Arabic} width={"30px"} alt="Arabic" /> : <img src={English} width={"30px"} alt="English" />;

  const handleLanguageChange = () => {
      dispatch(changeLanguage(newLanguage));
  };

  return (
    <div className={`flex justify-center items-center gap-2 max-[1000px]:w-[100%]`}>
      <div className='flex justify-center items-center gap-2'>
        <Button
          onClick={handleLanguageChange}
          classContainer={`rounded-lg shadow-md !bg-[var(--third)] hover:!bg-[#98a24020] flex justify-center items-center !px-[12px] !py-[2px]`}
          title={buttonText}
        />
      </div>
    </div>
  );
}

export default React.memo(Languages);
