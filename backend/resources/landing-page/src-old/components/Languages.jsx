import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { changeLanguage } from '../redux/features/languageSlice';
import { MdKeyboardArrowDown } from 'react-icons/md';

function Languages() {
  const dispatch = useDispatch();
  const currentLanguage = useSelector((state) => state.languageMode.languageMode);
  const newLanguage = currentLanguage === 'en' ? 'ar' : 'en';

  const handleLanguageChange = () => {
    dispatch(changeLanguage(newLanguage));
  };

  return (
    <div className={`flex justify-center items-center gap-2 max-[1000px]:w-[100%]`}>
      <div className='flex justify-center items-center gap-2 '>
        <div className='relative'>
          <select id=""  onChange={handleLanguageChange} className='text-[14px] bg-[var(--secondary)] w-[60px] max-[1000px]:w-[80px] p-2 rounded-md px-4 appearance-none'>
            <option value="En">En</option>
            <option value="Ar">Ar</option>
          </select>
          <MdKeyboardArrowDown className={`absolute top-1/2 ${currentLanguage === "en" ? "right-2" : "left-2"} transform -translate-y-1/2 text-black`} />
        </div>
      </div>
    </div>
  );
}

export default React.memo(Languages);
