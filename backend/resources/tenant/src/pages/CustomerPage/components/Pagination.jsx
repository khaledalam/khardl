import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { MdKeyboardArrowLeft, MdKeyboardArrowRight } from "react-icons/md";
import { useTranslation } from "react-i18next";
const Pagination = ({ page, setPage, totalCount, perPage = 10 }) => {
  const language = useSelector((state) => state.languageMode.languageMode);
  const dispatch = useDispatch();
  const [pageCount, setPageCount] = useState(0);
  const { t } = useTranslation();

  const changeCurrentPage = (page) => {
    setPage(page);
  };
  useEffect(() => {
    setPageCount(Math.ceil(totalCount / perPage));
    setPage(0);
  }, [totalCount]);
  return (
    <div className="w-full justify-between items-center inline-flex text-lg px-4">
      <div className=" font-normal font-['Roboto'] text-zinc-600">
        <span className="text-zinc-500">{t("Page")}&nbsp;</span>
        <span className="text-black">{page + 1}</span>
        <span className="text-zinc-500 font-normal">&nbsp;{t("of")}&nbsp;</span>
        <span className="text-zinc-900">{pageCount}</span>
      </div>
      {pageCount > 1 && (
        <div className="w-fit flex flex-row items-center gap-5 font-['Plus Jakarta Sans']">
          <MdKeyboardArrowLeft
            size={20}
            color={page >= 1 ? "#000" : "#ccc"}
            className="cursor-pointer"
            style={{
              rotate: language === "en" ? "0deg" : "180deg",
            }}
            onClick={() => page >= 1 && changeCurrentPage(page - 1)}
          />
          {(() => {
            const tempArray = [];
            for (let i = 0; i < pageCount; i += 1) {
              tempArray.push(
                page === i ? (
                  <div
                    key={i}
                    className="w-8 h-8 cursor-pointer justify-center flex items-center rounded-md shadow-md hover:bg-gray-600 transition-all bg-[#3B3B3B] text-white"
                    onClick={() => changeCurrentPage(i)}
                  >
                    {i + 1}
                  </div>
                ) : (
                  <div
                    key={i}
                    className="w-8 h-8 cursor-pointer justify-center flex items-center rounded-md shadow-md hover:bg-gray-100 transition-all text-[#838383] bg-white"
                    onClick={() => changeCurrentPage(i)}
                  >
                    {i + 1}
                  </div>
                )
              );
            }
            return tempArray;
          })()}
          <MdKeyboardArrowRight
            size={20}
            color={page <= pageCount - 2 ? "#000" : "#ccc"}
            className="cursor-pointer"
            style={{
              rotate: language === "en" ? "0deg" : "180deg",
            }}
            onClick={() => page <= pageCount - 2 && changeCurrentPage(page + 1)}
          />
        </div>
      )}
    </div>
  );
};

export default Pagination;
