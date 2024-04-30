import React, { lazy, Suspense } from "react";
import { Helmet } from "react-helmet";
import { useTranslation } from "react-i18next";

const RestaurantNotFound = () => {
  // window.location.href = '/dashboard';
  //
  // return;
  const { t } = useTranslation();
  return (
    <div>
      <Helmet>
        <title>Khardl</title>
        <meta name="description" content="Khardl" />
      </Helmet>

      <div
        className="flex flex-col justify-start items-center gap-[180px] pt-[80px] justify-around"
        style={{ minHeight: "93vh" }}
      >
        <div className="p-[30px] pt-[60px] max-md:px-[5px] max-md:py-[40px] ">
          <p>
            {t(
              "The requested restaurant does not exist. Please check the details and try again.",
            )}
          </p>
        </div>
      </div>
    </div>
  );
};

export default RestaurantNotFound;
