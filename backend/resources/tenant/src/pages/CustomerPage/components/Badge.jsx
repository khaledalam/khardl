import React from "react";
import { useTranslation } from "react-i18next";

const Badge = ({ value }) => {
  const colors = {
    Accepted: "#0020CB",
    Rejected: "#FF0000",
    Completed: "#0A7B47",
    Cancelled: "#FF0000",
    "Received by Restaurant": "#7900B2",
    Ready: "#FF00D6",
  };
  const { t } = useTranslation();
  return (
    <div className="justify-end items-start gap-2.5 flex">
      <div
        className="px-2 py-[3px] rounded-[50px] border justify-center items-center gap-2.5 inline-flex text-opacity-75 text-xs"
        style={{
          color: colors[value],
          backgroundColor: colors[value] + "10",
          borderColor: colors[value],
        }}
      >
        {t(value)}
      </div>
    </div>
  );
};

export default Badge;
