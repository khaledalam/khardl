import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { changeLanguage } from "../redux/languageSlice";
// import Arabic from '../assets/saudiArabia.png';
// import English from '../assets/unitedKingdom.png';
import Button from "./Button";
import AxiosInstance from "../axios/axios";

function Languages() {
  const dispatch = useDispatch();
  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode,
  );
  const newLanguage = currentLanguage === "en" ? "ar" : "en";
  const buttonText =
    currentLanguage === "en" ? (
      <span title="Arabic">AR</span>
    ) : (
      <span title="English">EN</span>
    );

  const handleLanguageChange = async () => {
    await AxiosInstance.get(`/change-language/${newLanguage}`, {});
    dispatch(changeLanguage(newLanguage));
  };

  return (
    <div
      className={`flex justify-center items-center gap-2 max-[1000px]:w-[100%]`}
    >
      <div className="flex justify-center items-center gap-2">
        <Button
          onClick={handleLanguageChange}
          classContainer={`rounded-lg shadow-md !bg-[var(--third)] hover:!bg-[#98a24020] flex justify-center items-center !px-[12px] !py-[2px] text-[12px]`}
          title={buttonText}
        />
      </div>
    </div>
  );
}

export default React.memo(Languages);
// [
//   [
//       [
//           "c1 value 1 en",
//           "c1 value 2 en"
//       ],
//       [
//           "c1 value 1 ar",
//           "c1 value 2 ar"
//       ]
//   ],
//   [
//       [
//           "c2 value 1 en",
//           "c2  value 2 en"
//       ],
//       [
//           "c2  value 1 ar",
//           "c2  value 2 ar"
//       ]
//   ]
// ]
